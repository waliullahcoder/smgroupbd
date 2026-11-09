<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\BulkCollection;
use App\Models\BulkCollectionList;
use App\Models\Client;
use App\Models\CoaSetup;
use App\Models\Collection;
use App\Models\CollectionData;
use App\Models\Delivery;
use App\Models\DeliveryList;
use App\Models\Sales;
use App\Models\Scopes\CompanyScope;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BulkCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = BulkCollection::with(['company', 'staff', 'list'])->latest('id');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];

                    $vouchers = $row->list->pluck('collection.payment_no');
                    $transactions = AccountTransaction::whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->count();
                    if ($transactions == 0) {
                        return ActionButtons::actions($data);
                    }
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }
        $title = "Bulk Collections";
        return view('admin.bulk_collection.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_heads')) {
            $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) use ($request) {
                if ($request->type == 'Cash') {
                    $query->where('head_name', 'Cash In Hand');
                }
                if ($request->type == 'Bank') {
                    $query->where('head_name', 'Cash at Bank');
                }
            })->get();
            return response()->json(['status' => 'success', 'cash_heads' => $cash_heads]);
        }

        if ($request->ajax() && $request->has('get_sales')) {
            $sales = Sales::find($request->sales_id);
            $client = Client::find($sales->client_id);
            return response()->json(['status' => 'success', 'sales' => $sales, 'client' => $client]);
        }

        if ($request->ajax() && $request->has('get_datewise_gatepass')) {
            $deliveries = Delivery::where('date', date('Y-m-d', strtotime($request->date)))->get();
            return response()->json(['status' => 'success', 'deliveries' => $deliveries]);
        }

        if ($request->ajax() && $request->has('get_gatepasswise_sales')) {
            $sales_ids = DeliveryList::with('delivery')->whereHas('delivery', function ($query) use ($request) {
                $query->where('id', $request->delivery_id);
            })->pluck('sales_id')->toArray();
            $query = Sales::with('client')->whereIn('id', $sales_ids);
            if (is_array($request->checked_ids)) {
                $query->whereNotIn('id', $request->checked_ids);
            }
            $sales = $query->whereColumn('total_paid', '<', DB::raw('total_amount - discount'))->get();
            return response()->json(['status' => 'success', 'sales' => $sales]);
        }

        if ($request->ajax() && $request->has('get_additional_sales')) {
            $query = Sales::query();
            if ($request->sales_id) {
                $query->whereNotIn('id', $request->sales_id);
            }
            $sales = $query->where('client_id', $request->client_id)->whereColumn('total_paid', '<', DB::raw('total_amount - discount'))->get();
            return response()->json(['status' => 'success', 'sales' => $sales]);
        }

        $title = "Add Bulk Collections";
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();

        $query = Sales::with(['client'])->where('date', date('Y-m-d'))->whereColumn('total_paid', '<', DB::raw('total_amount - discount'));
        $total_amount = $query->sum(DB::raw('total_amount - discount - total_paid'));
        $sales = $query->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand');
        })->get();
        $gate_passes = Delivery::where('date', date('Y-m-d'))->get();
        return view('admin.bulk_collection.create', compact('title', 'clients', 'sales', 'total_amount', 'staffs', 'cash_heads', 'gate_passes'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = Collection::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("STC", '', $data->payment_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STC" . $dataPrefix;
        } else {
            $invoice = "STC" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'sales_id' => 'required',
        ]);

        foreach ($request->sales_id as $sales_id) {
            $sales = DB::table('view_collectionable_sales')->where('id', $sales_id)->first();
            if ($request->paid_amount[$sales_id] > $sales->collectionable_amount) {
                return redirect()->back()->withErrors('Something went wrong!');
            }
        }

        DB::transaction(function () use ($request) {
            $total_paid = 0;
            foreach ($request->sales_id as $sales_id) {
                $total_paid += $request->paid_amount[$sales_id];
            }

            $data = BulkCollection::create([
                'company_id' => !is_null(Auth::user()->company_id) ? Auth::user()->company_id : 1,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $total_paid,
                'payment_type' => $request->payment_type,
                'coa_setup_id' => $request->coa_setup_id,
                'staff_id' => $request->staff_id,
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->sales_id as $sales_id) {
                $payment_no = $this->invoice();

                if ($request->paid_amount[$sales_id] == 0) {
                    continue;
                }

                $collection = Collection::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'client_id' => $request->client_id[$sales_id],
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->date)),
                    'collection_type' => 'collection',
                    'sales_id' => $sales_id,
                    'payment_type' => $request->payment_type,
                    'amount' => $request->paid_amount[$sales_id],
                    'remarks' => 'bulk collection',
                    'staff_id' => $request->staff_id,
                    'created_by' => Auth::user()->id,
                ]);

                CollectionData::create([
                    'collection_id' => $collection->id,
                    'sales_id' => $sales_id,
                    'amount' => $request->paid_amount[$sales_id],
                ]);

                $sales = Sales::findOrFail($sales_id);
                $total_paid = $sales->total_paid + $request->paid_amount[$sales_id];
                $sales->update(['total_paid' => $total_paid]);

                $client = Client::find($request->client_id[$sales_id]);
                $admin_settings = AdminSetting::first();
                if (@$admin_settings->accounting == 1 && $client->coa) {
                    $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $client->coa->head_code
                    ]);

                    $debit_amount = collect([
                        '0' => $request->paid_amount[$sales_id],
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $request->paid_amount[$sales_id]
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $payment_no,
                            'voucher_type' => "Collection",
                            'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Collection Against PAYMENT NO - ' . $payment_no,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                BulkCollectionList::create([
                    'bulk_collection_id' => $data->id,
                    'collection_id' => $collection->id,
                    'client_id' => $request->client_id[$sales_id],
                    'sales_id' => $sales_id,
                    'invoice_amount' => $request->invoice_amount[$sales_id],
                    'paid_amount' => $request->paid_amount[$sales_id],
                    'money_receipt' => $request->money_receipt[$sales_id],
                ]);
            }
        });

        return redirect()->route('admin.bulk-collection.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_heads')) {
            $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) use ($request) {
                if ($request->type == 'Cash') {
                    $query->where('head_name', 'Cash In Hand');
                }
                if ($request->type == 'Bank') {
                    $query->where('head_name', 'Cash at Bank');
                }
            })->get();
            return response()->json(['status' => 'success', 'cash_heads' => $cash_heads]);
        }

        if ($request->ajax() && $request->has('get_sales')) {
            $sales = DB::table('view_collectionable_sales')->where('id', $request->sales_id)->first();
            return response()->json(['status' => 'success', 'sales' => $sales]);
        }

        if ($request->ajax() && $request->has('get_datewise_gatepass')) {
            $deliveries = Delivery::where('date', date('Y-m-d', strtotime($request->date)))->get();
            return response()->json(['status' => 'success', 'deliveries' => $deliveries]);
        }

        if ($request->ajax() && $request->has('get_gatepasswise_sales')) {
            $sales_ids = DeliveryList::with('delivery')->whereHas('delivery', function ($query) use ($request) {
                $query->where('id', $request->delivery_id);
            })->pluck('sales_id')->toArray();

            $query = DB::table('view_collectionable_sales')->whereIn('id', $sales_ids);
            if (is_array($request->checked_ids)) {
                $query->whereNotIn('id', $request->checked_ids);
            }
            $sales = $query->where('collectionable_amount', '>', 0)->get();
            return response()->json(['status' => 'success', 'sales' => $sales]);
        }

        if ($request->ajax() && $request->has('get_additional_sales')) {
            $query = DB::table('view_collectionable_sales')->where('client_id', $request->client_id);
            if ($request->sales_id) {
                $query->whereNotIn('id', $request->sales_id);
            }
            $sales = $query->where('collectionable_amount', '>', 0)->get();

            return response()->json(['status' => 'success', 'sales' => $sales]);
        }

        $title = "Update Bulk Collections";
        $data = BulkCollection::findOrFail($id);
        $link = Route('admin.bulk-collection.update', $id);
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $sales = DB::table('view_collectionable_sales')->where('date', date('Y-m-d'))->where('collectionable_amount', '>', 0)->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) use ($data) {
            if ($data->payment_type == 'Cash') {
                $query->where('head_name', 'Cash In Hand');
            } elseif ($data->payment_type == 'Bank') {
                $query->where('head_name', 'Cash In Bank');
            }
        })->get();
        $gate_passes = Delivery::where('date', date('Y-m-d'))->get();
        return view('admin.bulk_collection.edit', compact('title', 'data', 'link', 'clients', 'sales', 'staffs', 'cash_heads', 'gate_passes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required',
            'sales_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $bulk_collection = BulkCollection::findOrFail($id);
            foreach ($bulk_collection->list as $item) {
                $sales = Sales::findOrFail($item->sales_id);
                $paid_amount = $sales->total_paid - $item->paid_amount;
                $sales->update(['total_paid' => $paid_amount]);
            }

            // Delete old Data
            $collection_id = $bulk_collection->list->pluck('collection_id');
            $vouchers = $bulk_collection->list->pluck('collection.payment_no');
            AccountTransactionAuto::withTrashed()->whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->forceDelete();
            Collection::whereIn('id', $collection_id)->forceDelete();
            BulkCollectionList::where('bulk_collection_id', $id)->delete();
            // Delete old Data

            $total_paid = 0;
            foreach ($request->sales_id as $sales_id) {
                $sales = DB::table('view_collectionable_sales')->where('id', $sales_id)->first();
                if ($request->paid_amount[$sales_id] > $sales->collectionable_amount) {
                    throw new Exception('Something went wrong!');
                }
                $total_paid += $request->paid_amount[$sales_id];
            }

            $bulk_collection->update([
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $total_paid,
                'payment_type' => $request->payment_type,
                'coa_setup_id' => $request->coa_setup_id,
                'staff_id' => $request->staff_id,
                'updated_by' => Auth::user()->id,
            ]);

            foreach ($request->sales_id as $sales_id) {
                $payment_no = $this->invoice();
                if ($request->paid_amount[$sales_id] == 0) {
                    continue;
                }

                $collection = Collection::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'client_id' => $request->client_id[$sales_id],
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->date)),
                    'collection_type' => 'collection',
                    'sales_id' => $sales_id,
                    'payment_type' => $request->payment_type,
                    'amount' => $request->paid_amount[$sales_id],
                    'remarks' => 'bulk collection',
                    'staff_id' => $request->staff_id,
                    'created_by' => Auth::user()->id,
                ]);

                CollectionData::create([
                    'collection_id' => $collection->id,
                    'sales_id' => $sales_id,
                    'amount' => $request->paid_amount[$sales_id],
                ]);

                $sales = Sales::findOrFail($sales_id);
                $total_paid = $sales->total_paid + $request->paid_amount[$sales_id];
                $sales->update(['total_paid' => $total_paid]);

                $client = Client::find($request->client_id[$sales_id]);
                $admin_settings = AdminSetting::first();
                if (@$admin_settings->accounting == 1 && $client->coa) {
                    $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $client->coa->head_code
                    ]);

                    $debit_amount = collect([
                        '0' => $request->paid_amount[$sales_id],
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $request->paid_amount[$sales_id]
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $payment_no,
                            'voucher_type' => "Collection",
                            'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Collection Against PAYMENT NO - ' . $payment_no,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                BulkCollectionList::create([
                    'bulk_collection_id' => $bulk_collection->id,
                    'collection_id' => $collection->id,
                    'client_id' => $request->client_id[$sales_id],
                    'sales_id' => $sales_id,
                    'invoice_amount' => $request->invoice_amount[$sales_id],
                    'paid_amount' => $request->paid_amount[$sales_id],
                    'money_receipt' => $request->money_receipt[$sales_id],
                ]);
            }
        });

        return redirect()->route('admin.bulk-collection.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = BulkCollection::withTrashed()->findOrFail($id);
            foreach ($data->list as $item) {
                $sales = Sales::findOrFail($item->sales_id);
                $total_paid = $sales->total_paid + $item->paid_amount;
                $sales->update(['total_paid' => $total_paid]);
            }
            $collection_id = $data->list->pluck('collection_id')->toArray();
            Collection::withTrashed()->whereIn('id', $collection_id)->restore();
            $vouchers = $data->list->pluck('collection.payment_no');
            AccountTransactionAuto::withTrashed()->whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                DB::transaction(function () use ($id) {
                    $data = BulkCollection::onlyTrashed()->findOrFail($id);

                    $collection_id = $data->list->pluck('collection_id')->toArray();
                    Collection::withTrashed()->whereIn('id', $collection_id)->forceDelete();

                    $vouchers = $data->list->pluck('collection.payment_no');
                    AccountTransactionAuto::withTrashed()->whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->forceDelete();

                    $data->forceDelete();
                });
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = BulkCollection::onlyTrashed()->findOrFail($id);

                $collection_id = $data->list->pluck('collection_id')->toArray();
                Collection::withTrashed()->whereIn('id', $collection_id)->forceDelete();

                $vouchers = $data->list->pluck('collection.payment_no');
                AccountTransactionAuto::withTrashed()->whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->forceDelete();

                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = BulkCollection::findOrFail($id);
                foreach ($data->list as $item) {
                    $sales = Sales::findOrFail($item->sales_id);
                    $total_paid = $sales->total_paid - $item->paid_amount;
                    $sales->update(['total_paid' => $total_paid]);
                }

                $collection_id = $data->list->pluck('collection_id')->toArray();
                Collection::whereIn('id', $collection_id)->update(['deleted_by' => Auth::user()->id]);
                Collection::whereIn('id', $collection_id)->delete();

                $vouchers = $data->list->pluck('collection.payment_no');
                AccountTransactionAuto::whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
                AccountTransactionAuto::whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->delete();

                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = BulkCollection::findOrFail($id);
        foreach ($data->list as $item) {
            $sales = Sales::findOrFail($item->sales_id);
            $total_paid = $sales->total_paid - $item->paid_amount;
            $sales->update(['total_paid' => $total_paid]);
        }

        $collection_id = $data->list->pluck('collection_id')->toArray();
        Collection::whereIn('id', $collection_id)->update(['deleted_by' => Auth::user()->id]);
        Collection::whereIn('id', $collection_id)->delete();

        $vouchers = $data->list->pluck('collection.payment_no');
        AccountTransactionAuto::whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
        AccountTransactionAuto::whereIn('voucher_no', $vouchers)->where('voucher_type', 'Collection')->delete();

        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();
        return response()->json(['status' => 'success']);
    }
}
