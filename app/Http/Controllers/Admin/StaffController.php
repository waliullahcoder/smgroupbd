<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Staff::with(['company', 'branch', 'store']);
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
                ->addColumn('joining_date', function ($row) {
                    return date('d-m-Y', strtotime($row->joining_date));
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.staff.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
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

        $title = "Staff/Employee Setup";
        return view('admin.staff.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            $branches = Branch::where('company_id', request('company_id'))->orderBy('name')->get();
            return response()->json(['status' => 'success', 'branches' => $branches]);
        }

        $title = 'Add New Staff/Employee';
        $companies = Company::orderBy('name')->get();
        $branches = Branch::where('company_id', Auth::user()->company_id)->orderBy('name')->get();
        return view('admin.staff.create', compact('title', 'companies', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'joining_date' => 'required',
        ]);

        Staff::create([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'branch_id' => $request->branch_id,
            'code' => $request->code,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'designation' => $request->designation,
            'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'ac_no' => $request->ac_no,
            'ac_branch' => $request->ac_branch,
            'leave_balance' => $request->leave_balance,
            'address' => $request->address,
            'basic_salary' => $request->basic_salary,
            'house_rent' => $request->house_rent,
            'medical_allowance' => $request->medical_allowance,
            'others' => $request->others,
            'deducted' => $request->deducted,
            'increment_percent' => $request->increment_percent,
            'increment_amount' => $request->increment_amount,
            'total_salary' => $request->total_salary,
            'type' => $request->type,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.staff.index')->withSuccessMessage('Created Successfully!');
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
            $data = Staff::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax()) {
            $branches = Branch::where('company_id', request('company_id'))->orderBy('name')->get();
            return response()->json(['status' => 'success', 'branches' => $branches]);
        }

        $title = 'Update Staff/Employee';
        $data = Staff::findOrFail($id);
        $link = Route('admin.staff.update', $id);
        $companies = Company::orderBy('name')->get();
        $branches = Branch::where('company_id', $data->company_id)->orderBy('name')->get();
        return view('admin.staff.edit', compact('title', 'data', 'link', 'companies', 'branches', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_id' => 'required',
            'code' => 'required',
            'type' => 'required',
            'name' => 'required',
            'joining_date' => 'required',
        ]);

        $data = Staff::findOrFail($id);
        $data->update([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'branch_id' => $request->branch_id,
            'code' => $request->code,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'designation' => $request->designation,
            'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'ac_no' => $request->ac_no,
            'ac_branch' => $request->ac_branch,
            'address' => $request->address,
            'basic_salary' => $request->basic_salary,
            'house_rent' => $request->house_rent,
            'medical_allowance' => $request->medical_allowance,
            'others' => $request->others,
            'deducted' => $request->deducted,
            'increment_percent' => $request->increment_percent,
            'increment_amount' => $request->increment_amount,
            'total_salary' => $request->total_salary,
            'leave_balance' => $request->leave_balance,
            'type' => $request->type,
            'updated_by' => Auth::user()->id,
        ]);
        return redirect()->route('admin.staff.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Staff::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Staff::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Staff::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Staff::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Staff::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
