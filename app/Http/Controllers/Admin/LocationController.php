<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax() && request('division') == 'true') {
            $model = Location::where('parent_id', NULL)->latest('id');
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '">
                <label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('delivery_charge', function ($row) {
                    return '<sapn>' . $row->delivery_charge . ' TK.</sapn>';
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning border-0 px-10px fs-15 division-edit" data-url="' . Route('admin.location.edit', $row->id) . '"><i class="far fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.location.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'delivery_charge', 'actions'])
                ->make(true);
        }
        if (request()->ajax() && request('district') == 'true') {
            $model = Location::with(['parent'])->where('district', 1)->latest('id');
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input multi_checkbox_district" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '">
                <label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('delivery_charge', function ($row) {
                    return '<sapn>' . $row->delivery_charge . ' TK.</sapn>';
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning border-0 px-10px fs-15 district-edit" data-url="' . Route('admin.location.edit', $row->id) . '"><i class="far fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.location.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'delivery_charge', 'actions'])
                ->make(true);
        }
        if (request()->ajax() && request('thana') == 'true') {
            $model = Location::with(['parent'])->where('thana', 1)->latest();
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input multi_checkbox_thana" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '">
                <label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('delivery_charge', function ($row) {
                    return '<sapn>' . $row->delivery_charge . ' TK.</sapn>';
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning border-0 px-10px fs-15 thana-edit" data-url="' . Route('admin.location.edit', $row->id) . '"><i class="far fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.location.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'delivery_charge', 'actions'])
                ->make(true);
        }
        $divisions = Location::where('parent_id', NULL)->latest()->get();
        $districts = Location::where('district', 1)->latest()->get();
        return view('admin.location.index', compact('divisions', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'delivery_charge' => 'required',
        ]);

        $location = new Location();
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        $location->district = $request->has('district') ? 1 : 0;
        $location->thana = $request->has('thana') ? 1 : 0;
        $location->delivery_charge = $request->delivery_charge;
        $location->save();
        return redirect()->back()->withSuccessMessage('Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Location::findOrFail($id);
            $form_link = route('admin.location.update', $id);
            return response()->json(['status' => 'success', 'data' => $data, 'form_link' => $form_link]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'delivery_charge' => 'required',
        ]);

        $location = Location::findOrFail($id);
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        $location->delivery_charge = $request->delivery_charge;
        $location->save();
        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Delete Multiple Items
        if ($request->id) {
            $locations = Location::with(['children'])->whereIn('id', $request->id)->get();
            foreach($locations as $location){
                foreach($location->children as $child){
                    $upozila_ids = $child->children->pluck('id');
                    Location::whereIn('id', $upozila_ids)->delete();
                }
                $district_ids = $location->children->pluck('id');
                Location::whereIn('id', $district_ids)->delete();
            }
            Location::whereIn('id', $request->id)->delete();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $districts = Location::with(['children'])->where('parent_id', $id)->get();
        foreach($districts as $district){
            $upozila_ids = $district->children->pluck('id');
            Location::whereIn('id', $upozila_ids)->delete();
        }
        Location::where('parent_id', $id)->delete();
        Location::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
