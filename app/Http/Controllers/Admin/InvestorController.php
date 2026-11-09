<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Models\User;
use App\Models\CoaSetup;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class InvestorController extends Controller
{
    public $path;
    public $title;
    public $create_title;
    public $edit_title;
    public $model;
    public function __construct()
    {
        $this->path = 'investor';
        $this->title = 'investor Setup';
        $this->create_title = 'Add investor';
        $this->edit_title = 'Update investor';
        $this->model = Investor::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HelperClass::resourceDataView($this->model::with(['invests'])->orderBy('id', 'desc'), NULL, NULL, $this->path, $this->title, 'invests');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->create_title;
        $investor_coa_id = Investor::whereNotNull('coa_setup_id')->get('coa_setup_id')->pluck('coa_setup_id')->toArray();
        $coas = CoaSetup::whereNotIn('id', $investor_coa_id)->where('head_code', 'like', '202%')->where('transaction', 1)->get();
        return view("admin.{$this->path}.create", compact('title', 'coas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'phone' => 'required|unique:users,phone',
        ]);

        if (!is_null($request->email)) {
            $request->validate([
                'email' => 'email|unique:users,email',
            ]);
        }

        DB::transaction(function () use ($request) {
            $user = User::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'role' => 2,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_name' => $request->phone,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 500, 'media/investors/') : NULL,
                'password' => Hash::make($request->phone),
                'created_by' => Auth::user()->id,
            ]);

            $file = $request->document;
            if (isset($file)) {
                $fileName = $file->getClientOriginalName();
                $fileName = pathinfo($fileName, PATHINFO_FILENAME);
                $fileExtension = $file->getClientOriginalExtension();
                $fileFullName = $fileName . '_' . time() . '.' . $fileExtension;
                $create_path = public_path('investor-document');
                if (!File::isDirectory($create_path)) {
                    File::makeDirectory($create_path, 0777, true, true);
                }
                $file->move($create_path, $fileFullName);
                $document = 'investor-document/' . $fileFullName;
            }

            $this->model::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'nid' => $request->nid,
                'bkash' => $request->bkash,
                'rocket' => $request->rocket,
                'nagad' => $request->nagad,
                'bank' => $request->bank,
                'branch' => $request->branch,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'user_id' => $user->id,
                'coa_setup_id' => $request->coa_setup_id,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 500, 'media/investors/') : NULL,
                'document' => @$document,
                'created_by' => Auth::user()->id,
            ]);

            $role = Role::findByName('Investor');
            $user->assignRole($role);
        });

        return redirect()->route("admin.{$this->path}.index")->withSuccessMessage('Created Successfully!');
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
        if (request()->ajax() && request()->has('status')) {
            $data = $this->model::findOrFail($id);
            $user = User::find($data->user_id);
            $user->update(['status' => !$user->status]);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }
        
        $investor_coa_id = Investor::whereNotNull('coa_setup_id')->where('id', '!=', $id)->get('coa_setup_id')->pluck('coa_setup_id')->toArray();
        $additionalData = [
            'coas' => CoaSetup::whereNotIn('id', $investor_coa_id)->where('head_code', 'like', '202%')->where('transaction', 1)->get()
        ];

        return HelperClass::resourceDataEdit($this->model, $id, $this->path, $this->edit_title, $additionalData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->model::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'phone' => 'required|unique:users,phone,' . $data->user_id,
        ]);

        if (!is_null($request->email)) {
            $request->validate([
                'email' => 'email|unique:users,email,' . $data->user_id,
            ]);
        }

        DB::transaction(function () use ($request, $id, $data) {
            $user = User::findOrFail($data->user_id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_name' => $request->phone,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 500, 'media/investors/', $user->image) : $user->image,
                'updated_by' => Auth::user()->id,
            ]);

            $file = $request->document;
            if (isset($file)) {
                $fileName = $file->getClientOriginalName();
                $fileName = pathinfo($fileName, PATHINFO_FILENAME);
                $fileExtension = $file->getClientOriginalExtension();
                $fileFullName = $fileName . '_' . time() . '.' . $fileExtension;
                $create_path = public_path('investor-document');
                $file->move($create_path, $fileFullName);
                $document = 'investor-document/' . $fileFullName;
                if (file_exists($data->document)) {
                    unlink($data->document);
                }
            }

            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'nid' => $request->nid,
                'bkash' => $request->bkash,
                'rocket' => $request->rocket,
                'nagad' => $request->nagad,
                'bank' => $request->bank,
                'branch' => $request->branch,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'coa_setup_id' => $request->coa_setup_id,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 500, 'media/investors/', $data->image) : $data->image,
                'document' => @$document ?? $data->document,
                'updated_by' => Auth::user()->id,
            ]);
        });

        return redirect()->route("admin.{$this->path}.index")->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = $this->model::onlyTrashed()->findOrFail($id);
            $user = User::onlyTrashed()->findOrFail($data->user_id);
            $user->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = $this->model::onlyTrashed()->findOrFail($id);
            if (file_exists($data->image)) {
                unlink($data->image);
            }
            if (file_exists($data->document)) {
                unlink($data->document);
            }
            $user = User::onlyTrashed()->findOrFail($data->user_id);
            if (file_exists($user->image)) {
                unlink($user->image);
            }
            $user->forceDelete();
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = $this->model::findOrFail($id);
        $user = User::find($data->user_id);
        if ($user) {
            $user->update(['deleted_by' => Auth::user()->id]);
            $user->delete();
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
