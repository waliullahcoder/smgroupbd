<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::latest('id')->first();
        return view('admin.setting.edit', compact('setting'));
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
            'favicon' => 'image',
            'logo' => 'image',
            'footer_logo' => 'image',
            'placeholder' => 'image',
            'header_banner' => 'image',
            'popup_banner' => 'image',
        ]);

        $setting = Setting::latest('id')->first();
        if (is_null($setting)) {
            $setting = new Setting();
            $favicon_image = NULL;
            $logo_image = NULL;
            $footer_logo_image = NULL;
            $placeholder_image = NULL;
            $meta_image_image = NULL;
            $banner_one_image = NULL;
            $banner_two_image = NULL;
        } else {
            $favicon_image = $setting->favicon;
            $logo_image = $setting->logo;
            $footer_logo_image = $setting->footer_logo;
            $placeholder_image = $setting->placeholder;
            $meta_image_image = $setting->meta_image;
            $banner_one_image = $setting->banner_one;
            $banner_two_image = $setting->banner_two;
        }


        $favicon = $request->file('favicon');
        $logo = $request->file('logo');
        $footer_logo = $request->file('footer_logo');
        $placeholder = $request->file('placeholder');
        $meta_image = $request->file('meta_image');
        $banner_one = $request->file('banner_one');
        $banner_two = $request->file('banner_two');

        if (isset($favicon)) {
            $response = HelperClass::storeImage($favicon, 150, 'media/default/', $setting->favicon);
            if ($response['status'] == 'success') {
                $favicon_image =  $response['path_name'];
            }
        }

        if (isset($logo)) {
            $response = HelperClass::storeImage($logo, 500, 'media/default/', $setting->logo);
            if ($response['status'] == 'success') {
                $logo_image =  $response['path_name'];
            }
        }

        if (isset($footer_logo)) {
            $response = HelperClass::storeImage($footer_logo, 500, 'media/default/', $setting->footer_logo);
            if ($response['status'] == 'success') {
                $footer_logo_image =  $response['path_name'];
            }
        }

        if (isset($placeholder)) {
            $response = HelperClass::storeImage($placeholder, 500, 'media/default/', $setting->placeholder);
            if ($response['status'] == 'success') {
                $placeholder_image =  $response['path_name'];
            }
        }

        if (isset($meta_image)) {
            $response = HelperClass::storeImage($meta_image, 500, 'media/default/', $setting->meta_image);
            if ($response['status'] == 'success') {
                $meta_image_image =  $response['path_name'];
            }
        }

        if (isset($banner_one)) {
            $response = HelperClass::storeImage($banner_one, 500, 'media/home-banner/', $setting->banner_one);
            if ($response['status'] == 'success') {
                $banner_one_image =  $response['path_name'];
            }
        }

        if (isset($banner_two)) {
            $response = HelperClass::storeImage($banner_two, 500, 'media/home-banner/', $setting->banner_two);
            if ($response['status'] == 'success') {
                $banner_two_image =  $response['path_name'];
            }
        }

        $setting->app_name = $request->app_name;
        $setting->title = $request->title;
        $setting->primary_mobile = $request->primary_mobile;
        $setting->secondary_mobile = $request->secondary_mobile;
        $setting->primary_email = $request->primary_email;
        $setting->secondary_email = $request->secondary_email;
        $setting->office_time = $request->office_time;
        $setting->address = $request->address;
        $setting->description = $request->description;
        $setting->meta_title = $request->meta_title;
        $setting->meta_keyword = $request->meta_keyword;
        $setting->meta_description = $request->meta_description;
        $setting->google_map = $request->google_map;
        $setting->facebook_page = $request->facebook_page;
        $setting->facebook_group = $request->facebook_group;
        $setting->youtube = $request->youtube;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->google = $request->google;
        $setting->whatsapp = $request->whatsapp;
        $setting->instagram = $request->instagram;
        $setting->pinterest = $request->pinterest;
        $setting->banner_one_link = $request->banner_one_link;
        $setting->banner_two_link = $request->banner_two_link;
        $setting->meta_image = $meta_image_image;
        $setting->favicon = $favicon_image;
        $setting->logo = $logo_image;
        $setting->footer_logo = $footer_logo_image;
        $setting->placeholder = $placeholder_image;
        $setting->banner_one = $banner_one_image;
        $setting->banner_two = $banner_two_image;
        $setting->save();

        $this->cacheClear();
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
