<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\OnlineDelivery;
use App\Models\OnlineDeliveryList;
use App\Models\Order;
use App\Models\Scopes\CompanyScope;
use App\Models\Staff;
use App\Models\Store;
use App\Models\Vehicle;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OnlineOrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = OnlineDelivery::with(['company', 'vehicle', 'driver', 'delivery_man'])->latest('id');
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
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.online-order-delivery.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a href="' . Route('admin.online-order-delivery.show', $row->id) . '" class="btn btn-sm btn-info border-0 px-10px fs-15 tt" data-bs-toggle="tooltip" data-bs-placement="top" title="Gate Pass" target="_blank"><i class="fal fa-print"></i></a>';
                    return ActionButtons::actions($data, $actionBtn);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }

        $title = "Delivery Chalan";
        return view('admin.online_delivery.index', compact('title'));
    }


    public function getOrderNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = OnlineDelivery::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['serial_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
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
        if ($request->ajax() && $request->has('get_orders')) {
            $store_id = $request->store_id;
            $orders = Order::with(['customer'])->where('store_id', $store_id)->where('order_type', 'online')->where('status', 'Delivered')->where('gate_pass', 0)->get();
            return response()->json(['status' => 'success', 'orders' => $orders]);
        }

        $title = 'Add New Delivery Chalan';
        $vehicles = Vehicle::where('status', 1)->orderBy('registration_no', 'asc')->get();
        $drivers = Staff::where('status', 1)->where('type', 'driver')->orderBy('name', 'asc')->get();
        $delivery_mans = Staff::where('status', 1)->where('type', 'delivery_man')->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $serial_no = $this->getOrderNo();
        return view('admin.online_delivery.create', compact('title', 'vehicles', 'drivers', 'delivery_mans', 'stores', 'serial_no'));
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
            'order_id' => 'required',
        ]);

        $serial_no = $this->getOrderNo();
        DB::transaction(function () use ($request, $serial_no) {

            $delivery = OnlineDelivery::create([
                'company_id' => Auth::user()->company_id ? Auth::user()->company_id : 1,
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'delivery_man_id' => $request->delivery_man_id,
                'serial_no' => $serial_no,
                'date' => date('Y-m-d', strtotime($request->date)),
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->order_id as $order_id) {
                $order = Order::findOrFail($order_id);
                OnlineDeliveryList::create([
                    'online_delivery_id' => $delivery->id,
                    'customer_id' => $order->customer_id,
                    'order_id' => $order->id,
                    'amount' => $order->total,
                    'discount' => $order->discount,
                ]);
                $order->update(['gate_pass' => 1]);
            }
        });

        return redirect()->Route('admin.online-order-delivery.index')->withSuccessMessage('Created Successfully!');
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
        $data = OnlineDelivery::findOrFail($id);
        $items = OnlineDeliveryList::with(['order'])->where('online_delivery_id', $id)->get();
        $report_title = 'Gate pass';
        // return view('admin.online_delivery.voucher_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf = Pdf::loadView('admin.online_delivery.voucher_print', compact('title', 'logo', 'informations', 'report_title', 'data', 'items'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('getepass_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax()) {
            $order_ids = OnlineDeliveryList::where('online_delivery_id', $id)->get(['order_id'])->pluck('order_id')->toArray();
            $store_id = $request->store_id;
            $orders = Order::with(['customer'])->where('store_id', $store_id)->where(function ($query) use ($order_ids) {
                $query->where('gate_pass', 0)->orWhereIn('id', $order_ids);
            })->where('order_type', 'online')->where('status', 'Delivered')->get();
            return response()->json(['status' => 'success', 'orders' => $orders]);
        }

        $title = 'Update Delivery Chalan';
        $link = route('admin.online-order-delivery.update', $id);
        $data = OnlineDelivery::findOrFail($id);
        $vehicles = Vehicle::where('status', 1)->orderBy('registration_no', 'asc')->get();
        $drivers = Staff::where('status', 1)->where('type', 'driver')->orderBy('name', 'asc')->get();
        $delivery_mans = Staff::where('status', 1)->where('type', 'delivery_man')->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        return view('admin.online_delivery.edit', compact('title', 'vehicles', 'drivers', 'delivery_mans', 'stores', 'link', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required',
            'vehicle_id' => 'required',
            'driver_id' => 'required',
            'delivery_man_id' => 'required',
            'order_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $delivery = OnlineDelivery::findOrFail($id);
            $delivery->update([
                'vehicle_id' => $request->vehicle_id,
                'driver_id' => $request->driver_id,
                'delivery_man_id' => $request->delivery_man_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'updated_by' => Auth::user()->id,
            ]);

            $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
            foreach ($list as $item) {
                $order = Order::findOrFail($item->order_id);
                $order->update(['gate_pass' => 0]);
            }
            OnlineDeliveryList::where('online_delivery_id', $id)->delete();


            foreach ($request->order_id as $order_id) {
                $order = Order::findOrFail($order_id);
                OnlineDeliveryList::create([
                    'online_delivery_id' => $delivery->id,
                    'customer_id' => $order->customer_id,
                    'order_id' => $order->id,
                    'amount' => $order->total,
                    'discount' => $order->discount,
                ]);
                $order->update(['gate_pass' => 1]);
            }
        });


        return redirect()->Route('admin.online-order-delivery.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                $data = OnlineDelivery::onlyTrashed()->findOrFail($id);
                $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
                foreach ($list as $item) {
                    $order = Order::findOrFail($item->order_id);
                    $order->update(['gate_pass' => 1]);
                }
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                DB::transaction(function () use ($id) {
                    $data = OnlineDelivery::onlyTrashed()->findOrFail($id);
                    $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
                    foreach ($list as $item) {
                        $order = Order::findOrFail($item->order_id);
                        $order->update(['gate_pass' => 0]);
                    }
                    OnlineDeliveryList::where('online_delivery_id', $id)->delete();
                    $data->forceDelete();
                });
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = OnlineDelivery::onlyTrashed()->findOrFail($id);
                $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
                foreach ($list as $item) {
                    $order = Order::findOrFail($item->order_id);
                    $order->update(['gate_pass' => 0]);
                }
                OnlineDeliveryList::where('online_delivery_id', $id)->delete();
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                DB::transaction(function () use ($id) {
                    $data = OnlineDelivery::findOrFail($id);
                    $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
                    foreach ($list as $item) {
                        $order = Order::findOrFail($item->order_id);
                        $order->update(['gate_pass' => 0]);
                    }
                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                });
            }
            return response()->json(['status' => 'success']);
        }

        DB::transaction(function () use ($id) {
            $data = OnlineDelivery::findOrFail($id);
            $list = OnlineDeliveryList::where('online_delivery_id', $id)->get();
            foreach ($list as $item) {
                $order = Order::findOrFail($item->order_id);
                $order->update(['gate_pass' => 0]);
            }
            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
