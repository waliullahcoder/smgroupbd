<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Company;
use App\Models\RetailSale;
use Illuminate\Http\Request;
use App\Models\RetailReturn;
use App\Models\RetailSaleList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\RetailReturnList;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class RetailReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = RetailReturn::where('product_type', 'Consumer')->with(['store', 'staff'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
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
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.retail-return.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    if ($row->approve == 0 && $row->accounts_approve == 0 && $row->reject == 0) {
                        $type = request('type');
                        $data = [
                            'id' => $row->id,
                            'edit' => !empty($type) && $type == 'trash' ? false : true,
                        ];
                        $transaction = AccountTransaction::where('voucher_no', $row->return_no)->where('voucher_type', 'Retail Return')->first();
                        if (is_null($transaction)) {
                            return ActionButtons::actions($data, $actionBtn);
                        }
                    }
                    return $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.retail-return.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Retail Sales Return";
        return view('admin.retail_return.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = RetailReturn::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['return_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("RR", '', $data->return_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "RR" . $dataPrefix;
        } else {
            $invoice = "RR" . date('y') . date('m') . '0001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('retail_sale_id')) {
            $data = RetailSaleList::with(['product', 'sales'])->where('retail_sale_id', $request->retail_sale_id)->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        }

        if ($request->ajax()) {
            $query = $request->get('q', '');
            $items = RetailSale::where('client_name', 'like', '%' . $query . '%')
                ->orWhere('client_phone', 'like', '%' . $query . '%')
                ->orWhere('invoice', 'like', '%' . $query . '%')
                ->select('id', 'client_name', 'invoice')
                ->limit(10)
                ->get();

            return response()->json($items);
        }

        $title = 'Add New Retail Return';
        $stores = Store::where('status', 1)->get();
        $return_no = $this->invoice();
        return view('admin.retail_return.create', compact('title', 'stores', 'return_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'retail_sale_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'retail_sale_list_id' => 'required'
        ]);

        DB::transaction(function () use ($request, &$data) {
            $return_no = $this->invoice();

            $sale = RetailSale::findOrFail($request->retail_sale_id);
            $data = RetailReturn::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'retail_sale_id' => $request->retail_sale_id,
                'client_name' => $sale->client_name,
                'client_phone' => $sale->client_phone,
                'store_id' => $request->store_id,
                'return_no' => $return_no,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->return_amount,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->retail_sale_list_id as $retail_sale_list_id) {
                if ($request->return_qty[$retail_sale_list_id] == 0 || is_null($request->return_qty[$retail_sale_list_id])) {
                    continue;
                }
                $sales_list = RetailSaleList::findOrFail($retail_sale_list_id);

                $discount = ($sales_list->discount / $sales_list->qty) * $request->return_qty[$retail_sale_list_id];
                RetailReturnList::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'retail_return_id' => $data->id,
                    'retail_sale_id' => $request->retail_sale_id,
                    'retail_sale_list_id' => $retail_sale_list_id,
                    'store_id' => $request->store_id,
                    'product_id' => $sales_list->product_id,
                    'price' => $request->rate[$retail_sale_list_id],
                    'qty' => $request->return_qty[$retail_sale_list_id],
                    'amount' => $request->rate[$retail_sale_list_id] * $request->return_qty[$retail_sale_list_id],
                    'sales_discount' => $discount,
                    'remarks' => $request->remarks,
                ]);

                if ($product = Product::find($sales_list->product_id)) {
                    $product->increaseStock(
                        date('Y-m-d', strtotime($request->date)),
                        $request->store_id,
                        $request->return_qty[$retail_sale_list_id],
                        $request->rate[$retail_sale_list_id],
                        "Retail Return #{$return_no}",
                        "Stock increased due to retail return"
                    );
                }

                $total_return_qty = $sales_list->returned_qty + $request->return_qty[$retail_sale_list_id];
                $total_return_amount = $sales_list->returned_amount + ($sales_list->rate * $request->return_qty[$retail_sale_list_id]) - $discount;
                $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount]);
            }
        });

        return redirect()
            ->route('admin.running-sales.create', ['return_id' => $data->id])
            ->withSuccessMessage('Created Successfully!');
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
        $data = RetailReturn::findOrFail($id);
        $report_title = 'Retail Sales Return Voucher';
        // return view('admin.retail_return.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.retail_return.print', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('retail_return_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('retail_sale_id')) {
            $data = RetailSaleList::with(['product', 'sales'])->where('retail_sale_id', $request->retail_sale_id)->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        }

        if ($request->ajax()) {
            $query = $request->get('q', '');
            $items = RetailSale::where('client_name', 'like', '%' . $query . '%')
                ->orWhere('client_phone', 'like', '%' . $query . '%')
                ->orWhere('invoice', 'like', '%' . $query . '%')
                ->select('id', 'client_name', 'invoice')
                ->limit(10)
                ->get();

            return response()->json($items);
        }

        $title = 'Update Retail Sales Return';
        $stores = Store::where('status', 1)->get();
        $data = RetailReturn::findOrFail($id);
        $link = Route('admin.retail-return.update', $id);
        return view('admin.retail_return.edit', compact('title', 'stores', 'data', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'retail_sale_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'retail_sale_list_id' => 'required'
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = RetailReturn::findOrFail($id);

            $sale = RetailSale::findOrFail($request->retail_sale_id);
            $data->update([
                'retail_sale_id' => $request->retail_sale_id,
                'client_name' => $sale->client_name,
                'client_phone' => $sale->client_phone,
                'store_id' => $request->store_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->return_amount,
                'remarks' => $request->remarks,
                'updated_by' => Auth::user()->id,
            ]);

            foreach ($data->list as $item) {
                if ($product = Product::find($item->product_id)) {
                    $product->decreaseStock(
                        date('Y-m-d', strtotime($request->date)),
                        $request->store_id,
                        $item->qty,
                        $item->price,
                        "Retail Return Update Reversal #{$data->return_no}",
                        "Stock decreased due to retail return reversal"
                    );
                }
                $sales_list = RetailSaleList::find($item->retail_sale_list_id);
                $returned_qty = $sales_list->returned_qty - $item->qty;
                $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount]);
            }

            RetailReturnList::where('retail_return_id', $id)->delete();
            foreach ($request->retail_sale_list_id as $retail_sale_list_id) {
                if ($request->return_qty[$retail_sale_list_id] == 0 || is_null($request->return_qty[$retail_sale_list_id])) {
                    continue;
                }
                $sales_list = RetailSaleList::findOrFail($retail_sale_list_id);

                $discount = ($sales_list->discount / $sales_list->qty) * $request->return_qty[$retail_sale_list_id];
                RetailReturnList::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'retail_return_id' => $data->id,
                    'retail_sale_id' => $request->retail_sale_id,
                    'retail_sale_list_id' => $retail_sale_list_id,
                    'store_id' => $request->store_id,
                    'product_id' => $sales_list->product_id,
                    'price' => $request->rate[$retail_sale_list_id],
                    'qty' => $request->return_qty[$retail_sale_list_id],
                    'amount' => $request->rate[$retail_sale_list_id] * $request->return_qty[$retail_sale_list_id],
                    'sales_discount' => $discount,
                    'remarks' => $request->remarks,
                ]);

                if ($product = Product::find($sales_list->product_id)) {
                    $product->increaseStock(
                        date('Y-m-d', strtotime($request->date)),
                        $request->store_id,
                        $request->return_qty[$retail_sale_list_id],
                        $request->rate[$retail_sale_list_id],
                        "Retail Return Update #{$data->return_no}",
                        "Stock increased due to retail return update"
                    );
                }

                $total_return_qty = $sales_list->returned_qty + $request->return_qty[$retail_sale_list_id];
                $total_return_amount = $sales_list->returned_amount + ($sales_list->rate * $request->return_qty[$retail_sale_list_id]) - $discount;
                $sales_list->update(['returned_qty' => $total_return_qty, 'returned_amount' => $total_return_amount]);
            }
        });

        $ratailSale = RetailSale::withTrashed()->where('retail_return_id', $id)->first();
        return redirect()
            ->route('admin.running-sales.edit', $ratailSale->id)
            ->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                // Recovery Deleted Data
                $data = RetailReturn::onlyTrashed()->findOrFail($id);
                foreach ($data->list as $item) {
                    if ($product = Product::find($item->product_id)) {
                        $product->increaseStock(
                            date('Y-m-d'),
                            $data->store_id,
                            $item->qty,
                            $item->price,
                            "Retail Return Recovery #{$data->return_no}",
                            "Stock increased due to retail return recovery"
                        );
                    }
                    $sales_list = RetailSaleList::find($item->retail_sale_list_id);
                    $returned_qty = $sales_list->returned_qty + $item->qty;
                    $returned_amount = $sales_list->returned_amount + $item->amount - $item->sales_discount;
                    $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount]);
                }
                $ratailSale = RetailSale::withTrashed()->where('retail_return_id', $id)->first();
                if ($ratailSale) {
                    $ratailSale->restore();
                }
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                foreach (request('id') as $id) {
                    $data = RetailReturn::onlyTrashed()->findOrFail($id);
                    $ratailSale = RetailSale::withTrashed()->where('retail_return_id', $id)->first();
                    if ($ratailSale) {
                        $ratailSale->forceDelete();
                    }
                    $data->forceDelete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = RetailReturn::onlyTrashed()->findOrFail($id);
                $ratailSale = RetailSale::withTrashed()->where('retail_return_id', $id)->first();
                if ($ratailSale) {
                    $ratailSale->forceDelete();
                }
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            DB::transaction(function () use ($id) {
                foreach (request('id') as $id) {
                    $data = RetailReturn::findOrFail($id);
                    foreach ($data->list as $item) {
                        if ($product = Product::find($item->product_id)) {
                            $product->decreaseStock(
                                date('Y-m-d'),
                                $data->store_id,
                                $item->qty,
                                $item->price,
                                "Retail Return Delete #{$data->return_no}",
                                "Stock decreased due to retail return deletion"
                            );
                        }
                        $sales_list = RetailSaleList::find($item->retail_sale_list_id);
                        $returned_qty = $sales_list->returned_qty - $item->qty;
                        $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                        $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount]);
                    }

                    $ratailSale = RetailSale::where('retail_return_id', $id)->first();
                    if ($ratailSale) {
                        $ratailSale->update(['deleted_by' => Auth::user()->id]);
                        $ratailSale->delete();
                    }

                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        DB::transaction(function () use ($id) {
            $data = RetailReturn::findOrFail($id);
            foreach ($data->list as $item) {
                if ($product = Product::find($item->product_id)) {
                    $product->decreaseStock(
                        date('Y-m-d'),
                        $data->store_id,
                        $item->qty,
                        $item->price,
                        "Retail Return Delete #{$data->return_no}",
                        "Stock decreased due to retail return deletion"
                    );
                }
                $sales_list = RetailSaleList::find($item->retail_sale_list_id);
                $returned_qty = $sales_list->returned_qty - $item->qty;
                $returned_amount = $sales_list->returned_amount + $item->sales_discount - $item->amount;
                $sales_list->update(['returned_qty' => $returned_qty, 'returned_amount' => $returned_amount]);
            }

            $ratailSale = RetailSale::where('retail_return_id', $id)->first();
            if ($ratailSale) {
                $ratailSale->update(['deleted_by' => Auth::user()->id]);
                $ratailSale->delete();
            }

            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
