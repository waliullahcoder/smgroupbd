<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Group;
use App\Models\GroupSalesTarget;
use App\Models\GroupSalesTargetCategory;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GroupSaleTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = GroupSalesTarget::with(['company', 'group']);
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
                ->addColumn('month', function ($row) {
                    return date('M', strtotime($row->date));
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.group-target.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
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

        $title = "Sales Group Target Setup";
        return view('admin.sales_group_target.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Group Sales Target';
        $companies = Company::orderBy('name')->get();
        $groups = Group::orderBy('name')->get();
        $categories = Category::root()->orderBy('name')->get();
        return view('admin.sales_group_target.create', compact('title', 'companies', 'groups', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'category_id' => 'required',
        ]);

        $check_target = GroupSalesTarget::where('group_id', $request->group_id)->where('month', $request->month)->where('year', $request->year)->count();
        if ($check_target > 0) {
            return redirect()->back()->withErrors('Target already added for this group on this month!');
        }

        if ($request->target_type == 'both') {
            $total_target = $request->total_target;
        } else {
            $total_target = 0;
        }

        $data = GroupSalesTarget::create([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'group_id' => $request->group_id,
            'year' => $request->year,
            'month' => $request->month,
            'date' => $request->year . '-' . $request->month . '-01',
            'total_target' => $total_target,
            'total_target_amount' => $request->total_target_amount,
            'target_type' => $request->target_type,
            'created_by' => Auth::user()->id,
        ]);

        foreach ($request->category_id as $key => $category_id) {
            GroupSalesTargetCategory::create([
                'group_sales_target_id' => $data->id,
                'category_id' => $category_id,
                'target' => $request->target_type == 'both' ? $request->target[$key] : 0,
                'target_amount' => $request->target_amount[$key],
            ]);
        }

        return redirect()->Route('admin.group-target.index')->withSuccessMessage('Created Successfully!');
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
            $data = GroupSalesTarget::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Group Sales Target';
        $companies = Company::orderBy('name')->get();
        $groups = Group::orderBy('name')->get();
        $categories = Category::root()->orderBy('name')->get();
        $link = route('admin.group-target.update', $id);
        $data = GroupSalesTarget::findOrFail($id);
        return view('admin.sales_group_target.edit', compact('title', 'companies', 'groups', 'categories', 'link', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'group_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'category_id' => 'required',
        ]);

        $check_target = GroupSalesTarget::whereNotIn('id', [$id])->where('group_id', $request->group_id)->where('month', $request->month)->where('year', $request->year)->count();
        if ($check_target > 0) {
            return redirect()->back()->withErrors('Target already added for this group on this month!');
        }

        $data = GroupSalesTarget::findOrFail($id);

        if ($request->target_type == 'both') {
            $total_target = $request->total_target;
        } else {
            $total_target = 0;
        }
        $data->update([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'group_id' => $request->group_id,
            'year' => $request->year,
            'month' => $request->month,
            'date' => $request->year . '-' . $request->month . '-01',
            'total_target' => $total_target,
            'total_target_amount' => $request->total_target_amount,
            'target_type' => $request->target_type,
            'updated_by' => Auth::user()->id,
        ]);

        GroupSalesTargetCategory::where('group_sales_target_id', $id)->delete();
        foreach ($request->category_id as $key => $category_id) {
            GroupSalesTargetCategory::create([
                'group_sales_target_id' => $data->id,
                'category_id' => $category_id,
                'target' => $request->target_type == 'both' ? $request->target[$key] : 0,
                'target_amount' => $request->target_amount[$key],
            ]);
        }

        return redirect()->Route('admin.group-target.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = GroupSalesTarget::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = GroupSalesTarget::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = GroupSalesTarget::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = GroupSalesTarget::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = GroupSalesTarget::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
