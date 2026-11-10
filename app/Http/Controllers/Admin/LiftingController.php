<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\Branch;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Lifting;
use App\Models\Product;
use App\Models\CoaSetup;
use App\Models\AccessLog;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Models\VendorPayment;
use App\Models\LiftingProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LiftingDocument;
use App\Models\LiftingReturnList;
use App\Models\VendorPaymentData;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Lifting::with(['company', 'project', 'staff', 'vendor'])->latest('id')->where('product_type', 'Consumer');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $payemnt = VendorPaymentData::where('lifting_id', $row->id)->whereHas('payment')->first();
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->lifting_no)->where('voucher_type', 'Product Purchase')->first();
                    $pay_transaction = AccountTransaction::withTrashed()->where('voucher_no', @$payemnt->payment->payment_no)->where('voucher_type', 'Vendor Payment')->first();
                    if (is_null($payemnt) && is_null($transaction) && is_null($pay_transaction)) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('lifting_date', function ($row) {
                    return date('d-m-Y', strtotime($row->lifting_date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifting.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>
                                    <a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifting-barcode.print', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Barcode" target="_blank"><i class="far fa-barcode-read"></i></a>';

                    $payemnt = VendorPaymentData::where('lifting_id', $row->id)->whereHas('payment')->first();
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->lifting_no)->where('voucher_type', 'Product Purchase')->first();
                    if (is_null($payemnt) && is_null($transaction) || !is_null($payemnt) && $row->payment_type == 'cash' && is_null($transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return '<div class="btn-group">' . $actionBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Product Lifting";
        return view('admin.lifting.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = Lifting::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['lifting_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("STL", '', $data->lifting_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STL" . $dataPrefix;
        } else {
            $invoice = "STL" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->get_product) {
            $product = Product::with(['price', 'category'])->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if ($request->ajax()) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->lifting_price;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->quantity[$product_id] + 1;
                $price = $request->lifting_price[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        $title = 'Add Product Lifting';
        $lifting_no = $this->invoice();
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.lifting.create', compact('title', 'lifting_no', 'vendors', 'stores', 'cash_heads', 'products','companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $request->validate([
                'lifting_no'    => 'required',
                'lifting_date'  => 'required',
                'vendor_id'     => 'required',
                'product_id'    => 'required|array|min:1',
                'lifting_price' => 'required',
                'quantity'      => 'required',
            ]);

            try {
                DB::transaction(function () use ($request) {
                    $lifting_no     = $this->invoice();
                    $total_cost     = (float) ($request->total_cost ?? 0);
                    $total_discount = (float) ($request->discount ?? 0);
                    $lifting_date   = date('Y-m-d', strtotime($request->lifting_date));

                    $lifting = Lifting::create([
                        'company_id'   => $request->company_id,
                        'branch_id'    => $request->project_id,
                        'store_id'     => $request->store_id,
                        'remarks'     => $request->remarks,
                        'vendor_id'    => $request->vendor_id,
                        'tax'    => $request->tax,
                        'tax_amount'    => $request->tax_amount,
                        'coa_setup_id' => $request->coa_setup_id,
                        'lifting_no'   => $lifting_no,
                        'voucher_no'   => $request->voucher_no,
                        'payment_type' => $request->payment_type,
                        'lifting_date' => $lifting_date,
                        'total_cost'   => $total_cost,
                        'discount'     => $total_discount,
                        'net_amount'   => $total_cost - $total_discount,
                        'total_paid'   => $request->payment_type == 'cash' ? $request->net_payable : 0.00,
                        'created_by'   => Auth::user()->id,
                    ]);

                    foreach ($request->product_id as $product_id) {
                        $product = Product::findOrFail($product_id);
                        $amount  = (float) $request->amount[$product_id];

                        // total_cost 0 hole division by zero na hoy
                        $discount = $total_cost > 0 ? ($total_discount / $total_cost) * $amount : 0;
                        $total_paid = $request->payment_type == 'cash' ? $amount - $discount : 0;

                        LiftingProduct::create([
                            'lifting_id'    => $lifting->id,
                            'company_id'    => Auth::user()->company_id ?? 1,
                            'store_id'      => $request->store_id,
                            'vendor_id'     => $request->vendor_id,
                            'product_id'    => $product_id,
                            'total_amount'  => $amount,
                            'total_paid'    => $total_paid,
                            'lifting_price' => $request->lifting_price[$product_id],
                            'discount'      => $discount,
                            'net_amount'    => $amount - $discount,
                            'expiry_date'   => !empty($request->expiry_date[$product_id])
                                ? date('Y-m-d', strtotime($request->expiry_date[$product_id]))
                                : null,
                            'qty'           => $request->quantity[$product_id],
                            'created_by'    => Auth::user()->id,
                        ]);

                        $product->increaseStock(
                            $lifting_date,
                            $request->store_id,
                            $request->quantity[$product_id],
                            $request->lifting_price[$product_id],
                            "Purchase #{$lifting->lifting_no}",
                            "Stock increased from purchase"
                        );
                    }
                });

                return redirect()->route('admin.lifting.index')
                    ->withSuccessMessage('Created Successfully!');

            } catch (ValidationException $e) {
                throw $e;
            } catch (\Throwable $e) {
                dd($e);
                Log::error('Lifting store failed: ' . $e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);

                return redirect()->back()
                    ->withInput()
                    ->withErrorMessage('Something went wrong! Please try again.');
            }
        }

    public function barcodePrint(Request $request, string $id)
    {
        ini_set('max_execution_time', '500');
        ini_set("pcre.backtrack_limit", "5000000");

        $data = Lifting::findOrFail($id);
        return view('admin.lifting.barcode_print', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Lifting::findOrFail($id);
        $report_title = 'Lifting Voucher';
        // return view('admin.lifting.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.lifting.print', compact('title', 'informations', 'report_title', 'data'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('product_lifting_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    public function showDocument(string $id)
    {
        $lifting_documents =  LiftingDocument::where('lifting_id', $id)->get();
        $zip = new ZipArchive();
        $fileName = 'downloads.zip';
        // Add File in ZipArchive
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            foreach ($lifting_documents as $file) {
                $path =  public_path($file->document);
                $relativeName = basename($path);
                $zip->addFile($path, $relativeName);
            }
        }
        // Close ZipArchive
        $zip->close();
        return response()->download($fileName);
    }

    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->get_product) {
            $product = Product::with(['price', 'category'])->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if ($request->ajax()) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->lifting_price;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->quantity[$product_id] + 1;
                $price = $request->lifting_price[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        $title = 'Update Lifting Products';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $data = Lifting::findOrFail($id);
        $lifting_products = LiftingProduct::with(['product'])->where('lifting_id', $id)->get();
        $link = Route('admin.lifting.update', $id);
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
       $companies = Company::orderBy('name', 'asc')->get();
        $projects  = Branch::where('company_id', $data->company_id)->orderBy('name', 'asc')->get(['id', 'name']);

        return view('admin.lifting.edit', compact(
            'title', 'vendors', 'stores', 'data', 'lifting_products', 'link', 'products', 'cash_heads',
            'companies', 'projects'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lifting_no'    => 'required',
            'lifting_date'  => 'required',
            'company_id'    => 'required',
            'project_id'    => 'required',
            'vendor_id'     => 'required',
            'product_id'    => 'required|array|min:1',
            'lifting_price' => 'required',
            'quantity'      => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $lifting      = Lifting::findOrFail($id);
                $oldStoreId   = $lifting->store_id;
                $lifting_date = date('Y-m-d', strtotime($request->lifting_date));

                $total_cost     = (float) ($request->total_cost ?? 0);
                $total_discount = (float) ($request->discount ?? 0);
                $tax_percent    = (float) ($request->tax ?? 0);
                $tax_amount     = round(($total_cost - $total_discount) * $tax_percent / 100, 2);
                $net_amount     = $total_cost - $total_discount + $tax_amount;

                $lifting->update([
                    'company_id'   => $request->company_id,
                    'branch_id'    => $request->project_id,
                    'store_id'     => $request->store_id,
                    'vendor_id'    => $request->vendor_id,
                    'coa_setup_id' => $request->coa_setup_id,
                    'voucher_no'   => $request->voucher_no,
                    'payment_type' => $request->payment_type,
                    'lifting_date' => $lifting_date,
                    'total_cost'   => $total_cost,
                    'discount'     => $total_discount,
                    'tax'          => $tax_percent,
                    'tax_amount'   => $tax_amount,
                    'net_amount'   => $net_amount,
                    'remarks'     => $request->remarks,
                    'total_paid'   => $request->payment_type == 'cash' ? $net_amount : 0.00,
                    'updated_by'   => Auth::user()->id,
                ]);

                $existingIds = $lifting->products()->pluck('id')->toArray();
                $updatedIds  = [];

                foreach ($request->product_id as $product_id) {
                    $amount   = (float) $request->amount[$product_id];
                    $discount = $total_cost > 0 ? ($total_discount / $total_cost) * $amount : 0;
                    $total_paid = $request->payment_type == 'cash' ? $amount - $discount : 0;

                    $existingItem = $lifting->products()->where('product_id', $product_id)->first();
                    $oldQty = $existingItem ? $existingItem->qty : 0;

                    $item = $lifting->products()->updateOrCreate(
                        ['product_id' => $product_id],
                        [
                            'company_id'    => Auth::user()->company_id ?? 1,
                            'store_id'      => $request->store_id,
                            'vendor_id'     => $request->vendor_id,
                            'total_amount'  => $amount,
                            'total_paid'    => $total_paid,
                            'lifting_price' => $request->lifting_price[$product_id],
                            'discount'      => $discount,
                            'net_amount'    => $amount - $discount,
                            'expiry_date'   => !empty($request->expiry_date[$product_id])
                                ? date('Y-m-d', strtotime($request->expiry_date[$product_id]))
                                : null,
                            'qty'           => $request->quantity[$product_id],
                            'created_by'    => Auth::user()->id,
                        ]
                    );

                    $updatedIds[] = $item->id;

                    // Stock adjust (sudhu difference)
                    $diff = $request->quantity[$product_id] - $oldQty;
                    if ($diff != 0 && ($product = Product::find($product_id))) {
                        if ($diff > 0) {
                            $product->increaseStock($lifting_date, $request->store_id, $diff,
                                $request->lifting_price[$product_id],
                                "Purchase #{$lifting->lifting_no}", "Stock increased from purchase update");
                        } else {
                            $product->decreaseStock($lifting_date, $oldStoreId, abs($diff),
                                $request->lifting_price[$product_id],
                                "Purchase #{$lifting->lifting_no}", "Stock decreased from purchase update");
                        }
                    }
                }

                // Jei item gulo form theke remove hoyeche
                foreach (array_diff($existingIds, $updatedIds) as $rmId) {
                    $rmItem = $lifting->products()->find($rmId);
                    if ($rmItem && ($oldProduct = Product::find($rmItem->product_id))) {
                        $oldProduct->decreaseStock($lifting_date, $oldStoreId, $rmItem->qty,
                            $rmItem->lifting_price,
                            "Purchase #{$lifting->lifting_no}", "Removed from purchase update");
                    }
                    $rmItem?->delete();
                }
            });

            return redirect()->route('admin.lifting.index')
                ->withSuccessMessage('Updated Successfully!');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Lifting update failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrorMessage('Something went wrong! Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {

                $recovery = request()->boolean('recovery');
                $permanent = request()->boolean('parmanent');
                $ids = request('id') ?? [$id];

                // --- Recovery ---
                if ($recovery) {
                    $data = Lifting::onlyTrashed()->findOrFail($id);

                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->restore();

                    $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
                    if ($payment) {
                        AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->restore();
                        $payment->restore();
                    }

                    // --- Restore stock ---
                    foreach ($data->products as $item) {
                        if ($product = $item->product) {
                            $product->increaseStock(date('Y-m-d'), $data->store_id, $item->qty, $item->lifting_price, "Purchase #{$data->lifting_no} restored", "Stock increased due to purchase recovery");
                        }
                    }

                    $data->restore();

                    return response()->json(['status' => 'success', 'message' => 'Recovered Successfully!']);
                }

                // --- Permanent Delete ---
                if ($permanent) {
                    $items = Lifting::withTrashed()->whereIn('id', $ids)->get();
                    foreach ($items as $data) {
                        AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
                        $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
                        if ($payment) {
                            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                            $payment->forceDelete();
                        }
                        // Delete purchase permanently
                        $data->forceDelete();
                    }
                    return response()->json(['status' => 'success', 'message' => 'Permanently Deleted!']);
                }

                // --- Soft Delete ---
                $items = Lifting::with('products.product')->whereIn('id', $ids)->get();
                foreach ($items as $data) {
                    foreach ($data->products as $item) {
                        $checkReturn = LiftingReturnList::where('lifting_product_id', $item->id)->count();
                        if ($checkReturn) {
                            throw new \Exception("Cannot delete purchase #{$data->lifting_no} because it has associated return records.");
                        }
                    }
                    AccountTransactionAuto::where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->delete();
                    $payment = VendorPayment::where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();

                    AccessLog::create([
                        'date_time' => Carbon::now(),
                        'page' => 'Purchase',
                        'action' => 'Delete',
                        'description' => 'Purchase delete against purchase no ' . $data->lifting_no . (!is_null($payment) ? ' payment delete ' . $payment->payment_no  : ''),
                        'user_id' => Auth::user()->id,
                    ]);

                    if ($payment) {
                        AccountTransactionAuto::where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->delete();
                        $payment->update(['deleted_by' => Auth::user()->id]);
                        $payment->delete();
                    }

                    // Reverse stock
                    foreach ($data->products as $item) {
                        if ($product = $item->product) {
                            $product->decreaseStock(date('Y-m-d'), $data->store_id, $item->qty, $item->lifting_price, "Purchase #{$data->lifting_no} deleted", "Stock decreased due to purchase deletion");
                        }
                    }

                    $data->update(['deleted_by' => Auth::user()->id]);
                    // Soft delete purchase
                    $data->delete();
                }

                return response()->json(['status' => 'success', 'message' => 'Successfully Deleted!']);
            });
        } catch (\Throwable $e) {
            // info($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
