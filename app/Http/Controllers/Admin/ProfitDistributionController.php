<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Invest;
use App\Models\Wallet;
use App\Models\Investor;
use Illuminate\Http\Request;
use App\Models\InvestorProfit;
use Illuminate\Support\Facades\DB;
use App\Models\InvestorProfitList;
use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\DeliveryList;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class ProfitDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!is_null($request->generate)) {
            $title = 'Generate Profit';
            $serial_no = $this->SerialNo();
            $data = [];

            $start_date = date('Y-m-01', strtotime($request->month . '-' . $request->year));
            $end_date = date('Y-m-t', strtotime($request->month . '-' . $request->year));

            $product_ids = DB::table('view_liftings')->groupBy('product_id')->pluck('product_id')->toArray();

            $total_purchases = 0;
            foreach ($product_ids as $product_id) {
                $lifting_amount = DB::table('view_liftings')->where('product_id', $product_id)->sum('amount') - DB::table('view_lifting_returns')->where('product_id', $product_id)->sum('amount');
                $lifting_qty = DB::table('view_liftings')->where('product_id', $product_id)->sum('qty') - DB::table('view_lifting_returns')->where('product_id', $product_id)->sum('qty');
                $avarage_rate = $lifting_amount / $lifting_qty;

                $sales_qty = DB::table('view_sales')->where('product_id', $product_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('qty');
                $sales_returns_qty = DB::table('view_sales_returns')->where('product_id', $product_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('qty');
                $online_sales_qty = \App\Models\OrderProduct::whereHas('order', function ($query) use ($start_date, $end_date) {
                    $query->where('date', '>=', $start_date)->where('date', '<=', $end_date)->where('collected', 1);
                })->where('product_id', $product_id)->sum('quantity');
                $total_sales_qty = $sales_qty - $sales_returns_qty + $online_sales_qty;
                $total_purchases += $total_sales_qty * $avarage_rate;
            }

            $sales_amount = DB::table('view_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
            $sales_returns_amount = DB::table('view_sales_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
            $online_sales_amount = \App\Models\OrderProduct::whereHas('order', function ($query) use ($start_date, $end_date) {
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('status', ['collected', 'delivered', 'On Route']);
            })->sum(DB::raw('subtotal - discount - return_amount'));
            $shipping_charges = \App\Models\Order::where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('status', ['collected', 'delivered', 'On Route'])->sum('shipping_charge');
            $total_sales = $sales_amount - $sales_returns_amount + $online_sales_amount + $shipping_charges;

            $total_expense = AccountTransaction::with('coa')
                ->where('voucher_date', '>=', $start_date)
                ->where('voucher_date', '<=', $end_date)
                ->whereHas('coa', function ($query) {
                    $query->where('head_type', 'E')->where('transaction', 1)->whereNot('head_code', '40201')->whereNotIn('id', [121, 142]);
                })
                ->sum(DB::raw('debit_amount - credit_amount'));
            $total_profit = round($total_sales - $total_expense - $total_purchases);
            $investor_percentage = 100;
            $total_share = Invest::where('approved', 1)->where('sattled', 0)->sum('qty');
            $investor_part = $total_profit;

            $check_data = InvestorProfit::where('year', $request->year)->where('month', $request->month)->first();
            if (is_null($check_data) && $total_profit > 0) {
                $investors = Investor::whereHas('invests', function ($query) {
                    $query->where('approved', 1)->where('sattled', 0);
                })->where('status', 1)->orderBy('name', 'asc')->get();

                $per_share_profit = round($total_profit / $total_share);
                foreach ($investors as $investor) {
                    $data[] = [
                        'investor' => $investor,
                        'total_share' => $total_share,
                        'share_qty' => $investor->invests->where('approved', 1)->where('sattled', 0)->sum('qty'),
                        'profit' => $per_share_profit * $investor->invests->where('approved', 1)->where('sattled', 0)->sum('qty'),
                    ];
                }
            } else {
                $total_profit = '';
                $investor_percentage = '';
                $investor_part = '';
                $total_share = '';
            }
            return view('admin.profit_distribution.create', compact('title', 'serial_no', 'total_profit', 'investor_percentage', 'investor_part', 'total_share', 'data'));
        }

        if (request()->ajax()) {
            $model = InvestorProfit::with(['list'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            $sumValue = number_format($model->sum('amount'));
            return DataTables::eloquent($model)
                ->with('sumValue', $sumValue)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('investors', function ($row) {
                    $investor_ids = $row->list->pluck('investor_id')->toArray();
                    return Investor::whereIn('id', $investor_ids)->pluck('name')->toArray();
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime(@$row->date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];

                    $additionalBtn = '<a class="btn btn-sm border-0 px-10px fs-15 text-white tt btn-print-1" href="' . Route('admin.profit-distribute.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i></a>';
                    $diposited = $row->list->where('deposited_amount', '>', 0);
                    if (count($diposited) > 0) {
                        return '<div class="btn-group">' . $additionalBtn . '</div>';
                    } else {
                        return ActionButtons::actions($data, $additionalBtn);
                    }
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Profit Distributions";
        return view('admin.profit_distribution.index', compact('title'));
    }

    public function SerialNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = InvestorProfit::withTrashed()->select(['serial_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("PD", '', $data->serial_no);
            $dataPrefix = (int)$trim + 1;
            $SerialNo = "PD" . $dataPrefix;
        } else {
            $SerialNo = "PD" . date('y') . date('m') . '000001';
        }
        return $SerialNo;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $title = 'Generate Profit';
        $current_time = Carbon::now();
        $serial_no = $this->SerialNo();
        $data = [];
        return view('admin.profit_distribution.create', compact('title', 'current_time', 'serial_no', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'month' => 'required',
            'date' => 'required',
            'serial_no' => 'required',
            'investor_id' => 'required',
            'amount' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $serial_no = $this->SerialNo();
            $data = InvestorProfit::create([
                'serial_no' => $serial_no,
                'year' => $request->year,
                'month' => $request->month,
                'date' =>  date('Y-m-d', strtotime($request->date)),
                'total_profit' => $request->total_profit,
                'investor_percentage' => $request->investor_percentage,
                'total_share' => $request->total_share,
                'amount' => array_sum($request->amount),
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->investor_id as $investor_id) {
                InvestorProfitList::create([
                    'investor_profit_id' => $data->id,
                    'investor_id' => $investor_id,
                    'share_qty' => $request->share_qty[$investor_id],
                    'amount' => $request->amount[$investor_id],
                ]);

                Wallet::create([
                    'investor_id' => $investor_id,
                    'investor_profit_id' => $data->id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'amount_in' => $request->amount[$investor_id],
                    'type' => 'Profit',
                    'approved' => 1,
                    'created_by' => Auth::user()->id,
                ]);
            }
        });

        return redirect()->route('admin.profit-distribute.index')->withSuccessMessage('Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (!is_null($request->generate)) {
            $generated_data = [];
            $start_date = date('Y-m-01', strtotime($request->month . '-' . $request->year));
            $end_date = date('Y-m-t', strtotime($request->month . '-' . $request->year));

            $query = DB::table('view_liftings');
            $company_id = Auth::user()->company_id;
            if ($company_id) {
                $query->where('company_id', $company_id);
            }
            $searched_products = $query->groupBy('product_id')->orderBy('name', 'asc')->get(['product_id', 'name', 'code', 'attribute_name', 'category_name']);
            $product_ids = $searched_products->pluck('product_id')->toArray();

            $liftings = DB::table('view_liftings')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('product_id', $product_ids)->orderBy('name', 'asc')->get();
            $lifting_returns = DB::table('view_lifting_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('product_id', $product_ids)->get();
            $sales = DB::table('view_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('product_id', $product_ids)->get();
            $online_sales = DB::table('view_online_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereNotNull('store_id')->where('status', 'Collected')->whereIn('product_id', $product_ids)->get();
            $sales_returns = DB::table('view_sales_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('product_id', $product_ids)->get();

            $total_profit = 0;
            foreach ($searched_products as $row) {
                $sales_qty = $online_sales->where('product_id', $row->product_id)->sum('qty') + $sales->where('product_id', $row->product_id)->sum('qty') - $sales_returns->where('product_id', $row->product_id)->sum('qty');
                if ($sales_qty == 0) {
                    continue;
                }
                $sales_amount = $online_sales->where('product_id', $row->product_id)->sum('amount') + $sales->where('product_id', $row->product_id)->sum('amount') - $sales_returns->where('product_id', $row->product_id)->sum('amount');
                $lifting_amount = $liftings->where('product_id', $row->product_id)->sum('amount') - $lifting_returns->where('product_id', $row->product_id)->sum('amount');
                $lifting_qty = $liftings->where('product_id', $row->product_id)->sum('qty') - $lifting_returns->where('product_id', $row->product_id)->sum('qty');
                $avarage_rate = $lifting_amount / $lifting_qty;
                $absolute_lifting = $sales_qty * $avarage_rate;
                $total_profit += $sales_amount - $absolute_lifting > 0 ? $sales_amount - $absolute_lifting : 0;
            }

            $total_profit -= AccountTransaction::with('coa')
                ->where('voucher_date', '>=', $start_date)
                ->where('voucher_date', '<=', $end_date)
                ->whereHas('coa', function ($query) {
                    $query->where('head_type', 'E')->where('transaction', 1)->whereNot('head_code', '40201');
                })
                ->sum(DB::raw('debit_amount - credit_amount'));

            $investor_percentage = 100;
            $total_share = Invest::where('approved', 1)->where('sattled', 0)->sum('qty');
            $investor_part = $total_profit;

            $check_data = InvestorProfit::whereNotIn('id', [$id])->where('year', $request->year)->where('month', $request->month)->first();
            if (is_null($check_data) && $total_profit > 0) {
                $investors = Investor::whereHas('invests', function ($query) {
                    $query->where('approved', 1)->where('sattled', 0);
                })->where('status', 1)->orderBy('name', 'asc')->get();

                $per_share_profit = round($total_profit / $total_share);
                foreach ($investors as $investor) {
                    $data[] = [
                        'investor' => $investor,
                        'total_share' => $total_share,
                        'share_qty' => $investor->invests->where('approved', 1)->where('sattled', 0)->sum('qty'),
                        'profit' => $per_share_profit * $investor->invests->where('approved', 1)->where('sattled', 0)->sum('qty'),
                    ];
                }
            } else {
                $total_profit = '';
                $investor_percentage = '';
                $investor_part = '';
                $total_share = '';
            }

            $title = 'Update Profit Distribution';
            $data = InvestorProfit::findOrFail($id);
            return view('admin.profit_distribution.edit', compact('title', 'total_profit', 'investor_percentage', 'investor_part', 'total_share', 'data', 'generated_data'));
        }

        $title = 'View Profit Distribution';
        $data = InvestorProfit::findOrFail($id);
        return view('admin.profit_distribution.view', compact('title', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update Profit Distribution';
        $data = InvestorProfit::findOrFail($id);
        $link = Route('admin.profit-distribute.update', $id);
        $generated_data = [];
        return view('admin.profit_distribution.edit', compact('title', 'data', 'link', 'generated_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'year' => 'required',
            'month' => 'required',
            'date' => 'required',
            'serial_no' => 'required',
            'investor_id' => 'required',
            'amount' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = InvestorProfit::findOrFail($id);
            $data->update([
                'year' => $request->year,
                'month' => $request->month,
                'date' =>  date('Y-m-d', strtotime($request->date)),
                'total_profit' => $request->total_profit,
                'investor_percentage' => $request->investor_percentage,
                'total_share' => $request->total_share,
                'amount' => array_sum($request->amount),
                'updated_by' => Auth::user()->id,
            ]);

            InvestorProfitList::where('investor_profit_id', $id)->delete();
            Wallet::where('investor_profit_id', $id)->forceDelete();
            foreach ($request->investor_id as $investor_id) {
                InvestorProfitList::create([
                    'investor_profit_id' => $id,
                    'investor_id' => $investor_id,
                    'share_qty' => $request->share_qty[$investor_id],
                    'amount' => $request->amount[$investor_id],
                ]);

                Wallet::create([
                    'investor_id' => $investor_id,
                    'investor_profit_id' => $data->id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'amount_in' => $request->amount[$investor_id],
                    'type' => 'Profit',
                    'approved' => 1,
                    'created_by' => $data->created_by,
                    'updated_by' => Auth::user()->id,
                ]);
            }
        });

        return redirect()->route('admin.profit-distribute.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = InvestorProfit::withTrashed()->findOrFail($id);
            Wallet::withTrashed()->where('investor_profit_id', $id)->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = InvestorProfit::withTrashed()->findOrFail($id);
            Wallet::where('investor_profit_id', $id)->forceDelete();
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        $data = InvestorProfit::withTrashed()->findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        Wallet::where('investor_profit_id', $id)->update(['deleted_by' => Auth::user()->id]);
        Wallet::where('investor_profit_id', $id)->forceDelete();
        $data->forceDelete();
        return response()->json(['status' => 'success']);
    }
}
