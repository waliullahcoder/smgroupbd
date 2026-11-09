<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\StaticSiteItem;
use Illuminate\Http\Request;

class SiteItemsController extends Controller
{
    //Display a listing of the resource.
    public function index()
    {
        $data = StaticSiteItem::latest('updated_at')->first();
        return view('admin.site-item.edit', compact('data'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
    }

    //Display the specified resource.
    public function show(string $id)
    {
    }

    //Show the form for editing the specified resource.
    public function edit(string $id)
    {
    }

    //Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'banner_title' => 'required',
            'testimonial_title' => 'required',
            'products_title' => 'required',
        ]);

        $data = StaticSiteItem::latest('updated_at')->first();

        if (is_null($data)) $data = new StaticSiteItem();

        return HelperClass::resourceDataSave(
            $data,
            $request,
            [
                'title',
                'short_description',
                'shop_button_link',
                'contact_button_link',
                'banner_title',
                'testimonial_title',
                'details_video_url',
                'products_title'
            ],
            [
                'banner_image',
                'welcome_image',
                'header_bg_image',
                'y_separator_image',
                'x_separator_image',
                'testimonial_image',
            ],
            'media/site-items/'
        );
    }


    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
    }
}
