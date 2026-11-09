<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Artisan;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AdminSetting::first();
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.admin_setting.edit', compact('data', 'stores'));
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
        $request->validate([
            'logo' => 'image',
            'favicon' => 'image',
            'title' => 'required',
            'footer_text' => 'required',
        ]);

        $data = AdminSetting::latest('id')->first();
        if (is_null($data)) {
            $data = new AdminSetting();
        }
        $data->title = $request->title;
        $data->footer_text = $request->footer_text;
        $data->template_status = $request->template_status;

        $data->body_bg = $request->body_bg;
        $data->card_bg = $request->card_bg;
        $data->title_bg = $request->title_bg;

        $data->primary_color = $request->primary_color;
        $data->secondary_color = $request->secondary_color;

        $data->primary_bg = $request->primary_bg;
        $data->secondary_bg = $request->secondary_bg;

        $data->text1_color = $request->text1_color;
        $data->text2_color = $request->text2_color;
        
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->whatsapp = $request->whatsapp;
        $data->google = $request->google;
        $data->store_id = $request->store_id;
        $data->accounting = $request->accounting;
        $data->invest_value = $request->invest_value;
        $data->logo = isset($request->logo) ? HelperClass::saveImage($request->logo, 300, 'media/admin-setting/', @$data->logo) : @$data->logo;
        $data->favicon = isset($request->favicon) ? HelperClass::saveImage($request->favicon, 150, 'media/admin-setting/', @$data->favicon) : @$data->favicon;
        $data->save();

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');

        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
