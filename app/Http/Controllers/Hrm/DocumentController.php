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

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_documents as dc')
                ->leftJoin('staff as e', 'e.id', '=', 'dc.employee_id')
                ->select(
                    'dc.id',
                    'e.code as employee_code',
                    'e.name',
                    'dc.document_type',
                    'dc.document_name',
                    'dc.document_link',
                    'dc.remarks',
                    'dc.submit_date',
                    'dc.status'
                )->orderBy('id','desc');

            return DataTables::of($model)
    

                ->editColumn('submit_date', function ($row) {
                    return date('d M, Y', strtotime($row->submit_date));
                })

                ->editColumn('status', function ($row) {
                    if ($row->status == 'Pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    }

                    return '<span class="badge bg-success">Submitted</span>';
                })

                    ->editColumn('document_link', function ($row) {
                        return '<a href="' . $row->document_link . '" 
                                    target="_blank" 
                                    class="badge bg-success">
                                    Document Link
                                </a>';
                    })

                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if(auth()->user()->can('admin.documents.show')){
                        $btn .= '<a href="'.route('admin.documents.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.documents.edit')){
                        $btn .= '<a href="'.route('admin.documents.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.documents.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.documents.destroy',$row->id).'">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';
                })

                ->rawColumns([
                    'document_link',
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('hrm.documents.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.documents.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'document_type'      => 'required',
            'document_name'  => 'required',
            'document_link'  => 'required',
            'submit_date'    => 'required|date',
            'status'         => 'required|in:Pending,Submitted',
            'remarks'        => 'nullable|string',
        ]);
       
        DB::table('hrm_employee_documents')->insert([
            'employee_id'   => $request->employee_id,
            'document_type'    => $request->document_type,
            'document_name' => $request->document_name,
            'document_link' => $request->document_link,
            'submit_date'  => $request->submit_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->withSuccessMessage('Employee Document added successfully.');
    }

    public function edit($id)
    {
        $document = DB::table('hrm_employee_documents')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.documents.edit', compact('document', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'document_type'=> 'required',
            'document_name' => 'required',
            'document_link' => 'required',
            'submit_date'  => 'required|date',
            'status'        => 'required|in:Pending,Submitted',
            'remarks'       => 'nullable|string|max:1000',
        ]);
       
        DB::table('hrm_employee_documents')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'document_type'    => $request->document_type,
                'document_name' => $request->document_name,
                'document_link' => $request->document_link,
                'submit_date'  => $request->submit_date,
                'remarks'       => $request->remarks,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.documents.index')
            ->withSuccessMessage('Employee Documents updated successfully.');
    }

    
}