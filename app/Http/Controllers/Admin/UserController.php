<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = User::with(['company'])->whereIn('role', [1, 2])->whereNotIn('id', [Auth::user()->id])->latest('id');
            $company_id = Auth::user()->company_id;
            if ($company_id) {
                $model->where('company_id', $company_id);
            }
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            $model->whereNotIn('user_name', ['admin']);
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('company', function ($row) {
                    return @$row->company->name;
                })
                ->addColumn('stores', function ($row) {
                    if (is_array($row->stores)) {
                        return Store::whereIn('id', $row->stores)->pluck('name')->toArray();
                    }
                })
                ->addColumn('image', function ($row) {
                    $image = '<img class="lazyload" data-src="' . (file_exists($row->image) ? asset($row->image) : asset('backend/images/avatar/default/user.jpg')) . ' " height="40" alt="' . $row->name . '">';
                    return $image;
                })
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->toArray();
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.user.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('area', function ($row) {
                    if (is_array(json_decode($row->area_id))) {
                        return Area::whereIn('id', json_decode($row->area_id))->orderBy('name', 'asc')->get()->pluck('name')->toArray();
                    }
                })
                ->addColumn('branch', function ($row) {
                    if (is_array(json_decode($row->branch_id))) {
                        return Branch::whereIn('id', json_decode($row->branch_id))->orderBy('name', 'asc')->get()->pluck('name')->toArray();
                    }
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $type = request('type');
                    if (!empty($type) && $type == 'trash') {
                        $actionBtn .= '<button type="button" class="btn btn-sm border-0 px-10px fs-15 tt btn-success link-recovery" data-url="' . Route('admin.user.destroy', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Recovery"><i class="fad fa-recycle"></i></button>';
                    } else {
                        if ($row->role == 1) {
                            if (!in_array('Software Admin', json_decode($row->getRoleNames())) && Auth::user()->hasRole('Software Admin') || Auth::user()->can('admin.user.edit') && !in_array('Software Admin', json_decode($row->getRoleNames()))) {
                                $actionBtn .= '<a href="' . Route('admin.user.edit', $row->id) . '" class="btn btn-sm btn-warning border-0 px-10px fs-15 tt link-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="far fa-pencil-alt"></i></a>';
                            }
                        }
                        if (!in_array('Software Admin', json_decode($row->getRoleNames())) && Auth::user()->can('admin.user.password')) {
                            $actionBtn .= '<a href="' . Route('admin.user.password', $row->id) . '" class="btn btn-sm btn-warning border-0 px-10px fs-15 tt bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Password"><i class="fal fa-key"></i></a>';
                        }
                    }
                    if ($row->role == 1) {
                        if (!in_array('Software Admin', json_decode($row->getRoleNames())) && Auth::user()->hasRole('Software Admin') || Auth::user()->can('admin.user.destroy') && !in_array('Software Admin', json_decode($row->getRoleNames()))) {
                            $actionBtn .= '<button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 tt ' . (!empty($type) && $type == 'trash' ? 'trash_delete' : 'link-delete') . '" data-url="' . Route('admin.user.destroy', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="far fa-trash-alt"></i></button>';
                        }
                    }
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'image', 'status', 'actions'])
                ->make(true);
        }
        $title = 'User Management';
        return view('admin.user.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax() && request()->has('branch_id')) {
            $stores = Store::whereIn('branch_id', request('branch_id'))->get();
            return response()->json(['status' => 'success', 'stores' => $stores]);
        }

        $title = 'User Informations';
        $companies = Company::orderBy('name')->get();
        $roles = Role::whereNotIn('name', ['Software Admin'])->orderBy('name', 'asc')->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $branches = Branch::where('status', 1)->orderBy('name', 'asc')->get();
        $clients = Client::where('status', 1)->whereNull('user_id')->orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        return view('admin.user.create', compact('title', 'companies', 'roles', 'areas', 'branches', 'clients', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->client_id) {
            $client = Client::findOrFail($request->client_id);
            $check_user = User::where(function ($query) use ($client) {
                $query->where('user_name', $client->phone)->orWhere('email', $client->email)->orWhere('phone', $client->phone);
            })->whereNotNull('user_name')->whereNotNull('email')->whereNotNull('phone')->first();
            if ($check_user) {
                return redirect()->back()->withErrors('User Already Exists!');
            }
            $user = User::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'role' => 2,
                'name' => $client->name,
                'user_name' => $client->phone,
                'email' => $client->email,
                'phone' => $client->phone,
                'status' => 1,
                'password' => Hash::make($client->phone),
                'created_by' => Auth::user()->id,
            ]);
            $client->update(['user_id' => $user->id]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'unique:users,user_name'],
                'email' => ['email', 'nullable', 'unique:users,email'],
                'phone' => ['nullable', 'unique:users,phone'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'role' => 1,
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'area_id' => !is_null($request->area_id) ? json_encode($request->area_id) : $request->area_id,
                'branch_id' => !is_null($request->branch_id) ? json_encode($request->branch_id) : $request->branch_id,
                'store_id' => !is_null($request->store_id) ? json_encode($request->store_id) : $request->store_id,
                'is_staff' => $request->is_staff,
                'staff_id' => $request->is_staff == 1 ? $request->staff_id : NULL,
                'status' => $request->status,
                'password' => Hash::make($request->password),
                'created_by' => Auth::user()->id,
            ]);
        }

        $role = Role::findById($request->role_id);
        $user->assignRole($role);
        return redirect()->Route('admin.user.index')->withSuccessMessage('Created Successfully!');
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
            $data = User::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax() && request()->has('branch_id')) {
            $stores = Store::whereIn('branch_id', request('branch_id'))->get();
            return response()->json(['status' => 'success', 'stores' => $stores]);
        }

        $title = 'User Informations';
        $companies = Company::orderBy('name')->get();
        $roles = Role::whereNotIn('name', ['Software Admin'])->orderBy('name', 'asc')->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $branches = Branch::where('status', 1)->orderBy('name', 'asc')->get();
        $data = User::findOrFail($id);
        if (is_array(json_decode($data->branch_id))) {
            $stores = Store::whereIn('branch_id', json_decode($data->branch_id))->orderBy('name', 'asc')->get();
        } else {
            $stores = array();
        }
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $link = Route('admin.user.update', $data->id);
        return view('admin.user.edit', compact('title', 'companies', 'roles', 'areas', 'branches', 'data', 'stores', 'staffs', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'unique:users,user_name,' . $id],
            'email' => ['email', 'nullable', 'unique:users,email,' . $id],
            'phone' => ['nullable', 'unique:users,phone,' . $id],
        ]);

        $role = Role::findById($request->role_id);
        $data = User::findOrFail($id);

        $data->update([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'area_id' => !is_null($request->area_id) ? json_encode($request->area_id) : $request->area_id,
            'branch_id' => !is_null($request->branch_id) ? json_encode($request->branch_id) : $request->branch_id,
            'store_id' => !is_null($request->store_id) ? json_encode($request->store_id) : $request->store_id,
            'is_staff' => $request->is_staff,
            'staff_id' => $request->is_staff == 1 ? $request->staff_id : NULL,
            'updated_by' => Auth::user()->id,
        ]);
        $data->syncRoles($role);
        return redirect()->route('admin.user.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = User::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = User::onlyTrashed()->findOrFail($id);
                if (file_exists($data->image)) {
                    unlink($data->image);
                }
                $client = Client::where('user_id', $id)->first();
                if (!is_null($client)) {
                    $client->update('user_id', NULL);
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = User::onlyTrashed()->findOrFail($id);
            if (file_exists($data->image)) {
                unlink($data->image);
            }
            $client = Client::where('user_id', $id)->first();
            if (!is_null($client)) {
                $client->update('user_id', NULL);
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = User::findOrFail($id);
                if (in_array('Software Admin', json_decode($data->getRoleNames()))) {
                    continue;
                }
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = User::findOrFail($id);
        if (in_array('Software Admin', json_decode($data->getRoleNames()))) {
            return response()->json(['status' => 'error']);
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();
        return response()->json(['status' => 'success']);
    }

    public function changePassword(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.password', compact('user'));
    }

    public function passwordUpdate(Request $request, string $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.user.index')->withSuccessMessage('Password Updated Successfully!');
    }
}
