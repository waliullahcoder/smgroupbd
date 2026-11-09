<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientPrice;
use App\Models\Product;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = ClientPrice::with(['client'])->groupBy('client_id');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->client_id . '" name="multi_checkbox[]" value="' . $row->client_id . '"><label for="' . $row->client_id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.client-price.edit', $row->client_id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->client_id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    return ActionButtons::actions($data);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }

        $title = "Client Price Setup";
        return view('admin.client_price.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Client Price Setup';
        $used_client = ClientPrice::select([DB::raw('DISTINCT(client_id)')])->get(['client_id'])->pluck('client_id')->toArray();
        $clients = Client::whereNotIn('id', $used_client)->where('status', 1)->orderBy('name')->get();
        $products = Product::where('status', 1)->latest('id')->get();
        return view('admin.client_price.create', compact('title', 'clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'client_price' => 'required',
            'product_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->product_id as $key => $product_id) {
                ClientPrice::create([
                    'client_id' => $request->client_id,
                    'product_id' => $product_id,
                    'default_price' => $request->default_price[$key],
                    'client_price' => $request->client_price[$key],
                    'created_by' => Auth::user()->id,
                ]);
            }
        });

        return redirect()->route('admin.client-price.index')->withSuccessMessage('Created Successfully!');
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
    public function edit(string $id)
    {
        if (request()->ajax() && request('status')) {
            $status = ClientPrice::where('client_id', $id)->first()->status;
            $data = ClientPrice::where('client_id', $id);
            $data->update(['status' => !$status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Client Price';
        $link = Route('admin.client-price.update', $id);
        $data = ClientPrice::with(['client', 'product'])->where('client_id', $id)->get();
        $added_products = $data->pluck('product_id')->toArray();
        $products = Product::where('status', 1)->whereNotIn('id', $added_products)->latest('id')->get();
        return view('admin.client_price.edit', compact('title', 'link', 'data', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_price' => 'required',
            'product_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            foreach ($request->product_id as $key => $product_id) {
                $data = ClientPrice::where('client_id', $id)->where('product_id', $product_id)->first();
                if (!is_null($data)) {
                    $data->update([
                        'default_price' => $request->default_price[$key],
                        'client_price' => $request->client_price[$key],
                        'updated_by' => Auth::user()->id,
                    ]);
                } else {
                    ClientPrice::create([
                        'client_id' => $id,
                        'product_id' => $product_id,
                        'default_price' => $request->default_price[$key],
                        'client_price' => $request->client_price[$key],
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }
        });

        return redirect()->route('admin.client-price.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = ClientPrice::onlyTrashed()->where('client_id', $id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = ClientPrice::onlyTrashed()->where('client_id', $id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = ClientPrice::onlyTrashed()->where('client_id', $id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = ClientPrice::where('client_id', $id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = ClientPrice::where('client_id', $id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
