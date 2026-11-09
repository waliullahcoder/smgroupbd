<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\Client;
use App\Models\CoaSetup;
use App\Models\Company;
use App\Models\Product;
use App\Models\SalesList;
use App\Models\SalesReturn;
use App\Models\SalesReturnList;
use App\Models\Scopes\CompanyScope;
use App\Models\Store;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LifestyleProductReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = SalesReturn::where('product_type', 'Fashion')->with(['company', 'client', 'store', 'staff'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $transaction = AccountTransaction::where('voucher_no', $row->return_no)->where('voucher_type', 'Sales Return')->first();
                    if (is_null($transaction) && $row->approve == 0 && $row->accounts_approve == 0 && $row->reject == 0) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifestyle-product-return.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    $transaction = AccountTransaction::where('voucher_no', $row->return_no)->where('voucher_type', 'Sales Return')->first();
                    if (is_null($transaction) && $row->approve == 0 && $row->accounts_approve == 0 && $row->reject == 0) {
                        $type = request('type');
                        $data = [
                            'id' => $row->id,
                            'edit' => !empty($type) && $type == 'trash' ? false : true,
                        ];
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifestyle-product-return.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Lifestyle Product Return";
        return view('admin.lifestyle_product_return.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = SalesReturn::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['return_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("STSR", '', $data->return_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STSR" . $dataPrefix;
        } else {
            $invoice = "STSR" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_variant')) {
            $query = SalesList::where('product_type', 'Fashion')->with(['variant', 'sales', 'return'])->where('client_id', $request->client_id)->where('is_return', 0)->whereHas('sales', function ($q) {
                $q->whereNull('deleted_at');
            });
            if (!is_null($request->product_id)) {
                $query->where('product_id', $request->product_id);
            }
            $variants = $query->get();
            return response()->json(['status' => 'success', 'variants' => $variants]);
        }

        if ($request->ajax() && $request->has('add_item')) {
            $data = SalesList::with(['product', 'variant', 'sales'])->findOrFail($request->sales_list_id);
            return response()->json(['status' => 'success', 'data' => $data]);
        }

        $title = 'Add New Sales Return';
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $products = Product::where('product_type', 'Fashion')->where('status', 1)->orderBy('name', 'asc')->get();
        $return_no = $this->invoice();
        return view('admin.lifestyle_product_return.create', compact('title', 'clients', 'stores', 'products', 'return_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'sales_list_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $return_no = $this->invoice();
            $amount = 0;
            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                $discount = ($sales_list->discount / $sales_list->amount) * ($sales_list->rate * $request->return_qty[$sales_list_id]);
                $amount += ($sales_list->rate * $request->return_qty[$sales_list_id]) - $discount;
            }

            $sales_return = SalesReturn::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'product_type' => 'Fashion',
                'client_id' => $request->client_id,
                'store_id' => $request->store_id,
                'return_no' => $return_no,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->sales_list_id as $sales_list_id) {
                if ($request->return_qty[$sales_list_id] == 0 || is_null($request->return_qty[$sales_list_id])) {
                    continue;
                }
                $sales_list = SalesList::findOrFail($sales_list_id);

                $discount = ($sales_list->discount / $sales_list->amount) * ($sales_list->rate * $request->return_qty[$sales_list_id]);
                SalesReturnList::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'product_type' => 'Fashion',
                    'sales_return_id' => $sales_return->id,
                    'client_id' => $request->client_id,
                    'sales_list_id' => $sales_list_id,
                    'store_id' => $request->store_id,
                    'product_id' => $sales_list->product_id,
                    'variant_id' => $sales_list->variant_id,
                    'price' => $sales_list->rate,
                    'qty' => $request->return_qty[$sales_list_id],
                    'amount' => $sales_list->rate * $request->return_qty[$sales_list_id],
                    'sales_discount' => $discount,
                    'remarks' => $request->remarks,
                ]);

                $total_return_qty = $sales_list->returned_qty + $request->return_qty[$sales_list_id];
                $total_return_amount = $sales_list->returned_amount + ($sales_list->rate * $request->return_qty[$sales_list_id]) - $discount;
                if ($total_return_qty == $sales_list->qty) {
                    $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount, 'is_return' => 1]);
                } else {
                    $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount]);
                }
            }

            $client = Client::find($request->client_id);
            if ($client->coa) {
                $headCode = collect([
                    '0' => 30102,
                    '1' => $client->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $sales_return->return_no,
                        'voucher_type' => "Sales Return",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Sales Return Against RETURN NO - ' . $sales_return->return_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $store = Store::find($request->store_id);
            $products_info = '';
            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                $products_info .= ' ' . @$sales_list->product->name . ' variant : ' . @$sales_list->variant->sku . ' Quanity : ' . $request->return_qty[$sales_list_id] . ', ';
            }
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Sales Return',
                'action' => 'Add',
                'description' => 'Create a new sales Return with Return no ' . $sales_return->return_no . ' from client ' . $client->name . ' to store ' . $store->name . ' sales return amount is ' . $sales_return->amount . ' products ' . $products_info . ' for reason ' . $request->remarks,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->Route('admin.lifestyle-product-return.index')->withSuccessMessage('Created Successfully!');
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
        $data = SalesReturn::findOrFail($id);
        $report_title = 'Sales Return Voucher';
        // return view('admin.lifestyle_product_return.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.lifestyle_product_return.print', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('sales_return_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_variant')) {
            $sales_ids = SalesReturnList::where('sales_return_id', $id)->pluck('sales_list_id')->toArray();
            $query = SalesList::where('product_type', 'Fashion')->with(['variant', 'sales', 'return'])->where('client_id', $request->client_id)->where(function ($query) use ($sales_ids) {
                $query->where('is_return', 0)->orWhereIn('id', $sales_ids);
            })->whereHas('sales', function ($q) {
                $q->whereNull('deleted_at');
            });
            if (!is_null($request->product_id)) {
                $query->where('product_id', $request->product_id);
            }
            $variants = $query->get();
            return response()->json(['status' => 'success', 'variants' => $variants]);
        }

        if ($request->ajax() && $request->has('add_item')) {
            $data = SalesList::with(['product', 'variant', 'sales'])->findOrFail($request->sales_list_id);
            $old_return = SalesReturnList::where('sales_return_id', $id)->where('sales_list_id', $request->sales_list_id)->first();
            $old_return_qty = $old_return->qty ?? 0;
            return response()->json(['status' => 'success', 'data' => $data, 'old_return_qty' => $old_return_qty]);
        }

        $title = 'Update Sales Return';
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $products = Product::where('product_type', 'Fashion')->where('status', 1)->orderBy('name', 'asc')->get();
        $data = SalesReturn::findOrFail($id);
        $link = Route('admin.lifestyle-product-return.update', $id);
        return view('admin.lifestyle_product_return.edit', compact('title', 'clients', 'stores', 'products', 'data', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'sales_list_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $amount = 0;
            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                $discount = ($sales_list->discount / $sales_list->amount) * ($sales_list->rate * $request->return_qty[$sales_list_id]);
                $amount += ($sales_list->rate * $request->return_qty[$sales_list_id]) - $discount;
            }

            $sales_return = SalesReturn::findOrFail($id);
            $sales_return->update([
                'client_id' => $request->client_id,
                'store_id' => $request->store_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'remarks' => $request->remarks,
                'updated_by' => Auth::user()->id,
            ]);
            AccountTransactionAuto::withTrashed()->where('voucher_no', $sales_return->return_no)->where('voucher_type', 'Sales Return')->forceDelete();

            foreach ($sales_return->list as $item) {
                $sales_list = SalesList::find($item->sales_list_id);
                $returned_qty = $sales_list->returned_qty - $item->qty;
                $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount, 'is_return' => 0]);
            }

            SalesReturnList::where('sales_return_id', $id)->delete();
            foreach ($request->sales_list_id as $sales_list_id) {
                if ($request->return_qty[$sales_list_id] == 0 || is_null($request->return_qty[$sales_list_id])) {
                    continue;
                }
                $sales_list = SalesList::findOrFail($sales_list_id);

                $discount = ($sales_list->discount / $sales_list->amount) * ($sales_list->rate * $request->return_qty[$sales_list_id]);
                SalesReturnList::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'product_type' => 'Fashion',
                    'sales_return_id' => $sales_return->id,
                    'client_id' => $request->client_id,
                    'sales_list_id' => $sales_list_id,
                    'store_id' => $request->store_id,
                    'product_id' => $sales_list->product_id,
                    'variant_id' => $sales_list->variant_id,
                    'price' => $sales_list->rate,
                    'qty' => $request->return_qty[$sales_list_id],
                    'amount' => $sales_list->rate * $request->return_qty[$sales_list_id],
                    'sales_discount' => $discount,
                    'remarks' => $request->remarks,
                ]);

                $total_return_qty = $sales_list->returned_qty + $request->return_qty[$sales_list_id];
                $total_return_amount = $sales_list->returned_amount + ($sales_list->rate * $request->return_qty[$sales_list_id]) - $discount;
                if ($total_return_qty == $sales_list->qty) {
                    $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount, 'is_return' => 1]);
                } else {
                    $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount]);
                }
            }

            $client = Client::find($request->client_id);
            if ($client->coa) {
                $headCode = collect([
                    '0' => 30102,
                    '1' => $client->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $sales_return->return_no,
                        'voucher_type' => "Sales Return",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Sales Return Against RETURN NO - ' . $sales_return->return_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $store = Store::find($request->store_id);
            $products_info = '';
            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                $products_info .= ' ' . @$sales_list->product->name . ' variant : ' . @$sales_list->variant->sku . ' Quanity : ' . $request->return_qty[$sales_list_id] . ', ';
            }
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Sales Return',
                'action' => 'Add',
                'description' => 'Create a new sales Return with Return no ' . $sales_return->return_no . ' from client ' . $client->name . ' to store ' . $store->name . ' sales return amount is ' . $sales_return->amount . ' products ' . $products_info . ' for reason ' . $request->remarks,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->Route('admin.lifestyle-product-return.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                $data = SalesReturn::onlyTrashed()->findOrFail($id);
                foreach ($data->list as $item) {
                    $sales_list = SalesList::find($item->sales_list_id);
                    $returned_qty = $sales_list->returned_qty + $item->qty;
                    $returned_amount = $sales_list->returned_amount + $item->amount - $item->sales_discount;

                    if ($returned_qty == $sales_list->qty) {
                        $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount, 'is_return' => 1]);
                    } else {
                        $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount]);
                    }
                }
                AccountTransactionAuto::withTrashed()->where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->restore();
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () {
                foreach (request('id') as $id) {
                    $data = SalesReturn::onlyTrashed()->findOrFail($id);
                    AccountTransactionAuto::withTrashed()->where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->forceDelete();
                    $data->forceDelete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = SalesReturn::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::withTrashed()->where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->forceDelete();
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            DB::transaction(function () {
                foreach (request('id') as $id) {
                    $data = SalesReturn::findOrFail($id);
                    foreach ($data->list as $item) {
                        $sales_list = SalesList::find($item->sales_list_id);
                        $returned_qty = $sales_list->returned_qty - $item->qty;
                        $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                        $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount, 'is_return' => 0]);
                    }

                    $client = Client::find($data->client_id);
                    $products_info = '';
                    foreach ($data->list as $item) {
                        $sales_list = SalesList::findOrFail($item->sales_list_id);
                        $products_info .= ' ' . @$sales_list->product->name . ' variant : ' . @$sales_list->variant->sku . ' Quanity : ' . $item->qty . ', ';
                    }
                    AccessLog::create([
                        'date_time' => Carbon::now(),
                        'page' => 'Sales Return',
                        'action' => 'Delete',
                        'description' => 'Sales return delete return no ' . $data->return_no . ' client ' . $client->name . ' products ' . $products_info,
                        'user_id' => Auth::user()->id,
                    ]);

                    AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->delete();
                    AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->update(['deleted_by' => Auth::user()->id]);
                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        DB::transaction(function () use ($id) {
            $data = SalesReturn::findOrFail($id);
            foreach ($data->list as $item) {
                $sales_list = SalesList::find($item->sales_list_id);
                $returned_qty = $sales_list->returned_qty - $item->qty;
                $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount, 'is_return' => 0]);
            }

            $client = Client::find($data->client_id);
            $products_info = '';
            foreach ($data->list as $item) {
                $sales_list = SalesList::findOrFail($item->sales_list_id);
                $products_info .= ' ' . @$sales_list->product->name . ' variant : ' . @$sales_list->variant->sku . ' Quanity : ' . $item->qty . ', ';
            }
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Sales Return',
                'action' => 'Delete',
                'description' => 'Sales return delete return no ' . $data->return_no . ' client ' . $client->name . ' products ' . $products_info,
                'user_id' => Auth::user()->id,
            ]);
            AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->delete();
            AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Sales Return')->update(['deleted_by' => Auth::user()->id]);
            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
