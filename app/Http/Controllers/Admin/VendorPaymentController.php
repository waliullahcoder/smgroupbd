<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\Company;
use App\Models\Lifting;
use App\Models\Scopes\CompanyScope;
use App\Models\Vendor;
use App\Models\LiftingReturn;
use App\Models\LiftingReturnList;
use App\Models\VendorPayment;
use App\Models\VendorPaymentData;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = VendorPayment::with(['company', 'vendor', 'staff'])->whereNot('type', 'return')->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $pay_transaction = AccountTransactionAuto::withTrashed()->where('voucher_no', $row->payment_no)->where('voucher_type', 'Vendor Payment')->first();
                    if (!is_null($pay_transaction) && $pay_transaction->posted == 0 || is_null($pay_transaction)) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->payment_date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];

                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info" href="' . Route('admin.vendor-payment.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    $pay_transaction = AccountTransactionAuto::withTrashed()->where('voucher_no', $row->payment_no)->where('voucher_type', 'Vendor Payment')->first();
                    if (!is_null($pay_transaction) && $pay_transaction->posted == 0 || is_null($pay_transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Vendor Payment";
        return view('admin.vendor_payment.index', compact('title'));
    }

    public function paymentNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $pay_data = VendorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($pay_data) {
            $trim = str_replace("STP", '', $pay_data->payment_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STP" . $dataPrefix;
        } else {
            $invoice = "STP" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $returns = LiftingReturnList::get();
        // foreach ($returns as $data) {
        //     $data->update(['lifting_id' => $data->lifting_product->lifting_id]);
        // }
        // return;

        // $purchases = \App\Models\LiftingProduct::get();
        // foreach ($purchases as $item) {
        //     $net_amount = $item->total_amount - $item->discount;
        //     $item->update([
        //         'net_amount' => $net_amount,
        //         'return_amount' => ($net_amount / $item->qty) * $item->return_qty
        //     ]);
        // }
        // return;

        // $purchases = Lifting::with('products')->get();
        // foreach ($purchases as $item) {
        //     $item->update([
        //         'net_amount' => $item->total_cost - $item->discount
        //     ]);
        // }
        // return;

        // DB::transaction(function () {
        //     $returns = LiftingReturn::get();
        //     foreach ($returns as $data) {
        //         $previous_payment = 0;
        //         $purchases = Lifting::whereIn('id', $data->list->pluck('lifting_id')->toArray())->get();
        //         foreach ($purchases as $item) {
        //             $balance = $item->total_paid + $item->return_amount - $item->net_amount;
        //             $previous_payment +=  $balance > 0 ? $balance : 0;
        //         }

        //         if ($previous_payment > 0) {
        //             $payment_no = $this->paymentNo();
        //             VendorPayment::create([
        //                 'company_id' => Auth::user()->company_id ?? 1,
        //                 'vendor_id' => $data->vendor_id,
        //                 'lifting_return_id' => $data->id,
        //                 'payment_no' => $payment_no,
        //                 'payment_date' => date('Y-m-d', strtotime($data->date)),
        //                 'payment_type' => 'return',
        //                 'type' => 'return',
        //                 'amount' => $previous_payment,
        //                 'remarks' => 'Paid on Return Products',
        //                 'created_by' => Auth::user()->id,
        //             ]);
        //         }
        //     }
        // });
        // return;

        if ($request->ajax() && $request->has('get_heads')) {
            if ($request->type == 'Cash') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash In Hand');
                })->get();
            }
            if ($request->type == 'Bank') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash In Bank');
                })->get();
            }
            return response()->json(['status' => 'success', 'cash_heads' => $cash_heads]);
        }

        if ($request->ajax()) {
            $purchase_amount = Lifting::where('vendor_id', $request->vendor_id)->sum('net_amount');
            $total_paid = VendorPayment::where('vendor_id', $request->vendor_id)->whereIn('type', ['payment', 'adjust'])->sum('amount');
            $due = round($purchase_amount - $total_paid, 2);
            $advance = VendorPayment::where('vendor_id', $request->vendor_id)->whereIn('type', ['return', 'advance'])->sum('amount')
                - VendorPayment::where('vendor_id', $request->vendor_id)->where('type', 'adjust')->sum('amount');

            $purchases = Lifting::where('vendor_id', $request->vendor_id)->whereColumn('net_amount', '>', DB::raw('total_paid+return_amount'))->get();

            return response()->json([
                'status' => 'success',
                'due' => round(max(0, $due), 2),
                'advance' => round($advance, 2),
                'data' => view('admin.vendor_payment.partial.rows', compact('purchases'))->render()
            ]);
        }

        $title = 'Add Payment';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $payment_no = $this->paymentNo();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand');
        })->get();
        return view('admin.vendor_payment.create', compact('title', 'vendors', 'payment_no', 'cash_heads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'payment_no' => 'required',
            'payment_date' => 'required',
            'type' => 'required',
            'payment_type' => 'required',
        ]);

        if ($request->total_paid <= 0) {
            return redirect()->back()->withErrors('Payment amount must be greater than 0!');
        }

        if ($request->type == 'payment' || $request->type == 'adjust') {
            $request->validate([
                'lifting_id' => 'required',
            ]);
        }

        DB::transaction(function () use ($request) {
            $payment_no = $this->paymentNo();
            $vendor_payment = VendorPayment::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'vendor_id' => $request->vendor_id,
                'payment_no' => $payment_no,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'payment_type' => $request->payment_type,
                'type' => $request->type,
                'amount' => $request->total_paid,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            $invoices = [];
            if ($request->type == 'payment' || $request->type == 'adjust') {
                foreach ($request->lifting_id as $lifting_id) {
                    $lifting = Lifting::findOrFail($lifting_id);

                    $invoices[] = @$lifting->lifting_no;
                    $paid = $lifting->total_paid + $request->curr_payment[$lifting_id];
                    $lifting->update([
                        'total_paid' => $paid,
                    ]);

                    VendorPaymentData::create([
                        'vendor_payment_id' => $vendor_payment->id,
                        'lifting_id' => $lifting_id,
                        'paid' => $request->curr_payment[$lifting_id],
                    ]);
                }
            }

            $vendor = Vendor::findOrFail($request->vendor_id);
            $adminSettings = AdminSetting::first();
            if ($adminSettings->accounting == 1 && $vendor->coa && $request->type != 'adjust') {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $vendor->coa->head_code,
                    '1' => $cash_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $request->total_paid,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->total_paid,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $vendor_payment->payment_no,
                        'voucher_type' => "Vendor Payment",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Payment Vendor Against PAYMENT NO - ' . $vendor_payment->payment_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $filtered_invoices = implode(',', $invoices);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Vendor Payment',
                'action' => 'Add',
                'description' => 'Create a new Payment with payment no ' . $vendor_payment->payment_no . ' to ' . $vendor->name . ' amount is ' . $vendor_payment->amount . ' payment type ' . $request->type . ($request->collection_type != 'advance' ? ' and purchase no ' . $filtered_invoices : ''),
                'user_id' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.vendor-payment.index')->withSuccessMessage('Created Successfully!');
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
        $data = VendorPayment::findOrFail($id);
        $report_title = 'Payment Voucher';
        // return view('admin.vendor_payment.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.vendor_payment.print', compact('title', 'informations', 'report_title', 'data'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('vendor_payment_invoice_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_heads')) {
            if ($request->type == 'Cash') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash In Hand');
                })->get();
            }
            if ($request->type == 'Bank') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash In Bank');
                })->get();
            }
            return response()->json(['status' => 'success', 'cash_heads' => $cash_heads]);
        }

        if ($request->ajax()) {
            $data = VendorPayment::findOrFail($id);
            $purchase_amount = Lifting::where('vendor_id', $request->vendor_id)->sum('net_amount');
            $total_paid = VendorPayment::where('vendor_id', $request->vendor_id)->whereNot('id', $id)->whereIn('type', ['payment', 'adjust'])->sum('amount');
            $due = round($purchase_amount - $total_paid, 2);
            $advance = VendorPayment::where('vendor_id', $request->vendor_id)->whereNot('id', $id)->whereIn('type', ['return', 'advance'])->sum('amount')
                - VendorPayment::where('vendor_id', $request->vendor_id)->whereNot('id', $id)->where('type', 'adjust')->sum('amount');

            $purchases = Lifting::where('vendor_id', $request->vendor_id)
                ->where(function ($query) use ($data, $request) {
                    $query->whereColumn('net_amount', '>', DB::raw('total_paid+return_amount'));
                    if ($data->vendor_id == $request->vendor_id) {
                        $query->orWhereIn('id', $data->payment_data->pluck('lifting_id')->toArray());
                    }
                })
                ->get();
            $type = $request->type;
            return response()->json([
                'status' => 'success',
                'due' => round(max(0, $due), 2),
                'advance' => round($advance, 2),
                'data' => view('admin.vendor_payment.partial.table_rows', compact('purchases', 'data', 'advance', 'type'))->render()
            ]);
        }

        $title = 'Update Payment';
        $data = VendorPayment::findOrFail($id);
        $link = Route('admin.vendor-payment.update', $id);
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $payment_type = $data->payment_type;
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) use ($payment_type) {
            if ($payment_type == 'Cash') {
                $query->where('head_name', 'Cash In Hand');
            } elseif ($payment_type == 'Bank') {
                $query->where('head_name', 'Cash In Bank');
            }
        })->get();
        $selected_head = AccountTransactionAuto::where('voucher_type', 'Vendor Payment')->where('voucher_no', $data->payment_no)->where('credit_amount', '>', 0)->first();

        $purchase_amount = Lifting::where('vendor_id', $data->vendor_id)->sum('net_amount');
        $total_paid = VendorPayment::where('vendor_id', $data->vendor_id)->whereNot('id', $id)->whereIn('type', ['payment', 'adjust'])->sum('amount');
        $due = round($purchase_amount - $total_paid, 2);
        $advance = VendorPayment::where('vendor_id', $data->vendor_id)->whereNot('id', $id)->whereIn('type', ['return', 'advance'])->sum('amount')
            - VendorPayment::where('vendor_id', $data->vendor_id)->whereNot('id', $id)->where('type', 'adjust')->sum('amount');

        $purchases = Lifting::where('vendor_id', $data->vendor_id)
            ->where(function ($query) use ($data) {
                $query->whereColumn('net_amount', '>', DB::raw('total_paid+return_amount'))
                    ->orWhereIn('id', $data->payment_data->pluck('lifting_id')->toArray());
            })
            ->get();

        return view('admin.vendor_payment.edit', compact('title', 'data', 'link', 'vendors', 'cash_heads', 'selected_head', 'due', 'advance', 'purchases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vendor_id' => 'required',
            'payment_no' => 'required',
            'payment_date' => 'required',
            'type' => 'required',
            'payment_type' => 'required',
        ]);

        if ($request->total_paid <= 0) {
            return redirect()->back()->withErrors('Payment amount must be greater than 0!');
        }

        if ($request->type == 'payment' || $request->type == 'adjust') {
            $request->validate([
                'lifting_id' => 'required',
            ]);
        }

        DB::transaction(function () use ($request, $id) {
            $vendor_payment = VendorPayment::findOrFail($id);
            AccountTransactionAuto::withTrashed()->where('voucher_no', $vendor_payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();

            foreach ($vendor_payment->payment_data as $item) {
                $lifting = Lifting::findOrFail($item->lifting_id);
                $total_paid = $lifting->total_paid - $item->paid;
                $lifting->update(['total_paid' => $total_paid]);
            }
            VendorPaymentData::where('vendor_payment_id', $id)->delete();

            $vendor_payment->update([
                'vendor_id' => $request->vendor_id,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'payment_type' => $request->payment_type,
                'type' => $request->type,
                'amount' => $request->total_paid,
                'remarks' => $request->remarks,
            ]);

            $invoices = [];
            if ($request->type == 'payment' || $request->type == 'adjust') {
                foreach ($request->lifting_id as $lifting_id) {
                    $lifting = Lifting::findOrFail($lifting_id);
                    $invoices[] = @$lifting->lifting_no;
                    $paid = $lifting->total_paid + $request->curr_payment[$lifting_id];
                    $lifting->update([
                        'total_paid' => $paid,
                    ]);

                    VendorPaymentData::create([
                        'vendor_payment_id' => $vendor_payment->id,
                        'lifting_id' => $lifting_id,
                        'paid' => $request->curr_payment[$lifting_id],
                    ]);
                }
            }

            $vendor = Vendor::findOrFail($request->vendor_id);
            $adminSettings = AdminSetting::first();
            if ($adminSettings->accounting == 1 && $vendor->coa && $request->type != 'adjust') {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $vendor->coa->head_code,
                    '1' => $cash_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $request->total_paid,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->total_paid,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', (Auth::user()->company_id ?? 1))->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $vendor_payment->payment_no,
                        'voucher_type' => "Vendor Payment",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Payment Vendor Against PAYMENT NO - ' . $vendor_payment->payment_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $filtered_invoices = implode(',', $invoices);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Vendor Payment',
                'action' => 'Update',
                'description' => 'Update Payment against payment no ' . $vendor_payment->payment_no . ' to ' . $vendor->name . ' amount is ' . $vendor_payment->amount . ' payment type ' . $request->type . ($request->collection_type != 'advance' ? ' and purchase no ' . $filtered_invoices : ''),
                'user_id' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.vendor-payment.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                $data = VendorPayment::onlyTrashed()->findOrFail($id);
                foreach ($data->payment_data as $item) {
                    $lifting = Lifting::find($item->lifting_id);
                    if ($lifting) {
                        $paid = $lifting->total_paid + $item->paid;
                        $lifting->update([
                            'total_paid' => $paid,
                        ]);
                    }
                }
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Vendor Payment')->restore();
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                foreach (request('id') as $id) {
                    $data = VendorPayment::onlyTrashed()->findOrFail($id);
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                    $data->forceDelete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                DB::transaction(function () use ($id) {
                    $data = VendorPayment::onlyTrashed()->findOrFail($id);
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                    $data->forceDelete();
                });
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            DB::transaction(function () {
                foreach (request('id') as $id) {
                    $data = VendorPayment::findOrFail($id);
                    foreach ($data->payment_data as $item) {
                        $lifting = Lifting::find($item->lifting_id);
                        if ($lifting) {
                            $paid = $lifting->total_paid - $item->paid;
                            $lifting->update([
                                'total_paid' => $paid,
                            ]);
                        }
                    }
                    AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Vendor Payment')->delete();
                    AccessLog::create([
                        'date_time' => Carbon::now(),
                        'page' => 'Vendor Payment',
                        'action' => 'Delete',
                        'description' => 'Payment delete against payment no ' . $data->payment_no . ' payment type was ' . $data->type,
                        'user_id' => Auth::user()->id,
                    ]);
                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        DB::transaction(function () use ($id) {
            $data = VendorPayment::findOrFail($id);
            AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Vendor Payment')->delete();
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Vendor Payment',
                'action' => 'Delete',
                'description' => 'Payment delete against payment no ' . $data->payment_no . ' payment type was ' . $data->type,
                'user_id' => Auth::user()->id,
            ]);
            foreach ($data->payment_data as $item) {
                $lifting = Lifting::find($item->lifting_id);
                if ($lifting) {
                    $paid = $lifting->total_paid - $item->paid;
                    $lifting->update([
                        'total_paid' => $paid,
                    ]);
                }
            }
            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
