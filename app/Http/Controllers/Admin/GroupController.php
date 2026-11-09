<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Group::with(['company', 'leader', 'members']);
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
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.group.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('leader_name', function ($row) {
                    return @$row->leader->name;
                })
                ->addColumn('members', function ($row) {
                    $members = '';
                    foreach ($row->members as $key => $member) {
                        $key > 0 ? $members .= ', ' : $members .= '';
                        $members .= @$member->staff->name;
                    }
                    return $members;
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

        $title = "Sales Group Setup";
        return view('admin.sales_group.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            $staffs = Staff::whereIn('id', request('staff_id'))->orderBy('name', 'asc')->get();
            $html = '';
            foreach ($staffs as $staff) {
                $html .= "<option value='{$staff->id}'>{$staff->name}</option>";
            }
            return response()->json(['status' => 'success', 'html' => $html]);
        }
        $title = 'Add New Sales Group';
        $companies = Company::orderBy('name')->get();
        $used_staffs = GroupMember::get()->pluck('staff_id')->toArray();
        $staffs = Staff::where('status', 1)->whereNotIn('id', $used_staffs)->where('type', 'sales')->orderBy('name', 'asc')->get();
        return view('admin.sales_group.create', compact('title', 'companies', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'staff_id' => 'required',
            'team_leader' => 'required',
        ]);

        $data = Group::create([
            'company_id' => $request->company_id ?? Auth::user()->id,
            'name' => $request->name,
            'team_leader' => $request->team_leader,
            'created_by' => Auth::user()->id,
        ]);

        foreach ($request->staff_id as $staff_id) {
            GroupMember::create([
                'group_id' => $data->id,
                'staff_id' => $staff_id
            ]);
        }

        return redirect()->Route('admin.group.index')->withSuccessMessage('Created Successfully!');
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
            $data = Group::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax()) {
            $staffs = Staff::whereIn('id', request('staff_id'))->orderBy('name', 'asc')->get();
            $html = '';
            foreach ($staffs as $staff) {
                $html .= "<option value='{$staff->id}'>{$staff->name}</option>";
            }
            return response()->json(['status' => 'success', 'html' => $html]);
        }

        $title = 'Update Sales Group';
        $companies = Company::orderBy('name')->get();
        $link = route('admin.group.update', $id);
        $data = Group::findOrFail($id);
        $selected_staffs = $data->members->pluck('staff_id')->toArray();
        $used_staffs = GroupMember::whereNotIn('staff_id', $selected_staffs)->get()->pluck('staff_id')->toArray();
        $staffs = Staff::where('status', 1)->whereNotIn('id', $used_staffs)->where('type', 'sales')->orderBy('name', 'asc')->get();
        return view('admin.sales_group.edit', compact('title', 'companies', 'staffs', 'data', 'link', 'selected_staffs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'staff_id' => 'required',
            'team_leader' => 'required',
        ]);

        $data = Group::findOrFail($id);

        $data->update([
            'company_id' => $request->company_id ?? Auth::user()->id,
            'name' => $request->name,
            'team_leader' => $request->team_leader,
            'updated_by' => Auth::user()->id,
        ]);

        GroupMember::where('group_id', $id)->delete();
        foreach ($request->staff_id as $staff_id) {
            GroupMember::create([
                'group_id' => $data->id,
                'staff_id' => $staff_id
            ]);
        }

        return redirect()->Route('admin.group.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Group::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Group::onlyTrashed()->findOrFail($id);
                foreach ($data->members as $member) {
                    $member->delete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Group::onlyTrashed()->findOrFail($id);
            foreach ($data->members as $member) {
                $member->delete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Group::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Group::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
