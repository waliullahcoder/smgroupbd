<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Models\StoreArea;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Store::with(['company', 'branch', 'area', 'area.area']);
            if (Auth::user()->store_id) {
                $model->where('id', Auth::user()->store_id);
            }
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
                ->addColumn('area_names', function ($row) {
                    $string = str_replace(',', ' || ', json_encode($row->area->pluck('area.name')->toArray()));
                    $string = str_replace('"', '', $string);
                    $string = str_replace('[', '', $string);
                    $string = str_replace(']', '', $string);
                    return $string;
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.store.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    return ActionButtons::actions($data);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }

        $title = "Store Setup";
        return view('admin.store.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Store';
        $companies = Company::orderBy('name', 'asc')->get();
        $usedArea = StoreArea::pluck('area_id')->toArray();
        $areas = Area::whereNotIn('id', $usedArea)->where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.store.create', compact('title', 'companies', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $types = implode(',', $request->type);
            $branch = Branch::where('company_id', Auth::user()->company_id ?? 1)->first();

            $data = Store::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'branch_id' => $branch->id,
                'code' => $request->code,
                'type' => $types,
                'name' => $request->name,
                'address' => $request->address,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->area_id as $area_id) {
                StoreArea::create([
                    'store_id' => $data->id,
                    'area_id' => $area_id,
                ]);
            }
        });

        return redirect()->route('admin.store.index')->withSuccessMessage('Created Successfully!');
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
            $data = Store::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Store';
        $data = Store::findOrFail($id);
        $link = Route('admin.store.update', $id);
        $usedArea = StoreArea::whereNotIn('store_id', [$id])->pluck('area_id')->toArray();
        $areas = Area::whereNotIn('id', $usedArea)->orderBy('name', 'asc')->get();
        return view('admin.store.edit', compact('title', 'data', 'link', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $types = implode(',', $request->type);

            $data = Store::findOrFail($id);
            $data->update([
                'code' => $request->code,
                'type' => $types,
                'name' => $request->name,
                'address' => $request->address,
                'remarks' => $request->remarks,
                'updated_by' => Auth::user()->id,
            ]);

            StoreArea::where('store_id', $id)->delete();
            foreach ($request->area_id as $area_id) {
                StoreArea::create([
                    'store_id' => $data->id,
                    'area_id' => $area_id,
                ]);
            }
        });

        return redirect()->route('admin.store.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Store::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Store::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Store::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Store::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Store::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
