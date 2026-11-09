<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransactionAuto;
use App\Models\Client;
use App\Models\CoaSetup;
use App\Models\Collection;
use App\Models\SalesReturn;
use App\Models\CollectionData;
use App\Models\Company;
use App\Models\Sales;
use App\Models\Scopes\CompanyScope;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// const API_TOKEN = "zabcxpps-3p2u0j8t-poamlcuh-vfukis8d-gveezohu";
// const SID = "BONTONBULK";
// const DOMAIN = "https://smsplus.sslwireless.com";

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Collection::with(['company', 'client', 'staff'])->latest('id');
            $date = !is_null(request('sales_date')) ? date('Y-m-d', strtotime(request('sales_date'))) : date('Y-m-d');
            $model->where('payment_date', $date);
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
                    return date('d-m-Y', strtotime($row->payment_date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    if ($row->collection_type != 'adjust') {
                        $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.collection.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    } else {
                        $actionBtn = '';
                    }
                    $coll_transaction = AccountTransactionAuto::withTrashed()->where('voucher_no', $row->payment_no)->where('voucher_type', 'Collection')->first();
                    if (!is_null($coll_transaction) && $coll_transaction->posted == 0 || is_null($coll_transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    } else {
                        return $actionBtn;
                    }
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Daily Collections";
        $params = '<input type="text" class="form-control date_picker px-2 py-1" id="sales_date" name="sales_date" style="width: 150px; min-height: auto;" value="' . date('d-m-Y') . '" placeholder="Sales Date">';
        return view('admin.collection.index', compact('title', 'params'));
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
            $client = Client::findOrFail($request->client_id);
            if (is_null($client->chain_client_id)) {
                $client_id = [$request->client_id];
            } else {
                $client_id = Client::where('chain_client_id', $client->chain_client_id)->get(['id'])->pluck('id');
            }
            $total_sale_amount = Sales::whereIn('client_id', $client_id)->sum(DB::raw('total_amount - discount'));
            $total_paid_amount = Collection::whereIn('client_id', $client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
            $returnAmount = SalesReturn::whereIn('client_id', $client_id)->sum('amount');
            $balance = ($total_paid_amount + $returnAmount) - $total_sale_amount;

            $sales = DB::table('view_collectionable_sales')->where('collectionable_amount', '>', 0)->where('client_id', $request->client_id)->get();
            return response()->json(['status' => 'success', 'balance' => $balance, 'sales' => $sales]);
        }

        $title = 'Add New Collection';
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $payment_no = $this->invoice();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand');
        })->get();
        return view('admin.collection.create', compact('title', 'clients', 'staffs', 'payment_no', 'cash_heads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'payment_no' => 'required',
            'payment_date' => 'required',
            'collection_type' => 'required',
            'payment_type' => 'required',
        ]);

        if ($request->total_collection <= 0) {
            return redirect()->back()->withErrors('Collection amount must be greater than 0!');
        }

        if ($request->collection_type == 'collection' || $request->collection_type == 'adjust') {
            $request->validate([
                'sales_id' => 'required',
            ]);
        }

        $client = Client::findOrFail($request->client_id);
        if (is_null($client->chain_client_id)) {
            $client_id = [$request->client_id];
        } else {
            $client_id = Client::where('chain_client_id', $client->chain_client_id)->get(['id'])->pluck('id');
        }

        $amount = 0;
        if ($request->collection_type != 'advance') {
            foreach ($request->collection as $collection) {
                $amount += $collection;
            }
        } else {
            $amount = $request->total_collection;
        }

        if ($amount == 0) {
            return redirect()->back()->withErrors('Collection amount must be greater than 0');
        }

        $total_sale_amount = Sales::where('client_id', $request->client_id)->sum(DB::raw('sales.total_amount - sales.discount'));
        $total_sale_amount = Sales::whereIn('client_id', $client_id)->sum(DB::raw('sales.total_amount - sales.discount'));
        $total_paid_amount = Collection::whereIn('client_id', $client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::whereIn('client_id', $client_id)->sum('amount');
        $balance = ($total_paid_amount + $returnAmount) - $total_sale_amount;

        if ($request->collection_type == 'adjust' && $balance < $amount) {
            return redirect()->back()->withErrors('Your balance is lower than adjustment amount!');;
        }

        DB::transaction(function () use ($request, $amount) {
            $payment_no = $this->invoice();
            $collection = Collection::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'client_id' => $request->client_id,
                'payment_no' => $payment_no,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'collection_type' => $request->collection_type,
                'payment_type' => $request->payment_type,
                'amount' => $amount,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
                'staff_id' => $request->staff_id,
            ]);

            $invoices = [];
            if ($request->collection_type == 'collection' || $request->collection_type == 'adjust') {
                foreach ($request->sales_id as $sales_id) {
                    $sales = Sales::findOrFail($sales_id);
                    $collection_amount = $sales->total_paid + $request->collection[$sales_id];
                    $sales->update(['total_paid' => $collection_amount]);
                    $invoices[] = $sales->invoice;

                    CollectionData::create([
                        'collection_id' => $collection->id,
                        'sales_id' => $sales_id,
                        'amount' => $request->collection[$sales_id],
                    ]);
                }
            }

            $client = Client::find($request->client_id);
            if ($client->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $cash_head->head_code,
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

            $unique_invoices = array_unique($invoices);
            $filtered_invoices = implode(',', $unique_invoices);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Collection',
                'action' => 'Add',
                'description' => 'Create a new Collection with payment no ' . $collection->payment_no . ' from client ' . $client->name . ' collection amount is ' . $collection->amount . ' collection type ' . $request->collection_type . ($request->collection_type != 'advance' ? ' and sales invoices are ' . $filtered_invoices : ''),
                'user_id' => Auth::user()->id,
            ]);

            // if (substr($client->phone, 0, 1) == 0 && strlen($client->phone) == 11) {
            //     $msisdn = $client->phone;
            // } else {
            //     $msisdn = '0' . $client->phone;
            // }
            // $messageBody = 'Dear, ' . $client->name . ' Successfully Collection with payment no ' . $collection->payment_no . ' collection amount is ' . $collection->amount . ' collection type ' . $request->collection_type . ($request->collection_type != 'advance' ? ' and sales invoices are ' . $filtered_invoices : '');
            // $csmsId = mt_rand(5, 15);
            // $this->singleSms($msisdn, $messageBody, $csmsId);
        });

        return redirect()->route('admin.collection.index')->withSuccessMessage('Created Successfully!');
    }

    function singleSms($msisdn, $messageBody, $csmsId)
    {
        $params = [
            "api_token" => API_TOKEN,
            "sid" => SID,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = trim(DOMAIN, '/') . "/api/v3/send-sms";
        $params = json_encode($params);

        return $this->callApi($url, $params);
    }

    public static function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
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
        $data = Collection::findOrFail($id);
        $report_title = 'Money Receipt';
        // return view('admin.collection.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.collection.print', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('collection_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
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
                    $query->where('head_name', 'Cash at Bank');
                })->get();
            }
            return response()->json(['status' => 'success', 'cash_heads' => $cash_heads]);
        }

        if ($request->ajax()) {
            $rows = array();
            $data = Collection::findOrFail($id);
            $oldRowIds = $data->collection_data->pluck('sales_id')->toArray();

            $client = Client::findOrFail($request->client_id);
            if (is_null($client->chain_client_id)) {
                $client_id = [$request->client_id];
            } else {
                $client_id = Client::where('chain_client_id', $client->chain_client_id)->get(['id'])->pluck('id');
            }
            $total_sale_amount = Sales::whereIn('client_id', $client_id)->sum(DB::raw('total_amount - discount'));
            $total_paid_amount = Collection::whereIn('client_id', $client_id)->where('collection_type', '!=', 'adjust')->where('id', '!=', $id)->sum('amount');
            $returnAmount = SalesReturn::whereIn('client_id', $client_id)->sum('amount');
            $balance = ($total_paid_amount + $returnAmount) - $total_sale_amount;

            $new_rows = DB::table('view_collectionable_sales')->whereNotIn('id', $oldRowIds)->where('collectionable_amount', '>', 0)->where('client_id', $request->client_id)->get();

            if ($data->client_id ==  $request->client_id) {
                $rows = $data->collection_data;
            }
            return view('admin.collection.partial.table_rows', ['status' => 'success', 'balance' => $balance, 'new_rows' => $new_rows, 'rows' => $rows])->render();
        }

        $title = 'Update Collection';
        $data = Collection::findOrFail($id);
        $rows = $data->collection_data;
        $link = Route('admin.collection.update', $id);
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) use ($data) {
            if ($data->payment_type == 'Cash') {
                $query->where('head_name', 'Cash In Hand');
            } elseif ($data->payment_type == 'Bank') {
                $query->where('head_name', 'Cash In Bank');
            }
        })->get();

        // Balance Calculation
        $client = Client::findOrFail($data->client_id);
        if (is_null($client->chain_client_id)) {
            $client_id = [$data->client_id];
        } else {
            $client_id = Client::where('chain_client_id', $client->chain_client_id)->get(['id'])->pluck('id');
        }
        $total_sale_amount = Sales::whereIn('client_id', $client_id)->sum(DB::raw('total_amount - discount'));
        $total_paid_amount = Collection::whereIn('client_id', $client_id)->where('collection_type', '!=', 'adjust')->where('id', '!=', $id)->sum('amount');
        $returnAmount = SalesReturn::whereIn('client_id', $client_id)->sum('amount');
        $balance = ($total_paid_amount + $returnAmount) - $total_sale_amount;
        // Balance Calculation

        $selected_head = AccountTransactionAuto::where('voucher_type', 'Collection')->where('voucher_no', $data->payment_no)->where('debit_amount', '>', 0)->first();
        return view('admin.collection.edit', compact('title', 'data', 'rows', 'link', 'clients', 'staffs', 'cash_heads', 'selected_head', 'balance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required',
            'payment_no' => 'required',
            'payment_date' => 'required',
            'collection_type' => 'required',
            'payment_type' => 'required',
        ]);

        if ($request->total_collection <= 0) {
            return redirect()->back()->withErrors('Collection amount must be greater than 0!');
        }

        if ($request->collection_type == 'collection' || $request->collection_type == 'adjust') {
            $request->validate([
                'sales_id' => 'required',
            ]);
        }

        DB::transaction(function () use ($request, $id) {
            $collection = Collection::findOrFail($id);
            AccountTransactionAuto::withTrashed()->where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->forceDelete();
            $amount = 0;
            if ($request->collection_type != 'advance') {
                foreach ($request->collection as $coll_amount) {
                    $amount += $coll_amount;
                }
            } else {
                $amount = $request->total_collection;
            }
            if ($amount == 0) {
                return redirect()->back()->withErrors('Collection amount must be greater than ');
            }
            foreach ($collection->collection_data as $item) {
                $sales = Sales::findOrFail($item->sales_id);
                $collection_amount = $sales->total_paid - $item->amount;
                $sales->update(['total_paid' => $collection_amount]);
            }
            CollectionData::where('collection_id', $id)->delete();

            $collection->update([
                'company_id' => Auth::user()->company_id ? Auth::user()->company_id : 1,
                'client_id' => $request->client_id,
                'payment_date' => date('Y-m-d', strtotime($request->payment_date)),
                'collection_type' => $request->collection_type,
                'payment_type' => $request->payment_type,
                'amount' => $amount,
                'remarks' => $request->remarks,
            ]);

            $invoices = [];
            if ($request->collection_type == 'collection' || $request->collection_type == 'adjust') {
                foreach ($request->sales_id as $sales_id) {
                    $sales = Sales::findOrFail($sales_id);
                    $collection_amount = $sales->total_paid + $request->collection[$sales_id];
                    $sales->update(['total_paid' => $collection_amount]);
                    $invoices[] = $sales->invoice;

                    CollectionData::create([
                        'collection_id' => $collection->id,
                        'sales_id' => $sales_id,
                        'amount' => $request->collection[$sales_id],
                    ]);
                }
            }

            $client = Client::find($request->client_id);
            if ($client->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $cash_head->head_code,
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
                        'voucher_no' => $collection->payment_no,
                        'voucher_type' => "Collection",
                        'voucher_date' => date('Y-m-d', strtotime($request->payment_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Collection Against PAYMENT NO - ' . $collection->payment_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $unique_invoices = array_unique($invoices);
            $filtered_invoices = implode(',', $unique_invoices);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Collection',
                'action' => 'Update',
                'description' => 'Update Collection against payment no ' . $collection->payment_no . ' from client ' . $client->name . ' collection amount is ' . $collection->amount . ' collection type ' . $request->collection_type . ($request->collection_type != 'advance' ? ' and sales invoices are ' . $filtered_invoices : ''),
                'user_id' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.collection.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Collection::onlyTrashed()->findOrFail($id);
            foreach ($data->collection_data as $item) {
                $sales = Sales::findOrFail($item->sales_id);
                $collection_amount = $sales->total_paid + $item->amount;
                $sales->update(['total_paid' => $collection_amount]);
            }
            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                DB::transaction(function () use ($id) {
                    $data = Collection::onlyTrashed()->findOrFail($id);
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                    $data->forceDelete();
                });
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = Collection::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Collection::findOrFail($id);
                foreach ($data->collection_data as $item) {
                    $sales = Sales::findOrFail($item->sales_id);
                    $collection_amount = $sales->total_paid - $item->amount;
                    $sales->update(['total_paid' => $collection_amount]);
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Collection',
                    'action' => 'Delete',
                    'description' => 'Collection delete payment no ' . $data->payment_no . ' collection type was ' . $data->collection_type,
                    'user_id' => Auth::user()->id,
                ]);
                AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
                AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->delete();
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Collection::findOrFail($id);
        foreach ($data->collection_data as $item) {
            $sales = Sales::findOrFail($item->sales_id);
            $collection_amount = $sales->total_paid - $item->amount;
            $sales->update(['total_paid' => $collection_amount]);
        }

        AccessLog::create([
            'date_time' => Carbon::now(),
            'page' => 'Collection',
            'action' => 'Delete',
            'description' => 'Collection delete payment no ' . $data->payment_no . ' collection type was ' . $data->collection_type,
            'user_id' => Auth::user()->id,
        ]);
        AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
        AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Collection')->delete();
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
