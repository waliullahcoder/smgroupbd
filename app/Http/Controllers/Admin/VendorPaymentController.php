<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\Company;
use App\Models\Branch;
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

        if ($request->ajax() && $request->has('get_heads')) {
            if ($request->type == 'Cash') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash In Hand');
                })->get();
            }
            if ($request->type == 'Bank') {
                $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
                    $query->where('head_name', 'Cash at Bank');
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
         $companies = Company::orderBy('name', 'asc')->get();

        return view('admin.vendor_payment.create', compact('title', 'vendors', 'payment_no', 'cash_heads','companies'));
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

        DB::transaction(function () use ($request) {
            $payment_no = $this->paymentNo();
            $vendor_payment = VendorPayment::create([
                'company_id' => $request->company_id,
                'branch_id' => $request->project_id,
                'vendor_id' => $request->vendor_id,
                'payment_no' => $payment_no,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'payment_type' => 'Purchase',
                'type' => $request->type,
                'amount' => $request->total_paid,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

          
            $vendor = Vendor::findOrFail($request->vendor_id);
            if ($request->coa_setup_id) {
                $expData[] = [
                            'company_id' => $request->company_id,
                            'branch_id' => $request->project_id,
                            'expense_head_id' => $request->coa_setup_id,
                            'expense_month' => Carbon::now()->month,
                            'expense_year' => Carbon::now()->year,
                            'expense_amount' => $request->total_paid,
                            'expense_date' => date('Y-m-d', strtotime($request->payment_date)),
                            'remarks' => 'Payment for Purchase Against PAYMENT NO - ' . $vendor_payment->payment_no . ", " . $request->remarks,
                            'status' => 'Approved',
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                DB::table('hrm_expense')->insert($expData);

                $postData = [];
                    $coasetup = CoaSetup::find($request->coa_setup_id);
                    $postData[] = [
                        'company_id' => $request->company_id,
                        'branch_id' => $request->project_id,
                        'voucher_no' => $vendor_payment->payment_no,
                        'voucher_type' => "Purchase",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $request->coa_setup_id,
                        'coa_head_code' => $coasetup->heade_name,
                        'narration' => 'Payment for Purchase Against PAYMENT NO - ' . $vendor_payment->payment_no.", ". $request->remarks,
                        'debit_amount' => $request->total_paid,
                        'credit_amount' => 0,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                AccountTransactionAuto::insert($postData);
            }
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
                $query->where('head_name', 'Cash at Bank');
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

              $companies = Company::orderBy('name', 'asc')->get();
            $projects = Branch::where('company_id', $data->company_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return view('admin.vendor_payment.edit', compact('title', 'data', 'link', 'vendors', 'cash_heads', 'selected_head', 'due', 'advance', 'purchases','companies','projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'vendor_id' => 'required',
            'payment_date' => 'required',
            'type' => 'required',
            'payment_type' => 'required',
        ]);

        if ($request->total_paid <= 0) {
            return redirect()->back()->withErrors('Payment amount must be greater than 0!');
        }

        DB::transaction(function () use ($request, $id) {

            $vendor_payment = VendorPayment::findOrFail($id);

            $vendor_payment->update([
                'company_id' => $request->company_id,
                'branch_id' => $request->project_id,
                'vendor_id' => $request->vendor_id,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'payment_type' => 'Purchase',
                'type' => $request->type,
                'amount' => $request->total_paid,
                'remarks' => $request->remarks,
            ]);

            $paymentNo = $vendor_payment->payment_no;

            // Expense Update
            $expense = DB::table('hrm_expense')
                ->where('remarks', 'LIKE', '%PAYMENT NO - ' . $paymentNo . '%')
                ->first();

            if ($request->coa_setup_id) {

                $expData = [
                    'company_id' => $request->company_id,
                    'branch_id' => $request->project_id,
                    'expense_head_id' => $request->coa_setup_id,
                    'expense_month' => Carbon::now()->month,
                    'expense_year' => Carbon::now()->year,
                    'expense_amount' => $request->total_paid,
                    'expense_date' => date('Y-m-d', strtotime($request->payment_date)),
                    'remarks' => 'Payment for Purchase Against PAYMENT NO - ' . $paymentNo . ", " . $request->remarks,
                    'status' => 'Approved',
                    'created_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ];

                if ($expense) {
                    DB::table('hrm_expense')
                        ->where('id', $expense->id)
                        ->update($expData);
                } else {
                    $expData['created_at'] = Carbon::now();
                    DB::table('hrm_expense')->insert($expData);
                }

                // Account Transaction Update
                $coasetup = CoaSetup::findOrFail($request->coa_setup_id);

                $postData = [
                    'company_id' => $request->company_id,
                    'branch_id' => $request->project_id,
                    'voucher_no' => $paymentNo,
                    'voucher_type' => 'Purchase',
                    'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                    'coa_setup_id' => $request->coa_setup_id,
                    'coa_head_code' => $coasetup->heade_name,
                    'narration' => 'Payment for Purchase Against PAYMENT NO - ' . $paymentNo . ", " . $request->remarks,
                    'debit_amount' => $request->total_paid,
                    'credit_amount' => 0,
                    'created_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ];

                $transaction = AccountTransactionAuto::where('voucher_no', $paymentNo)
                    ->where('voucher_type', 'Purchase')
                    ->first();

                if ($transaction) {
                    $transaction->update($postData);
                } else {
                    $postData['created_at'] = Carbon::now();
                    AccountTransactionAuto::create($postData);
                }

            } else {

                // COA remove করলে related expense ও transaction delete
                DB::table('hrm_expense')
                    ->where('remarks', 'LIKE', '%PAYMENT NO - ' . $paymentNo . '%')
                    ->delete();

                AccountTransactionAuto::where('voucher_no', $paymentNo)
                    ->where('voucher_type', 'Purchase')
                    ->delete();
            }
        });

        return redirect()->route('admin.vendor-payment.index')
            ->withSuccessMessage('Updated Successfully!');
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
