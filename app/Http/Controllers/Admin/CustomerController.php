<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = User::query()->where('role', 0);
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.customers.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Delete Multiple Items
        if ($request->id) {
            foreach ($request->id as $id) {
                $user = User::findOrFail($id);
                $orders = Order::where('user_id', $id)->count();
                if ($orders == 0) {
                    if (file_exists($user->image)) {
                        unlink($user->image);
                    }
                    $user->delete();
                }
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $user = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->count();
        if ($orders == 0) {
            if (file_exists($user->image)) {
                unlink($user->image);
            }
            $user->delete();
        }
        return response()->json(['status' => 'success']);
    }
}
