<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientMessageController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        if (request()->ajax()) {
            $model = ClientMessage::whereNull('product_id')->latest('id');
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return '<span class="text-nowrap">' . date('d-m-Y', strtotime($row->created_at)) . '</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '<button type="button" class="btn btn-sm border-0 px-10px fs-15 btn-success tt view-message" data-date="' . date('d-m-Y h:i:A', strtotime($row->created_at)) . '" data-url="' . Route('admin.client-message.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View Message"><i class="fas fa-eye"></i></button>';
                })
                ->rawColumns(['date', 'actions'])
                ->make(true);
        }
        $title = "Contact Message";
        $inactive_create = true;
        return view('admin.client_message.index', compact('title', 'inactive_create'));
    }

    // Display a listing of the resource.
    public function onlineRequest()
    {
        if (request()->ajax()) {
            $model = ClientMessage::with(['product'])->whereNotNull('product_id')->latest('id');
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return '<span class="text-nowrap">' . date('d-m-Y h:i:A', strtotime($row->created_at)) . '</span>';
                })
                ->addColumn('actions', function ($row) {
                    return '<button type="button" class="btn btn-sm border-0 px-10px fs-15 btn-success tt view-message" data-date="' . date('d-m-Y h:i:A', strtotime($row->created_at)) . '" data-url="' . Route('admin.client-request.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View Message"><i class="fas fa-eye"></i></button>';
                })
                ->rawColumns(['date', 'actions'])
                ->make(true);
        }

        $title = "Online Request";
        $inactive_create = true;
        return view('admin.online_request.index', compact('title', 'inactive_create'));
    }

    public function showMessage(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = ClientMessage::find($id);
            return response()->json(['status' => 'success', 'data' => $data]);
        }
    }

    // Show the form for creating a new resource.
    public function create()
    {
        //
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'message' => 'required',
        ]);

        ClientMessage::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'message' => $request->message,
            'status' => true,
        ]);
        return redirect()->back()->withSuccessMessage('Message Sent Successfully!');
    }

    // Display the specified resource.
    public function show(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = ClientMessage::find($id);
            return response()->json(['status' => 'success', 'data' => $data]);
        }
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        //
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        //
    }

    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
        //
    }
}
