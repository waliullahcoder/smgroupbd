<?php

namespace App\Http\Controllers\Crm;

use App\HelperClass;
use Throwable;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Store;
use App\Models\Sales;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Product;
use App\Models\CoaSetup;
use App\Models\SalesList;
use App\Models\AccessLog;
use App\Models\AdminMenu;
use App\Models\Collection;
use App\Models\SalesReturn;
use App\Models\ClientPrice;
use App\Models\AdminSetting;
use App\Models\DeliveryList;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\CollectionData;
use App\Models\SalesReturnList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AdminMenuAction;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use App\Services\ActionButtons\ActionButtons;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('crm_quotations as q')
                ->leftJoin('companies as c', 'c.id', '=', 'q.company_id')
                ->leftJoin('crm_leads as cl', 'cl.id', '=', 'q.client_id')
                ->leftJoin('stores as s', 's.id', '=', 'q.store_id')
                ->leftJoin('staff as st', 'st.id', '=', 'q.staff_id')
                ->select(
                    'q.id',
                    'q.quotation',
                    'q.date',
                    'q.total_amount',
                    'q.quotation_type',
                    'c.name as company_name',
                    'cl.company_name as client_name',
                    's.name as store_name',
                    'st.name as staff_name'
                )
                ->orderByDesc('q.id');

            return DataTables::query($model)


                ->editColumn('date', function ($row) {
                    return date('d M, Y', strtotime($row->date));
                })

                ->editColumn('total_amount', function ($row) {
                    return number_format($row->total_amount,2);
                })

                ->addColumn('actions', function ($row) {
                    $data = [
                        'id'=>$row->id,
                        'edit'=>true,
                    ];

                    $btn='';

                    if(auth()->user()->can('admin.quotation.show')){
                        $btn .= '<a href="'.route('admin.quotation.show',$row->id).'"
                            class="btn btn-sm btn-primary" target="_blank">
                            <i class="fas fa-print"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.quotation.destroy')){
                        $btn .= '<a href="'.route('admin.quotation.destroy',$row->id).'"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>';
                    }
                    
                return ActionButtons::actions($data,$btn);

                })
                ->rawColumns([
                    'checkbox',
                    'actions'
                ])

                ->make(true);
        }

        return view('crm.quotation.index');
    }

    
    /**
     * Show the form for creating a new resource.
     */
   public function create(Request $request)
    {
        if ($request->ajax() && $request->product_id) {

                $product = Product::find($request->product_id);
                 $price= $product->price->sale_price ?? 0;
                return response()->json([
                    'status'  => 'success',
                    'product' => $product,
                    'price'   => $price,
                    'amount'  => $price * $request->quantity,
                ]);
            }
        

        $quotation =$this->getOrderNo();

        $clients = DB::table('crm_leads')->get();

        $stores = Store::where('status',1)->get();

        $staffs = Staff::where('status',1)->get();

        $products = Product::where('status',1)->get();
        $companies = Company::get();

        return view('crm.quotation.create',compact(
            'quotation',
            'clients',
            'stores',
            'staffs',
            'products',
            'companies'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quotation' => 'required',
            'date' => 'required',
            'client_id' => 'required',
            'store_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $client = DB::table('crm_leads')->find($request->client_id);

        try {
            DB::transaction(function () use ($request) {
            $quotation_id = DB::table('crm_quotations')->insertGetId([
                'company_id'      => $request->company_id,
                'store_id'        => $request->store_id,
                'client_id'       => $request->client_id,
                'note'            => $request->note,
                'quotation'         => $this->getOrderNo(),
                'date'            => date('Y-m-d', strtotime($request->date)),
                'quotation_type'  => $request->quotation_type,
                'total_amount'    => $request->total_amount,
                'discount'        => $request->discount,
                'total_paid'      => $request->quotation_type == 'cash' ? $request->net_amount : 0,
                'staff_id'        => $request->staff_id,
                'created_by'      => Auth::id(),
            ]);

            foreach ($request->product_id as $product_id) {

                $discount = ($request->discount / $request->total_amount) * $request->amount[$product_id];

                DB::table('crm_quotation_details')->insert([
                    'company_id' => $request->company_id,
                    'quotation_id'   => $quotation_id,
                    'store_id'   => $request->store_id,
                    'client_id'  => $request->client_id,
                    'product_id' => $product_id,
                    'rate'       => $request->rate[$product_id],
                    'qty'        => $request->qty[$product_id],
                    'amount'     => $request->amount[$product_id],
                    'discount'   => $discount
                ]);
            }

        });
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors($caught->getMessage());
            }
        }
        return redirect()->route('admin.quotation.index')->withSuccessMessage('Quotation Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
      if ($request->ajax() && $request->product_id) {

                $product = Product::find($request->product_id);
                 $price= $product->price->sale_price ?? 0;
                return response()->json([
                    'status'  => 'success',
                    'product' => $product,
                    'price'   => $price,
                    'amount'  => $price * $request->quantity,
                ]);
            }
        

        $quotation =DB::table('crm_quotations')->find($id);

        $clients = DB::table('crm_leads')->get();

        $stores = Store::where('status',1)->get();

        $staffs = Staff::where('status',1)->get();

        $products = Product::where('status',1)->get();
        $companies = Company::get();
        $quotation_details =DB::table('crm_quotation_details as qd')
                ->leftJoin('products as p', 'p.id', '=', 'qd.product_id')
                ->where('quotation_id',$id)->get();

        return view('crm.quotation.edit',compact(
            'quotation',
            'clients',
            'stores',
            'staffs',
            'products',
            'companies',
            'quotation_details'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quotation' => 'required',
            'date' => 'required',
            'client_id' => 'required',
            'store_id' => 'required',
            'product_id' => 'required|array',
            'qty' => 'required',
        ]);

        try {

            DB::transaction(function () use ($request, $id) {

                DB::table('crm_quotations')
                    ->where('id', $id)
                    ->update([
                        'company_id'     => $request->company_id,
                        'store_id'       => $request->store_id,
                        'client_id'      => $request->client_id,
                        'note'           => $request->note,
                        'quotation'      => $request->quotation,
                        'date'           => date('Y-m-d', strtotime($request->date)),
                        'quotation_type' => $request->quotation_type,
                        'total_amount'   => $request->total_amount,
                        'discount'       => $request->discount,
                        'total_paid'     => $request->quotation_type == 'cash'
                                                ? $request->net_amount
                                                : 0,
                        'staff_id'       => $request->staff_id,
                        'updated_by'     => Auth::id(),
                        'updated_at'     => now(),
                    ]);

                // Delete old details
                DB::table('crm_quotation_details')
                    ->where('quotation_id', $id)
                    ->delete();

                // Insert new details
                foreach ($request->product_id as $product_id) {

                    $discount = 0;

                    if ($request->total_amount > 0) {
                        $discount = ($request->discount / $request->total_amount)
                                    * $request->amount[$product_id];
                    }

                    DB::table('crm_quotation_details')->insert([
                        'company_id'  => $request->company_id,
                        'quotation_id'=> $id,
                        'store_id'    => $request->store_id,
                        'client_id'   => $request->client_id,
                        'product_id'  => $product_id,
                        'rate'        => $request->rate[$product_id],
                        'qty'         => $request->qty[$product_id],
                        'amount'      => $request->amount[$product_id],
                        'discount'    => $discount,
                    ]);
                }

            });

        } catch (\Throwable $caught) {

            return redirect()->back()
                ->withInput()
                ->withErrors($caught->getMessage());

        }

        return redirect()
            ->route('admin.quotation.index')
            ->withSuccessMessage('Quotation Updated Successfully!');
    }

   

    public function getOrderNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = DB::table('crm_quotations')->select(['quotation'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($order) {
            $trim = str_replace("QUOT", '', $order->quotation);
            $orderPrefix = (int)$trim + 1;
            $quotation = "QUOT" . $orderPrefix;
        } else {
            $quotation = "QUOT" . date('y') . date('m') . '000001';
        }
        return $quotation;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = DB::table('crm_quotations as q')
        ->leftJoin('crm_leads as ld', 'ld.id', '=', 'q.client_id')->where('q.id',$id)->first();
        $report_title = 'Quotation';
         $quotation_details =DB::table('crm_quotation_details as qd')
                ->leftJoin('products as p', 'p.id', '=', 'qd.product_id')
                ->where('quotation_id',$id)->get();

        $pdf = Pdf::loadView('crm.quotation.print', compact('title', 'logo', 'informations', 'report_title', 'data','quotation_details'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       

        // Delete Multiple Items Permanent
        if (request()->has('id')) {
            
                $quotation = DB::table('crm_quotations')->find($id)->delete();
                $data = DB::table('crm_quotation_details')->where('quotation_id',$id)->delete();
            
            return response()->json(['status' => 'success']);
        }

    }



}
