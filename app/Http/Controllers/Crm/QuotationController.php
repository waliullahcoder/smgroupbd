<?php

namespace App\Http\Controllers\Crm;

use App\HelperClass;
use Throwable;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Branch;
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
            ->leftJoin('branches as p', 'p.id', '=', 'q.branch_id')
            ->leftJoin('staff as st', 'st.id', '=', 'q.staff_id')
            ->leftJoin('users as u', 'u.id', '=', 'q.created_by')
            ->select(
                'q.id',
                'q.quotation',
                'q.date',
                'q.name as party_name',
                'q.total_amount',
                'q.discount',
                'q.tax_percentage',
                'q.tax_amount',
                'q.net_amount',
                'c.name as company_name',
                'p.name as project_name',
                'st.name as staff_name',
                'u.name as created_by_name'
            );

        // ---------- Filters ----------
        if (request()->filled('quotation')) {
            $model->where('q.quotation', 'like', '%' . request('quotation') . '%');
        }

        if (request()->filled('company_id')) {
            $model->where('q.company_id', request('company_id'));
        }

        if (request()->filled('project_id')) {
            $model->where('q.branch_id', request('project_id'));
        }

        if (request()->filled('quotation_date')) {
            try {
                $date = Carbon::createFromFormat('d-m-Y', request('quotation_date'))->format('Y-m-d');
                $model->whereDate('q.date', $date);
            } catch (\Exception $e) {
                // invalid date hole filter skip
            }
        }

        $model->orderByDesc('q.id');

        return DataTables::query($model)

            ->editColumn('date', function ($row) {
                return date('d M, Y', strtotime($row->date));
            })

            ->editColumn('total_amount', function ($row) {
                return number_format($row->total_amount, 2);
            })

            ->editColumn('discount', function ($row) {
                return number_format($row->discount, 2);
            })

            ->editColumn('tax_amount', function ($row) {
                $pct = rtrim(rtrim(number_format($row->tax_percentage, 2), '0'), '.');
                return number_format($row->tax_amount, 2) . ' <small class="text-muted">(' . $pct . '%)</small>';
            })

            ->editColumn('net_amount', function ($row) {
                return '<b>' . number_format($row->net_amount, 2) . '</b>';
            })

            ->addColumn('actions', function ($row) {
                $data = [
                    'id'   => $row->id,
                    'edit' => true,
                ];

                $btn = '';

                if (auth()->user()->can('admin.quotation.show')) {
                    $btn .= '<a href="' . route('admin.quotation.show', $row->id) . '"
                        class="btn btn-sm btn-primary" target="_blank" title="Print">
                        <i class="fas fa-print"></i>
                    </a> ';
                }

                if (auth()->user()->can('admin.quotation.destroy')) {
                    $btn .= '<button type="button" class="btn btn-sm btn-danger delete_btn"
                        data-url="' . route('admin.quotation.destroy', $row->id) . '" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>';
                }

                return ActionButtons::actions($data, $btn);
            })

            ->rawColumns(['tax_amount', 'net_amount', 'actions'])

            ->make(true);
    }

    $companies = DB::table('companies')->select('id', 'name')->orderBy('name')->get();

    return view('crm.quotation.index', compact('companies'));
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
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $client = DB::table('crm_leads')->find($request->client_id);

        try {
            DB::transaction(function () use ($request) {
            $quotation_id = DB::table('crm_quotations')->insertGetId([
                'company_id'      => $request->company_id,
                'branch_id'      => $request->project_id,
                'store_id'        => $request->store_id,
                'client_id'       => $request->client_id,
                'note'            => $request->note,
                'quotation'         => $this->getOrderNo(),
                'date'            => date('Y-m-d', strtotime($request->date)),
                'quotation_type'  => $request->quotation_type,
                'name'       => $request->name,
                'tax_percentage'       => $request->tax_percentage,
                'tax_amount'       => $request->tax_amount,
                'total_amount'    => $request->total_amount,
                'net_amount'    => $request->net_amount,
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
    public function edit($id)
    {
        $quotation = DB::table('crm_quotations')->where('id', $id)->first();
        abort_if(!$quotation, 404);

        $quotation_details = DB::table('crm_quotation_details as d')
            ->join('products as p', 'p.id', '=', 'd.product_id')
            ->where('d.quotation_id', $id)
            ->select('d.*', 'p.name', 'p.code')
            ->get();

        $companies = Company::orderBy('name', 'asc')->get();
        $projects = Branch::where('company_id', $quotation->company_id)
                ->orderBy('name', 'asc')
                ->get(['id', 'name']);
        $staffs   = DB::table('staff')->select('id', 'name')->get();
        $products = DB::table('products')->select('id', 'name', 'code')->get();

        return view('crm.quotation.edit', compact(
            'quotation', 'quotation_details', 'companies', 'projects', 'staffs', 'products'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required',
            'project_id' => 'required',
            'date'       => 'required',
            'name'       => 'required|string|max:255',
            'staff_id'   => 'required',
            'store_id'   => 'required',
            'client_id'  => 'required',
            'product_id' => 'required|array|min:1',
            'rate'       => 'required|array',
            'qty'        => 'required|array',
            'amount'     => 'required|array',
        ]);

        try {

            DB::transaction(function () use ($request, $id) {

                $total_amount = (float) $request->total_amount;
                $discount     = (float) $request->discount;

                DB::table('crm_quotations')
                    ->where('id', $id)
                    ->update([
                        'company_id'     => $request->company_id,
                        'branch_id'      => $request->project_id,
                        'store_id'       => $request->store_id,
                        'client_id'      => $request->client_id,
                        'name'           => $request->name,
                        'note'           => $request->note,
                        'date'           => date('Y-m-d', strtotime($request->date)),
                        'total_amount'   => $total_amount,
                        'discount'       => $discount,
                        'tax_percentage' => (float) $request->tax_percentage,
                        'tax_amount'     => (float) $request->tax_amount,
                        'net_amount'     => (float) $request->net_amount,
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

                    $amount = (float) ($request->amount[$product_id] ?? 0);

                    $row_discount = 0;
                    if ($total_amount > 0) {
                        $row_discount = ($discount / $total_amount) * $amount;
                    }

                    DB::table('crm_quotation_details')->insert([
                        'company_id'   => $request->company_id,
                        'quotation_id' => $id,
                        'store_id'     => $request->store_id,
                        'client_id'    => $request->client_id,
                        'product_id'   => $product_id,
                        'rate'         => $request->rate[$product_id] ?? 0,
                        'qty'          => $request->qty[$product_id] ?? 0,
                        'amount'       => $amount,
                        'discount'     => $row_discount,
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
    
    public function show($id)
    {
        $data = DB::table('crm_quotations as q')
            ->leftJoin('companies as c', 'c.id', '=', 'q.company_id')
            ->leftJoin('branches as p', 'p.id', '=', 'q.branch_id')
            ->leftJoin('staff as st', 'st.id', '=', 'q.staff_id')
            ->leftJoin('users as u', 'u.id', '=', 'q.created_by')
            ->where('q.id', $id)
            ->select(
                'q.*',
                'c.name as company_name',
                'c.logo as company_logo',
                'c.address as company_address',
                'c.phone as company_phone',
                'c.email as company_email',
                'p.name as project_name',
                'st.name as staff_name',
                'u.name as created_by_name'
            )
            ->first();

        abort_if(!$data, 404);

        $quotation_details = DB::table('crm_quotation_details as d')
            ->join('products as pr', 'pr.id', '=', 'd.product_id')
            ->where('d.quotation_id', $id)
            ->select('d.*', 'pr.name', 'pr.code')
            ->get();

        return view('crm.quotation.print', compact('data', 'quotation_details'));
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
