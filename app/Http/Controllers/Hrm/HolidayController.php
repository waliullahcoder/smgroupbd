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

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
        {
            if (request()->ajax()) {

                $model = DB::table('hrm_employee_holidays as h')
                    ->leftJoin('branches as b', 'b.id', '=', 'h.branch_id')
                    ->select(
                        'h.id',
                        'h.holiday_name',
                        'h.holiday_type',
                        'h.from_date',
                        'h.to_date',
                        'h.total_days',
                        'h.repeat_yearly',
                        'h.status',
                        'b.name as branch_name'
                    )
                    ->orderByDesc('h.id');

                return DataTables::of($model)

                    ->editColumn('from_date', function ($row) {
                        return date('d M, Y', strtotime($row->from_date));
                    })

                    ->editColumn('to_date', function ($row) {
                        return date('d M, Y', strtotime($row->to_date));
                    })

                    ->editColumn('repeat_yearly', function ($row) {
                        return $row->repeat_yearly
                            ? '<span class="badge bg-success">Yes</span>'
                            : '<span class="badge bg-secondary">No</span>';
                    })

                    ->editColumn('status', function ($row) {

                        return $row->status
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>';
                    })

                    ->addColumn('actions', function ($row) {

                        $btn = '';

                        if(auth()->user()->can('admin.holiday.show')){
                            $btn .= '<a href="'.route('admin.holiday.show',$row->id).'"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>';
                        }

                        if(auth()->user()->can('admin.holiday.edit')){
                            $btn .= '<a href="'.route('admin.holiday.edit',$row->id).'"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>';
                        }

                        if(auth()->user()->can('admin.holiday.destroy')){
                            $btn .= '<button
                                class="btn btn-sm btn-danger link-delete"
                                data-url="'.route('admin.holiday.destroy',$row->id).'">
                                <i class="fas fa-trash"></i>
                            </button>';
                        }

                        return '<div class="btn-group">'.$btn.'</div>';
                    })

                    ->rawColumns([
                        'repeat_yearly',
                        'status',
                        'actions'
                    ])

                    ->make(true);
            }

            return view('hrm.holiday.index');
        }


    public function create()
    {
        $branches = DB::table('branches')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.holiday.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_name'    => 'required|string|max:255',
            'holiday_type'    => 'required|string|max:100',
            'from_date'       => 'required|date',
            'to_date'         => 'required|date|after_or_equal:from_date',
            'repeat_yearly'   => 'required|in:0,1',
            'branch_id'       => 'nullable',
            'description'     => 'nullable|string',
            'status'          => 'required|in:0,1',
        ]);

        // Auto Calculate Total Days
        $from = Carbon::parse($request->from_date);
        $to   = Carbon::parse($request->to_date);

        $totalDays = $from->diffInDays($to) + 1;

        DB::table('hrm_employee_holidays')->insert([

            'company_id'     => auth()->user()->company_id ?? null,

            'holiday_name'   => $request->holiday_name,
            'holiday_type'   => $request->holiday_type,

            'from_date'      => $request->from_date,
            'to_date'        => $request->to_date,
            'total_days'     => $totalDays,

            'repeat_yearly'  => $request->repeat_yearly,

            'branch_id'      => $request->branch_id,

            'description'    => $request->description,

            'status'         => $request->status,

            'created_by'     => auth()->id(),
            'updated_by'     => null,

            'created_at'     => now(),
            'updated_at'     => now(),

        ]);

        return redirect()
                ->route('admin.holiday.index')
                ->withSuccessMessage('Holiday Created Successfully.');
    }

    public function edit($id)
    {
        $holiday = DB::table('hrm_employee_holidays')
            ->where('id', $id)
            ->first();

        if (!$holiday) {
            abort(404);
        }

        $branches = DB::table('branches')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.holiday.edit', compact('holiday', 'branches'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'holiday_name'   => 'required|max:255',
            'holiday_type'   => 'required',
            'from_date'      => 'required|date',
            'to_date'        => 'required|date|after_or_equal:from_date',
            'repeat_yearly'  => 'required|in:0,1',
            'status'         => 'required|in:0,1',
        ]);

        $from = Carbon::parse($request->from_date);
        $to   = Carbon::parse($request->to_date);

        $totalDays = $from->diffInDays($to) + 1;

        DB::table('hrm_employee_holidays')
            ->where('id', $id)
            ->update([

                'holiday_name'  => $request->holiday_name,
                'holiday_type'  => $request->holiday_type,
                'from_date'     => $request->from_date,
                'to_date'       => $request->to_date,
                'total_days'    => $totalDays,
                'repeat_yearly' => $request->repeat_yearly,
                'branch_id'     => $request->branch_id,
                'description'   => $request->description,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),

            ]);

        return redirect()
            ->route('admin.holiday.index')
            ->withSuccessMessage('Holiday Updated Successfully.');
    }



    
}