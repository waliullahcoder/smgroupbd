<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Invest;
use App\Models\CoaSetup;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class InvestController extends Controller
{
    public $path;
    public $title;
    public $create_title;
    public $edit_title;
    public $model;
    public function __construct()
    {
        $this->path = 'invest';
        $this->title = 'invest Process';
        $this->create_title = 'Add invest';
        $this->edit_title = 'Update invest';
        $this->model = Invest::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = $this->model::with(['investor'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            $sumValue = number_format($model->sum('amount'));
            return DataTables::eloquent($model)
                ->with('sumValue', $sumValue)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $transaction  = AccountTransaction::where('voucher_no', $row->invest_no)
                        ->where('credit_amount', '>', 0)
                        ->where('voucher_type', 'Invest')
                        ->first();
                    $addiotional_buttons = '<a class="btn btn-sm border-0 px-10px btn-primary mw-fit text-white tt" href="' . Route('admin.invest.show', $row->id) . '" style="min-height: 28px;" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i></a>';

                    if (is_null($transaction)) {
                        return ActionButtons::actions($data, $addiotional_buttons);
                    }
                    return $addiotional_buttons;
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        return view("admin.{$this->path}.index", ['title' => $this->title]);
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = $this->model::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['invest_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("FDI", '', $data->invest_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "FDI" . $dataPrefix;
        } else {
            $invoice = "FDI" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->create_title;
        $invest_no = $this->invoice();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        $investors = Investor::where('status', 1)->get();
        return view("admin.{$this->path}.create", compact('title', 'invest_no', 'cash_heads', 'investors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'investor_id' => 'required',
            'coa_setup_id' => 'required',
            'date' => 'required',
            'invest_no' => 'required',
            'qty' => 'required',
            'amount' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            $invest_no = $this->invoice();
            $data = $this->model::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'investor_id' => $request->investor_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'invest_no' => $invest_no,
                'qty' => $request->qty,
                'amount' => $request->amount,
                'coa_setup_id' => $request->coa_setup_id,
                'status' => 'Approved',
                'approved' => 1,
                'created_by' => Auth::user()->id,
            ]);

            Wallet::create([
                'investor_id' => $request->investor_id,
                'invest_id' => $data->id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount_in' => $request->amount,
                'type' => 'Invest',
                'approved' => 1,
                'created_by' => Auth::user()->id,
            ]);

            $investor = Investor::findOrFail($request->investor_id);
            if (@$investor->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $cash_head->head_code,
                    '1' => $investor->coa->head_code,
                ]);
                $countHead = count($headCode);

                $debit_amount = collect([
                    '0' => $request->amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->amount,
                ]);

                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $invest_no,
                        'voucher_type' => "Invest",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Invest against Invest No - ' . $invest_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route("admin.{$this->path}.index")->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model::findOrFail($id);
        $title = 'View Invest';
        return view("admin.{$this->path}.view", compact('data', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $additionalData = [
            'cash_heads' => CoaSetup::with('parent')->whereHas('parent', function ($query) {
                $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
            })->get(),
            'investors' => Investor::where('status', 1)->get(),
        ];

        return HelperClass::resourceDataEdit($this->model, $id, $this->path, $this->edit_title, $additionalData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'investor_id' => 'required',
            'coa_setup_id' => 'required',
            'date' => 'required',
            'invest_no' => 'required',
            'qty' => 'required',
            'amount' => 'required'
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = $this->model::findOrFail($id);
            $data->update([
                'company_id' => Auth::user()->company_id ?? 1,
                'investor_id' => $request->investor_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'qty' => $request->qty,
                'amount' => $request->amount,
                'coa_setup_id' => $request->coa_setup_id,
                'created_by' => Auth::user()->id,
            ]);

            $wallet = Wallet::where('invest_id', $id)->first();
            if ($wallet) {
                $wallet->update([
                    'investor_id' => $request->investor_id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'amount_in' => $request->amount,
                    'updated_by' => Auth::user()->id,
                ]);
            }

            AccountTransactionAuto::where('voucher_type', 'Invest')->where('voucher_no', $data->invest_no)->forceDelete();
            $investor = Investor::findOrFail($request->investor_id);
            if (@$investor->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $cash_head->head_code,
                    '1' => $investor->coa->head_code,
                ]);
                $countHead = count($headCode);

                $debit_amount = collect([
                    '0' => $request->amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->amount,
                ]);

                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $data->invest_no,
                        'voucher_type' => "Invest",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Invest against Invest No - ' . $data->invest_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route("admin.{$this->path}.index")->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = $this->model::onlyTrashed()->findOrFail($id);
            $wallet = Wallet::onlyTrashed()->where('invest_id', $id)->first();
            if ($wallet) {
                $wallet->restore();
            }
            AccountTransactionAuto::where('voucher_no', $data->invest_no)->where('voucher_type', 'Invest')->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = $this->model::onlyTrashed()->findOrFail($id);
            $wallet = Wallet::onlyTrashed()->where('invest_id', $id)->first();
            if ($wallet) {
                $wallet->forceDelete();
            }
            AccountTransactionAuto::where('voucher_no', $data->invest_no)->where('voucher_type', 'Invest')->forceDelete();
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = $this->model::findOrFail($id);
        $wallet = Wallet::where('invest_id', $id)->first();
        if ($wallet) {
            $wallet->update(['deleted_by' => Auth::user()->id]);
            $wallet->delete();
        }
        AccountTransactionAuto::where('voucher_no', $data->invest_no)->where('voucher_type', 'Invest')->delete();
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
