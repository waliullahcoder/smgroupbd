<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Models\User;
use App\Services\ActionButtons\ActionButtons;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Company::query();
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
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    return ActionButtons::actions($data);
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Company Setup";
        return view('admin.company.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Company';
        return view('admin.company.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'logo' => 'image|required',
        ]);

        DB::beginTransaction();
        try {
            $logo = $request->file('logo');
            if (isset($logo)) {
                $response = HelperClass::storeImage($logo, 500, 'media/company/');
                if ($response['status'] == 'success') {
                    $path_name =  $response['path_name'];
                } else {
                    $path_name = NULL;
                }
            } else {
                $path_name = NULL;
            }

            // Create Company
            $company = Company::create([
                'prefix' => $request->prefix,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'website' => $request->website,
                'vat' => $request->vat,
                'tin' => $request->tin,
                'trade_license' => $request->trade_license,
                'address' => $request->address,
                'logo' => $path_name,
                'created_by' => Auth::user()->id,
            ]);

            // Create Branch
            $branch = Branch::create([
                'company_id' => $company->id,
                'prefix' => $request->prefix,
                'name' => 'Head Office',
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ]);

            // Create Store
            Store::create([
                'branch_id' => $branch->id,
                'company_id' => $company->id,
                'type' => 'Branch Store',
                'name' => $branch->name . ' Store',
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ]);

            // create user
            $user = User::create([
                'role' => 1,
                'company_id' => $company->id,
                'name' => $request->name,
                'user_name' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt(12345678),
                'created_by' => Auth::user()->id,
            ]);

            $role = Role::findByName('System Admin');
            $user->assignRole($role);

            DB::commit();
            return redirect()->route('admin.company.index')->withSuccessMessage('Created Successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Something Went Wrong!!!');
        }
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
        $data = Company::findOrFail($id);
        $title = 'Update Company Information';
        $link = Route('admin.company.update', $id);
        return view('admin.company.edit', compact('data', 'title', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:companies,username,' . $id,
            'email' => 'required|email|unique:companies,email,' . $id,
            'phone' => 'required|unique:companies,phone,' . $id,
            'email' => 'required|email',
            'phone' => 'required',
            'logo' => 'image',
        ]);

        $company = Company::findOrFail($id);
        $logo = $request->file('logo');
        if (isset($logo)) {
            $response = HelperClass::storeImage($logo, 500, 'media/company/', $company->logo);
            if ($response['status'] == 'success') {
                $path_name =  $response['path_name'];
            } else {
                $path_name = $company->logo;
            }
        } else {
            $path_name = $company->logo;
        }

        // Create Company
        $company->update([
            'prefix' => $request->prefix,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'website' => $request->website,
            'vat' => $request->vat,
            'tin' => $request->tin,
            'trade_license' => $request->trade_license,
            'address' => $request->address,
            'logo' => $path_name,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.company.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Company::onlyTrashed()->findOrFail($id);
            foreach ($data->stores as $store) {
                $store->restore();
            }
            foreach ($data->branches as $branch) {
                $branch->restore();
            }
            foreach ($data->users as $user) {
                $user->restore();
            }
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Company::onlyTrashed()->findOrFail($id);
                if (file_exists($data->logo)) {
                    unlink($data->logo);
                }
                foreach ($data->stores as $store) {
                    $store->forceDelete();
                }
                foreach ($data->branches as $branch) {
                    $branch->forceDelete();
                }
                foreach ($data->users as $user) {
                    $user->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Company::onlyTrashed()->findOrFail($id);
            if (file_exists($data->logo)) {
                unlink($data->logo);
            }
            foreach ($data->stores as $store) {
                $store->forceDelete();
            }
            foreach ($data->branches as $branch) {
                $branch->forceDelete();
            }
            foreach ($data->users as $user) {
                $user->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Company::findOrFail($id);
                foreach ($data->stores as $store) {
                    $store->update(['deleted_by' => Auth::user()->id]);
                    $store->delete();
                }
                foreach ($data->branches as $branch) {
                    $branch->update(['deleted_by' => Auth::user()->id]);
                    $branch->delete();
                }
                foreach ($data->users as $user) {
                    $user->update(['deleted_by' => Auth::user()->id]);
                    $user->delete();
                }
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Company::findOrFail($id);
        foreach ($data->stores as $store) {
            $store->update(['deleted_by' => Auth::user()->id]);
            $store->delete();
        }
        foreach ($data->branches as $branch) {
            $branch->update(['deleted_by' => Auth::user()->id]);
            $branch->delete();
        }
        foreach ($data->users as $user) {
            $user->update(['deleted_by' => Auth::user()->id]);
            $user->delete();
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
