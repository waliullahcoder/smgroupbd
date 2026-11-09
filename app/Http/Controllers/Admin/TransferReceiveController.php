<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LiftingProduct;
use App\Models\Transfer;
use App\Models\TransferProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransferReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Transfer::with(['company', 'host', 'destination', 'staff'])->where('approve', 0)->where('reject', 0)->latest('id');
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
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $actionBtn .= '<a class="btn btn-xxs tt btn-outline-info text-nowrap" href="' . Route('admin.transfer-receive.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i> View</a>';
                    $actionBtn .= '<button type="button" class="btn btn-xxs tt ms-1 btn-outline-success approve-btn" data-url="' . Route('admin.transfer-receive.edit', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve">Approve</button>';
                    $actionBtn .= '<button type="button" class="btn btn-xxs tt ms-1 btn-outline-danger reject-btn" data-url="' . Route('admin.transfer-receive.destroy', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject">Reject</button>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }
        $inactive_create = true;
        $title = "Receive Products";
        return view('admin.transfer_receive.index', compact('title', 'inactive_create'));
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
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $report_title = 'Receive Chalan';
        $data = Transfer::findOrFail($id);
        // return view('admin.transfer_receive.view', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.transfer_receive.view', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('product_receive_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (request()->ajax()) {
            DB::transaction(function () use ($id) {
                $transfer = Transfer::findOrFail($id);
                $transfer->update([
                    'approve' => 1,
                    'approve_by' => Auth::user()->id,
                ]);
            });
            return response()->json(['status' => 'success']);
        }
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
    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {
            $transfer = Transfer::findOrFail($id);
            $transfer->update([
                'reject' => 1,
                'reject_by' => Auth::user()->id,
            ]);
            $transfer_list = TransferProduct::where('transfer_id', $id)->get(['lifting_product_id', 'qty']);
            foreach ($transfer_list as $key => $transfer_list_item) {
                $lifting_product = LiftingProduct::findOrFail($transfer_list_item->lifting_product_id);
                $transfer_qty = $lifting_product->transfer_qty - $transfer_list_item->qty;
                $lifting_product->update(['transfer_qty' => $transfer_qty]);
            }
            TransferProduct::where('transfer_id', $id)->update(['is_back' => 1]);
        });
        return response()->json(['status' => 'success']);
    }
}
