<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        if (request()->ajax()) {
            $model = AttributeValue::latest('id')->where('attribute_id', $id);
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('status', function ($row) {
                    $status =
                        '<div class="form-check form-switch">
                        <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.attribute-value.edit', $row->id) . '" type="checkbox" name="status"';
                    if ($row->status == 1) {
                        $status .= ' checked ';
                    }
                    $status .= '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning border-0 px-10px fs-15 link-edit" data-url="' . Route('admin.attribute-value.edit', $row->id) . '"><i class="far fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete"';
                    $actionBtn .= 'data-url="' . Route('admin.attribute-value.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button></div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute_value.index', compact('id', 'attribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'value' => 'required',
            'status' => 'required',
        ]);

        AttributeValue::create([
            'attribute_id' => $id,
            'value' => $request->value,
            'status' => $request->status,
        ]);

        return redirect()->back()->withSuccessMessage('Created Successfully!');
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
            $data = AttributeValue::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax()) {
            $data = AttributeValue::findOrFail($id);
            $form_link = route('admin.attribute-value.update', $id);
            return response()->json(['status' => 'success', 'data' => $data, 'form_link' => $form_link]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'value' => 'required',
            'status' => 'required',
        ]);

        $attribute_value = AttributeValue::findOrFail($id);
        $attribute_value->update([
            'value' => $request->value,
            'status' => $request->status,
        ]);

        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Delete Multiple Items
        if ($request->has('id')) {
            foreach ($request->id as $id) {
                AttributeValue::findOrFail($id)->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        AttributeValue::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
