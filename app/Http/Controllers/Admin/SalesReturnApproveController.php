<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use App\Models\Client;
use App\Models\CoaSetup;
use App\Models\Collection;
use App\Models\Company;
use App\Models\SalesList;
use App\Models\SalesReturn;
use App\Models\Scopes\CompanyScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SalesReturnApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = SalesReturn::with(['company', 'client', 'store', 'staff'])->where(function ($query) {
                $query->where('reject', 0);
            })->where(function ($query) {
                $query->where('approve', 0)->orWhere('accounts_approve', 0);
            })->latest('id');
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $actionBtn .= '<a class="btn btn-xxs tt btn-outline-info text-nowrap" href="' . Route('admin.return-approve.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i> View</a>';
                    if ($row->approve == 0 && $row->reject == 0) {
                        $actionBtn .= '<button type="button" class="btn btn-xxs tt ms-1 btn-outline-success store_approve text-nowrap" data-url="' . Route('admin.return-approve.edit', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Store Approve">Store Approve</button>';
                    }
                    if ($row->accounts_approve == 0 && $row->reject == 0) {
                        $actionBtn .= '<button type="button" class="btn btn-xxs tt ms-1 btn-outline-success accounts_approve text-nowrap" data-url="' . Route('admin.return-approve.edit', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Accounts Approve">Accounts Approve</button>';
                    }
                    if ($row->approve == 0 && $row->accounts_approve == 0) {
                        $actionBtn .= '<button type="button" class="btn btn-xxs tt ms-1 btn-outline-danger reject-btn text-nowrap" data-url="' . Route('admin.return-approve.destroy', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject">Reject</button>';
                    }
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $inactive_create = true;
        $title = "Sales Return Approval";
        return view('admin.sales_return_approve.index', compact('title', 'inactive_create'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $report_title = 'Receive Chalan';
        $data = SalesReturn::findOrFail($id);
        return view('admin.sales_return_approve.view', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.sales_return_approve.view', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('sales_return_approval_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (request()->ajax() && request()->has('store_approve')) {
            DB::transaction(function () use ($id) {
                $return = SalesReturn::findOrFail($id);
                $return->update([
                    'approve' => 1,
                    'approve_by' => Auth::user()->id,
                ]);
            });
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax() && request()->has('accounts_approve')) {
            DB::transaction(function () use ($id) {
                $return = SalesReturn::findOrFail($id);
                $total_advance = 0;
                foreach ($return->list as $item) {
                    $total_advance += $item->sales_list->collection;
                }

                if ($total_advance > 0) {
                    $first = date('Y-m-01');
                    $last = new Carbon('last day of this month');
                    $data = Collection::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
                    if ($data) {
                        $trim = str_replace("STC", '', $data->payment_no);
                        $dataPrefix = (int)$trim + 1;
                        $payment_no = "STC" . $dataPrefix;
                    } else {
                        $payment_no = "STC" . date('y') . date('m') . '000001';
                    }

                    $collection = Collection::create([
                        'company_id' => Auth::user()->company_id ?? 1,
                        'client_id' => $return->client_id,
                        'payment_no' => $payment_no,
                        'amount' => $total_advance,
                        'payment_date' => date('Y-m-d'),
                        'collection_type' => 'advance',
                        'payment_type' => 'Product Return',
                        'remarks' => 'advance against return',
                        'created_by' => Auth::user()->id,
                    ]);

                    $client = Client::find($return->client_id);
                    if ($client->coa) {
                        $cash_head = CoaSetup::where('head_name', 'Sales Return')->first();
                        $headCode = collect([
                            '0' => $cash_head->head_code,
                            '1' => $client->coa->head_code
                        ]);

                        $debit_amount = collect([
                            '0' => $total_advance,
                            '1' => 0.00
                        ]);

                        $credit_amount = collect([
                            '0' => 0.00,
                            '1' => $total_advance,
                        ]);

                        $countHead = count($headCode);
                        $postData = [];
                        for ($i = 0; $i < $countHead; $i++) {
                            $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                            $postData[] = [
                                'company_id' => Auth::user()->company_id ?? 1,
                                'voucher_no' => $payment_no,
                                'voucher_type' => "Collection",
                                'voucher_date' => date('Y-m-d'),
                                'coa_setup_id' => $coa->id,
                                'coa_head_code' => $headCode[$i],
                                'narration' => 'Advance Collection against Sales Return against PAYMENT NO - ' . $payment_no,
                                'debit_amount' => $debit_amount[$i],
                                'credit_amount' => $credit_amount[$i],
                                'created_by' => Auth::user()->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ];
                        }
                        AccountTransactionAuto::insert($postData);
                    }

                    $return->update([
                        'collection_id' => $collection->id,
                        'accounts_approve' => 1,
                        'accounts_approve_by' => Auth::user()->id,
                    ]);
                } else {
                    $return->update([
                        'accounts_approve' => 1,
                        'accounts_approve_by' => Auth::user()->id,
                    ]);
                }
            });
            return response()->json(['status' => 'success']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {
            $sales_return = SalesReturn::findOrFail($id);
            $sales_return->update([
                'reject' => 1,
                'reject_by' => Auth::user()->id,
            ]);
            foreach ($sales_return->list as $item) {
                $sales_list = SalesList::find($item->sales_list_id);
                $sales_list->update(['is_return' => 0]);
            }
        });
        return response()->json(['status' => 'success']);
    }
}
