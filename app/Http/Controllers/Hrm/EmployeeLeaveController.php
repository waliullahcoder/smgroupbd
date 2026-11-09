<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('hrm_employee_leaves as el')
                ->leftJoin('staff as s', 's.id', '=', 'el.employee_id')
                ->leftJoin('users as u', 'u.id', '=', 'el.approved_by')
                ->select(
                    'el.id',
                    'el.employee_id',
                    's.code as employee_code',
                    's.name as employee_name',
                    'el.leave_type',
                    'el.from_date',
                    'el.to_date',
                    'el.total_days',
                    'el.day_type',
                    'el.status',
                    'el.remarks',
                    'u.name as approved_by'
                )
                ->orderByDesc('el.id');

            return DataTables::of($model)

                ->editColumn('from_date', function ($row) {
                    return date('d M, Y', strtotime($row->from_date));
                })

                ->editColumn('to_date', function ($row) {
                    return date('d M, Y', strtotime($row->to_date));
                })

                ->editColumn('status', function ($row) {

                    switch ($row->status) {

                        case 'Approved':
                            $color = 'success';
                            break;

                        case 'Rejected':
                            $color = 'danger';
                            break;

                        case 'Pending':
                            $color = 'warning';
                            break;

                        default:
                            $color = 'secondary';
                    }

                    return '<span class="badge bg-'.$color.'">'.$row->status.'</span>';
                })

                ->addColumn('actions', function ($row) {

                    $btn='';

                    if(auth()->user()->can('admin.employee-leave.show')){
                        $btn.='<a href="'.route('admin.employee-leave.show',$row->id).'"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>';
                    }

                    if(auth()->user()->can('admin.employee-leave.edit')){
                        $btn.='<a href="'.route('admin.employee-leave.edit',$row->id).'"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>';
                    }

                    if(auth()->user()->can('admin.employee-leave.destroy')){
                        $btn.='<button
                                class="btn btn-sm btn-danger link-delete"
                                data-url="'.route('admin.employee-leave.destroy',$row->id).'">
                                <i class="fas fa-trash"></i>
                            </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';

                })

                ->rawColumns([
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('hrm.employee_leave.index');
    }

    public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_leave.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:staff,id',
            'leave_type'  => 'required|string|max:255',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'day_type'    => 'required',
            'reason'      => 'required|string',
            'attachment'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'remarks'     => 'nullable|string',
        ]);

        // Calculate Total Days
        $from = \Carbon\Carbon::parse($request->from_date);
        $to   = \Carbon\Carbon::parse($request->to_date);

        $totalDays = $from->diffInDays($to) + 1;

        if ($request->day_type == 'First Half' || $request->day_type == 'Second Half') {
            $totalDays -= 0.5;
        }

        // Upload Attachment
        $attachment = null;

        if ($request->hasFile('attachment')) {

            $file = $request->file('attachment');

            $attachment = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/employee_leave'), $attachment);
        }

        DB::table('hrm_employee_leaves')->insert([

            'employee_id' => $request->employee_id,
            'leave_type'  => $request->leave_type,
            'from_date'   => $request->from_date,
            'to_date'     => $request->to_date,
            'total_days'  => $totalDays,
            'day_type'    => $request->day_type,
            'reason'      => $request->reason,
            'attachment'  => $attachment,
            'status'      => 'Pending',

            'approved_by' => null,
            'approved_at' => null,

            'remarks'     => $request->remarks,

            'created_by'  => auth()->id(),
            'updated_by'  => null,

            'created_at'  => now(),
            'updated_at'  => now(),

        ]);

        return redirect()
            ->route('admin.employee-leave.index')
            ->withSuccessMessage('Employee leave application submitted successfully.');
    }


    public function edit($id)
    {
        $leave = DB::table('hrm_employee_leaves')->where('id', $id)->first();

        if (!$leave) {
            abort(404);
        }

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_leave.edit', compact('leave', 'employees'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:staff,id',
            'leave_type'  => 'required|string|max:255',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'day_type'    => 'required',
            'reason'      => 'required',
            'attachment'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $leave = DB::table('hrm_employee_leaves')->where('id', $id)->first();

        if (!$leave) {
            abort(404);
        }

        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);

        $totalDays = $from->diffInDays($to) + 1;

        if (in_array($request->day_type, ['First Half', 'Second Half'])) {
            $totalDays -= 0.5;
        }

        $attachment = $leave->attachment;

        if ($request->hasFile('attachment')) {

            if ($attachment && file_exists(public_path('uploads/employee_leave/' . $attachment))) {
                unlink(public_path('uploads/employee_leave/' . $attachment));
            }

            $file = $request->file('attachment');

            $attachment = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/employee_leave'), $attachment);
        }

        DB::table('hrm_employee_leaves')
            ->where('id', $id)
            ->update([

                'employee_id' => $request->employee_id,
                'leave_type' => $request->leave_type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'total_days' => $totalDays,
                'day_type' => $request->day_type,
                'reason' => $request->reason,
                'attachment' => $attachment,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'updated_by' => auth()->id(),
                'updated_at' => now(),

            ]);

        return redirect()
            ->route('admin.employee-leave.index')
            ->withSuccessMessage('Employee Leave Updated Successfully.');
    }



    
}