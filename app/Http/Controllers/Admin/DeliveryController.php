<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Company;
use App\Models\Delivery;
use App\Models\DeliveryList;
use App\Models\SalesList;
use App\Models\Scopes\CompanyScope;
use App\Models\Staff;
use App\Models\Store;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Delivery::with(['company', 'vehicle', 'driver', 'delivery_man'])->latest('id');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            } else {
                $date = !is_null(request('date')) ? date('Y-m-d', strtotime(request('date'))) : date('Y-m-d');
                $model->where('date', $date);
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('delivered', function ($row) {
                    if (Auth::user()->can('admin.delivery.delivered')) {
                        $status = '<div class="form-check form-switch mx-auto">
                        <input class="form-check-input delivered c-pointer" data-url="' . Route('admin.delivery.delivered', $row->id) . '" type="checkbox" name="delivered" ' . ($row->delivered == 1 ? 'checked disabled' : '') . '>
                        </div>';
                        return $status;
                    }
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a href="' . Route('admin.delivery.gatepass', $row->id) . '" class="btn btn-sm btn-info border-0 px-10px fs-15 tt" data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery List" target="_blank"><i class="fal fa-print"></i></a>
                                    <a href="' . Route('admin.delivery.show', $row->id) . '" class="btn btn-sm btn-info border-0 px-10px fs-15 tt" data-bs-toggle="tooltip" data-bs-placement="top" title="Gate Pass" target="_blank"><i class="fal fa-print"></i></a>';
                    if (!empty($type) && $type == 'trash') {
                        return ActionButtons::actions($data);
                    }
                    return ActionButtons::actions($data, $actionBtn);
                })
                ->rawColumns(['checkbox', 'delivered', 'actions'])
                ->make(true);
        }

        $title = "Delivery Chalan";
        $params = '<input type="text" class="form-control date_picker px-2 py-1" id="date" name="date" style="width: 150px; min-height: auto;" value="' . date('d-m-Y') . '" placeholder="Delivery Date">';
        return view('admin.delivery.index', compact('title', 'params'));
    }

    public function getOrderNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Delivery::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['serial_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($order) {
            $trim = str_replace("ST", '', $order->serial_no);
            $serial_no_prefix = (int)$trim + 1;
            $serial_no = "ST" . $serial_no_prefix;
        } else {
            $serial_no = "ST" . date('y') . date('m') . '000001';
        }
        return $serial_no;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_sales')) {
            if (!is_null($request->store_id)) {
                $query = SalesList::whereNull('sales.deleted_at')->where('sales.store_id', $request->store_id);
                if (is_array($request->area_id) && count($request->area_id) > 0) {
                    $query->whereIn('clients.area_id', $request->area_id);
                }
                if (is_array($request->checked_list)) {
                    $query->whereNotIn('sales_lists.id', $request->checked_list);
                }
                $sales_list = $query->where('delivery_status', 'Pending')
                    ->leftJoin('sales', 'sales.id', '=', 'sales_lists.sales_id')
                    ->leftJoin('clients', 'clients.id', '=', 'sales_lists.client_id')
                    ->leftJoin('products', 'products.id', '=', 'sales_lists.product_id')
                    ->leftJoin('product_skus', 'product_skus.id', '=', 'sales_lists.variant_id')
                    ->select('sales_lists.id', 'sales_lists.product_id', 'sales_lists.client_id', 'sales_lists.variant_id', 'sales_lists.qty', 'sales.invoice as invoice', 'product_skus.sku as sku', 'products.code as product_code', 'clients.name as client_name', 'products.name as product_name')->get();
                $total = number_format($sales_list->sum('qty'), 2, '.');
                return response()->json(['status' => 'success', 'sales_list' => $sales_list, 'total' => $total]);
            }
        }

        $title = 'Add New Delivery Chalan';
        $vehicles = Vehicle::where('status', 1)->orderBy('registration_no', 'asc')->get();
        $drivers = Staff::where('status', 1)->where('type', 'driver')->orderBy('name', 'asc')->get();
        $delivery_mans = Staff::where('status', 1)->where('type', 'delivery_man')->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $serial_no = $this->getOrderNo();
        $sales_list = SalesList::with(['product', 'sales', 'client'])->where('store_id', $stores->first()->id)->whereHas('client', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('sales', function ($query) {
            $query->whereNull('deleted_at');
        })->where('delivery_status', 'Pending')->get();
        return view('admin.delivery.create', compact('title', 'vehicles', 'drivers', 'delivery_mans', 'stores', 'areas', 'serial_no', 'sales_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'serial_no' => 'required',
            'date' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'delivery_man_id' => 'required',
            'store_id' => 'required',
            'sales_list_id' => 'required',
        ]);

        $count_delivered = SalesList::whereIn('id', $request->sales_list_id)->where('delivery_status', 'delivered')->count();
        if (count($request->sales_list_id) == $count_delivered) {
            return redirect()->back()->withErrors('Already delivered all invoices!');
        }

        $serial_no = $this->getOrderNo();
        DB::transaction(function () use ($request, $serial_no) {
            $amount = 0;
            foreach ($request->sales_list_id as $key => $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                if ($sales_list->delivery_status == 'delivered') {
                    continue;
                }
                $amount += $sales_list->amount;
            }

            $delivery = Delivery::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'delivery_man_id' => $request->delivery_man_id,
                'serial_no' => $serial_no,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::findOrFail($sales_list_id);
                if ($sales_list->delivery_status == 'delivered') {
                    continue;
                }
                DeliveryList::create([
                    'delivery_id' => $delivery->id,
                    'client_id' => $sales_list->client_id,
                    'sales_id' => $sales_list->sales_id,
                    'product_id' => $sales_list->product_id,
                    'rate' => $sales_list->rate,
                    'qty' => $sales_list->qty,
                    'amount' => $sales_list->amount,
                    'sales_list_id' => $sales_list_id,
                ]);
                $sales_list->update(['delivery_status' => 'delivered']);
            }
        });

        return redirect()->Route('admin.delivery.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function gatePass(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Delivery::findOrFail($id);
        $items = DeliveryList::with(['sales'])->where('delivery_id', $id)->select(
            'delivery_lists.sales_id',
            DB::raw('SUM(delivery_lists.amount) as total_amount')
        )->groupBy('delivery_lists.sales_id')->get();
        $report_title = 'Delivery List';
        // return view('admin.delivery.voucher_details_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf = Pdf::loadView('admin.delivery.voucher_details_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('getepass_chalan_details_' . date('d_m_Y_h_i_s') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Delivery::findOrFail($id);
        $items = DeliveryList::with(['product'])->where('delivery_id', $id)->select(
            'delivery_lists.product_id',
            DB::raw('SUM(delivery_lists.qty) as total_qty')
        )->groupBy('delivery_lists.product_id')->get();
        $report_title = 'Gate pass';
        // return view('admin.delivery.voucher_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf = Pdf::loadView('admin.delivery.voucher_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('getepass_chalan_' . date('d_m_Y_h_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_sales')) {
            if (!is_null($request->store_id)) {
                $query = SalesList::whereNull('sales.deleted_at')->where('sales.store_id', $request->store_id);
                if (is_array($request->area_id) && count($request->area_id) > 0) {
                    $query->whereIn('clients.area_id', $request->area_id);
                }
                if (is_array($request->checked_list)) {
                    $query->whereNotIn('sales_lists.id', $request->checked_list);
                }
                $sales_list = $query->where('delivery_status', 'Pending')
                    ->leftJoin('sales', 'sales.id', '=', 'sales_lists.sales_id')
                    ->leftJoin('clients', 'clients.id', '=', 'sales_lists.client_id')
                    ->leftJoin('products', 'products.id', '=', 'sales_lists.product_id')
                    ->leftJoin('product_skus', 'product_skus.id', '=', 'sales_lists.variant_id')
                    ->select('sales_lists.id', 'sales_lists.product_id', 'sales_lists.client_id', 'sales_lists.variant_id', 'sales_lists.qty', 'sales.invoice as invoice', 'product_skus.sku as sku', 'products.code as product_code', 'clients.name as client_name', 'products.name as product_name')->get();
                $total = number_format($sales_list->sum('qty'), 2, '.');
                return response()->json(['status' => 'success', 'sales_list' => $sales_list, 'total' => $total]);
            }
        }

        $title = 'Update Delivery Chalan';
        $link = route('admin.delivery.update', $id);
        $data = Delivery::findOrFail($id);
        $vehicles = Vehicle::where('status', 1)->orderBy('registration_no', 'asc')->get();
        $drivers = Staff::where('status', 1)->where('type', 'driver')->orderBy('name', 'asc')->get();
        $delivery_mans = Staff::where('status', 1)->where('type', 'delivery_man')->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $sales_list = SalesList::with(['product', 'sales', 'client'])->where('store_id', $data->store_id)->whereHas('client', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('sales', function ($query) {
            $query->whereNull('deleted_at');
        })->where('delivery_status', 'Pending')->get();
        return view('admin.delivery.edit', compact('title', 'vehicles', 'drivers', 'delivery_mans', 'stores', 'areas', 'link', 'data', 'sales_list'));
    }

    public function delivered(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('delivered')) {
            $data = Delivery::findOrFail($id);
            $data->update([
                'delivered' => !$data->delivered,
            ]);
            return response()->json(['status' => 'success']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'serial_no' => 'required',
            'date' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'delivery_man_id' => 'required',
            'store_id' => 'required',
            'sales_list_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $amount = 0;
            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::find($sales_list_id);
                if ($sales_list) {
                    $amount += $sales_list->amount;
                }
            }

            $delivery = Delivery::findOrFail($id);
            $delivery->update([
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'delivery_man_id' => $request->delivery_man_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'updated_by' => Auth::user()->id,
            ]);

            foreach ($delivery->list as $item) {
                $sales_list = SalesList::find($item->sales_list_id);
                if (!is_null($sales_list)) {
                    $sales_list->update(['delivery_status' => 'Pending']);
                }
                $item->delete();
            }

            foreach ($request->sales_list_id as $sales_list_id) {
                $sales_list = SalesList::find($sales_list_id);
                if ($sales_list) {
                    DeliveryList::create([
                        'delivery_id' => $id,
                        'client_id' => $sales_list->client_id,
                        'sales_id' => $sales_list->sales_id,
                        'product_id' => $sales_list->product_id,
                        'rate' => $sales_list->rate,
                        'qty' => $sales_list->qty,
                        'amount' => $sales_list->amount,
                        'sales_list_id' => $sales_list_id
                    ]);
                    $sales_list->update(['delivery_status' => 'delivered']);
                }
            }
        });

        return redirect()->Route('admin.delivery.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Delivery::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Delivery::onlyTrashed()->findOrFail($id);
                foreach ($data->list as $item) {
                    $sales_list = SalesList::find($item->sales_list_id);
                    if (!is_null($sales_list)) {
                        $sales_list->update(['delivery_status' => 'Pending']);
                    }
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Delivery::onlyTrashed()->findOrFail($id);
            foreach ($data->list as $item) {
                $sales_list = SalesList::find($item->sales_list_id);
                if (!is_null($sales_list)) {
                    $sales_list->update(['delivery_status' => 'Pending']);
                }
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Delivery::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Delivery::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
