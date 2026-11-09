<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ChainClient;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\Company;
use App\Models\Scopes\CompanyScope;
use App\Models\Staff;
use App\Models\Territory;
use App\Models\User;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Client::with(['company', 'reference', 'area', 'territory'])
                // ->select('clients.*', 'areas.name as area_name', 'territories.name as territory_name')
                // ->join('companies', 'clients.company_id', '=', 'companies.id')
                // ->join('areas', 'clients.area_id', '=', 'areas.id')
                // ->join('territories', 'clients.territory_id', '=', 'territories.id')
                // ->orderBy('area_name', 'ASC')
                // ->orderBy('territory_name', 'ASC')
                ->orderBy('name', 'ASC');
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
                ->addColumn('reference', function ($row) {
                    return @$row->reference->name;
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.client.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
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

        $title = "Client Setup";
        return view('admin.client.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            $territories = Territory::where('area_id', request('area_id'))->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'territories' => $territories]);
        }

        $title = 'Add New Client';
        $companies = Company::orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->orderBy('name', 'asc')->get();
        $categories = ClientCategory::where('status', 1)->orderBy('name', 'asc')->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $chain_clients = ChainClient::where('status', 1)->orderBy('name', 'asc')->get();
        $latest_client = Client::withoutGlobalScope(CompanyScope::class)->withTrashed()->orderBy('code', 'desc')->first();
        if ($latest_client) {
            $code = (int)$latest_client->code + 1;
        } else {
            $code = 1;
        }
        $client_coa_id = Client::whereNotNull('coa_setup_id')->get('coa_setup_id')->pluck('coa_setup_id')->toArray();
        $coas = CoaSetup::whereNotIn('id', $client_coa_id)->where('head_code', 'like', '10101%')->where('transaction', 1)->get();
        return view('admin.client.create', compact('title', 'companies', 'staffs', 'categories', 'areas', 'chain_clients', 'code', 'coas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference_by' => 'required',
            'area_id' => 'required',
            'territory_id' => 'required',
            'code' => 'required',
            'phone' => 'required|unique:users,phone|unique:users,user_name',
            'name' => 'required',
        ]);

        if (!is_null($request->email)) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);
        }

        DB::transaction(function () use ($request) {
            $user = User::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'role' => 2,
                'name' => $request->name,
                'user_name' => $request->phone,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => 1,
                'password' => Hash::make($request->phone),
                'created_by' => Auth::user()->id,
            ]);

            Client::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'user_id' => $user->id,
                'coa_setup_id' => $request->coa_setup_id,
                'reference_by' => $request->reference_by,
                'client_category_id' => $request->client_category_id,
                'area_id' => $request->area_id,
                'territory_id' => $request->territory_id,
                'code' => $request->code,
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'credit_limit' => $request->credit_limit,
                'discount' => $request->discount ?? 0,
                'bin_no' => $request->bin_no,
                'is_vat' => $request->has('is_vat') ? 1 : 0,
                'is_chain' => $request->has('is_chain') ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);

            $role = Role::findByName('Client');
            $user->assignRole($role);
        });

        return redirect()->route('admin.client.index')->withSuccessMessage('Created Successfully!');
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
            $data = Client::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax()) {
            $territories = Territory::where('area_id', request('area_id'))->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'territories' => $territories]);
        }

        $title = 'Update Client';
        $companies = Company::orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->orderBy('name', 'asc')->get();
        $categories = ClientCategory::where('status', 1)->orderBy('name', 'asc')->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $chain_clients = ChainClient::where('status', 1)->orderBy('name', 'asc')->get();
        $data = Client::findOrFail($id);
        $territories = Territory::where('area_id', $data->area_id)->orderBy('name', 'asc')->get();
        $link = Route('admin.client.update', $id);
        $client_coa_id = Client::whereNotIn('id', [$id])->whereNotNull('coa_setup_id')->get('coa_setup_id')->pluck('coa_setup_id')->toArray();
        $coas = CoaSetup::whereNotIn('id', $client_coa_id)->where('head_code', 'like', '10101%')->where('transaction', 1)->get();
        return view('admin.client.edit', compact('title', 'companies', 'staffs', 'categories', 'areas', 'chain_clients', 'data', 'territories', 'link', 'coas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'reference_by' => 'required',
            'area_id' => 'required',
            'territory_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        $data = Client::findOrFail($id);
        if ($data->user_id) {
            $user = User::find($data->user_id);
            if ($user) {
                $user->update(['user_name' => $request->phone]);
            }
        }
        $data->update([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'coa_setup_id' => $request->coa_setup_id,
            'reference_by' => $request->reference_by,
            'client_category_id' => $request->client_category_id,
            'area_id' => $request->area_id,
            'territory_id' => $request->territory_id,
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'credit_limit' => $request->credit_limit,
            'discount' => $request->discount ?? 0,
            'bin_no' => $request->bin_no,
            'is_vat' => $request->has('is_vat') ? 1 : 0,
            'is_chain' => $request->has('is_chain') ? 1 : 0,
            'updated_by' => Auth::user()->id,
        ]);
        return redirect()->route('admin.client.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Client::onlyTrashed()->findOrFail($id);
            $user = User::withTrashed()->find($data->user_id);
            if ($user) {
                $user->restore();
            }
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Client::onlyTrashed()->findOrFail($id);
                $user = User::withTrashed()->find($data->user_id);
                if ($user) {
                    $user->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Client::onlyTrashed()->findOrFail($id);
            $user = User::withTrashed()->find($data->user_id);
            if ($user) {
                $user->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Client::findOrFail($id);
                if ($data->user_id) {
                    $user = User::find($data->user_id);
                    if ($user) {
                        $user->update(['deleted_by' => Auth::user()->id]);
                        $user->delete();
                    }
                }
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Client::findOrFail($id);
        if ($data->user_id) {
            $user = User::find($data->user_id);
            if ($user) {
                $user->update(['deleted_by' => Auth::user()->id]);
                $user->delete();
            }
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
