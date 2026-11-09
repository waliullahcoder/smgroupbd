<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\Staff;
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

class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_appraisal as ap')
                ->leftJoin('staff as e', 'e.id', '=', 'ap.employee_id')
                ->select(
                    'ap.id',
                    'e.code as employee_code',
                    'e.name',
                    'ap.appraisal_period',
                    'ap.appraisal_date',
                    'ap.overall_rating',
                    'ap.summary',
                    'ap.status'
                ) ->orderByRaw('CAST(ap.overall_rating AS DECIMAL(10,2)) DESC');

            return DataTables::of($model)
    

                ->editColumn('appraisal_date', function ($row) {
                    return date('d M, Y', strtotime($row->appraisal_date));
                })

                ->editColumn('status', function ($row) {
                    if ($row->status == 'Pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    }

                    return '<span class="badge bg-success">Approved</span>';
                })

                    
                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if(auth()->user()->can('admin.appraisal.show')){
                        $btn .= '<a href="'.route('admin.appraisal.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.appraisal.edit')){
                        $btn .= '<a href="'.route('admin.appraisal.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.appraisal.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.appraisal.destroy',$row->id).'">
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

        return view('hrm.appraisal.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.appraisal.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'appraisal_period'  => 'required',
            'appraisal_date'    => 'required|date',
            'overall_rating'    => 'required|numeric|max:100',
            'status'         => 'required|in:Pending,Approved',
            'summary'        => 'nullable|string',
        ]);

        if($request->employee_id){
            $appraisalexist=DB::table('hrm_employee_appraisal')->where('employee_id',$request->employee_id)->count();
            if($appraisalexist){
            return redirect()->back()->withErrors('Already added for this Employee!');
           }
        }
       
        DB::table('hrm_employee_appraisal')->insert([
            'employee_id'   => $request->employee_id,
            'appraisal_period' => $request->appraisal_period,
            'appraisal_date'  => $request->appraisal_date,
            'overall_rating'  => $request->overall_rating,
            'summary'       => $request->summary,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.appraisal.index')
            ->withSuccessMessage('Employee Appraisal added successfully.');
    }

    public function edit($id)
    {
        $appraisal = DB::table('hrm_employee_appraisal')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.appraisal.edit', compact('appraisal', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'overall_rating' =>'required|numeric|max:100',
            'appraisal_period' => 'required',
            'appraisal_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved',
            'summary'       => 'nullable|string|max:1000',
        ]);
       
        DB::table('hrm_employee_appraisal')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'appraisal_period' => $request->appraisal_period,
                'appraisal_date'  => $request->appraisal_date,
                'overall_rating'  => $request->overall_rating,
                'summary'       => $request->summary,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.appraisal.index')
            ->withSuccessMessage('Employee Appraisal updated successfully.');
    }

    
}