<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Menu::orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('status', function ($row) {
                    $status =
                        '<div class="form-check form-switch">
                        <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.menu.edit', $row->id) . '" type="checkbox" name="status"' .
                        ($row->status == 1 ? ' checked' : '') . ($row->position == 'header' || $row->position == 'sidebar' ? ' disabled' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning border-0 px-10px fs-15 link-edit" data-url="' . Route('admin.menu.edit', $row->id) . '"><i class="far fa-pencil-alt"></i></button>
                        <a href="' . Route('admin.menu-item.index', $row->id) . '" class="btn btn-sm btn-primary mw-fit border-0 px-10px fs-15" title="View Items"><i class="fas fa-eye"></i></a>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.menu.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button></div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.menu.index');
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
        $request->validate([
            'name' => 'required|unique:menus,name',
            'position' => 'required',
            'status' => 'required',
        ]);

        $check_header_menu = Menu::where('position', 'header')->count();
        $check_sidebar_menu = Menu::where('position', 'sidebar')->count();
        $check_footer_menu = Menu::where('position', 'footer')->count();
        if ($request->position == 'header' && $check_header_menu > 0) return redirect()->back()->withErrors('Header Menu Already Added!');
        if ($request->position == 'sidebar' && $check_sidebar_menu > 0) return redirect()->back()->withErrors('Sidebar Menu Already Added!');
        if ($request->position == 'footer' && $check_footer_menu > 1) return redirect()->back()->withErrors('Maximum Footer Menu Added!');

        Menu::create([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        $this->cacheClear();
        return redirect()->back()->withSuccessMessage('Created Successfully!');
    }

    private function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
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
            $data = Menu::findOrFail($id);
            $data->update(['status' => !$data->status]);

            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('clear-compiled');
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax()) {
            $data = Menu::findOrFail($id);
            $form_link = route('admin.menu.update', $id);
            return response()->json(['status' => 'success', 'data' => $data, 'form_link' => $form_link]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,' . $id,
            'position' => 'required',
            'status' => 'required',
        ]);

        $menu = Menu::findOrFail($id);

        if ($menu->position == 'footer' && $request->position == 'header') {
            $check_header_menu = Menu::where('position', 'header')->get();
            if (count($check_header_menu) > 0) {
                return redirect()->back()->withErrors('Header Menu Already Added!');
            }
        }
        if ($menu->position == 'header' && $request->position == 'footer') {
            $check_footer_menu = Menu::where('position', 'footer')->get();
            if (count($check_footer_menu) > 3) {
                return redirect()->back()->withErrors('Maximum Footer Menu Added!');
            }
        }

        $menu->update([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        $this->cacheClear();
        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete Multiple Items
        if (request('id')) {
            foreach (request('id') as $id) {
                $menu = Menu::findOrFail($id);
                $menu->delete();
            }

            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('clear-compiled');
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $menu = Menu::findOrFail($id);
        $menu->delete();

        $this->cacheClear();
        return response()->json(['status' => 'success']);
    }
}
