<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $data = DB::table('hrm_employee_attendances as a')
                ->leftJoin('staff as e', 'e.id', '=', 'a.employee_id')
                ->select(
                    'a.*',
                    'e.code as emp_code',
                    'e.name'
                )
                ->orderBy('a.id', 'desc');

            return DataTables::of($data)

                    ->addIndexColumn()

                    ->addColumn('employee', function ($row) {
                        return $row->emp_code . ' - ' . $row->name;
                    })

                    ->editColumn('attendance_status', function ($row) {

                        switch ($row->attendance_status) {

                            case 'Present':
                                return '<span class="badge bg-success">Present</span>';

                            case 'Late':
                                return '<span class="badge bg-warning">Late</span>';

                            case 'Absent':
                                return '<span class="badge bg-danger">Absent</span>';

                            case 'Half Day':
                                return '<span class="badge bg-info">Half Day</span>';

                            case 'Leave':
                                return '<span class="badge bg-secondary">Leave</span>';

                            case 'Holiday':
                                return '<span class="badge bg-primary">Holiday</span>';

                            case 'Weekend':
                                return '<span class="badge bg-dark">Weekend</span>';

                            default:
                                return $row->attendance_status;
                        }

                    })

                ->addColumn('actions', function ($row) {

                    $data = [
                        'id'=>$row->id,
                        'edit'=>true,
                    ];

                    $actionBtn = NULL;

                    if(Auth::user()->can('admin.employee-attendance.show')){
                        $actionBtn .= '<a href="'.Route('admin.employee-attendance.show',$row->id).'" class="btn btn-sm btn-primary tt" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>';
                    }

                    return ActionButtons::actions($data,$actionBtn);

                })

                ->rawColumns([
                    'attendance_status',
                    'actions'
                ])

                ->make(true);
        }

        return view('hrm.employee_attendance.index');
    }

    public function create()
    {
        $employees = DB::table('staff')
            ->where('status',1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_attendance.create',compact('employees'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'attendance_date' => 'required',
            'attendance_status' => 'required',
        ]);

       

        if(isset($request->employee_id) && count($request->employee_id)>0){
              $attendexist= DB::table('hrm_employee_attendances')->where('attendance_date',$request->attendance_date)->whereIn('employee_id',$request->employee_id)->count();
              if($attendexist){
                 return redirect()->back()->withErrors('Already Exist attendance!');
              }
             
           foreach ($request->employee_id as $key => $employeeId) {
                DB::table('hrm_employee_attendances')->insert([
                    'employee_id'       => $employeeId,
                    'attendance_date'   => $request->attendance_date,
                    'check_in'          => $request->check_in,
                    'check_out'         => $request->check_out,
                    'late_minutes'      => $request->late_minutes,
                    'overtime_minutes'  => $request->overtime_minutes,
                    'worked_hours'      => $request->worked_hours,
                    'attendance_status' => $request->attendance_status,
                    'remarks'           => $request->remarks,
                    'created_by'        => auth()->id(),
                    'created_at'        => now(),
                ]);
                }
                
    return redirect()
        ->route('admin.employee-attendance.index')
        ->with('success', 'Attendance saved successfully.');
            }else{
                return redirect()
                ->route('admin.employee-attendance.create')
                ->with('error', 'Ops! select employee');
            }
    }


    public function edit($id)
    {
        $data = DB::table('hrm_employee_attendances')
            ->where('id', $id)
            ->first();

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_attendance.edit', compact('data', 'employees'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required',
            'attendance_date' => 'required|date',
            'attendance_status' => 'required',
        ]);

        DB::table('hrm_employee_attendances')
            ->where('id', $id)
            ->update([

                'employee_id'       => $request->employee_id,
                'attendance_date'   => $request->attendance_date,
                'check_in'          => $request->check_in,
                'check_out'         => $request->check_out,
                'late_minutes'      => $request->late_minutes,
                'overtime_minutes'  => $request->overtime_minutes,
                'worked_hours'      => $request->worked_hours,
                'attendance_status' => $request->attendance_status,
                'remarks'           => $request->remarks,
                'updated_by'        => auth()->id(),
                'updated_at'        => now(),

            ]);

        return redirect()
            ->route('admin.employee-attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }


}
