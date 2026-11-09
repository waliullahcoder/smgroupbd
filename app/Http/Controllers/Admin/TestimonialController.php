<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        return HelperClass::resourceDataView(Testimonial::query(), ['name', 'title', 'company_name', 'ratings'], ['thumbnail'], 'testimonial');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.testimonial.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate(['title'=> 'required', 'serial'=> 'required', 'short_description'=> 'required', 'thumbnail'=> 'required|image']);

        return HelperClass::resourceDataStore('testimonials', $request, ['title', 'serial', 'short_description', 'slug'], ['thumbnail'], 'media/testimonials/', 'testimonial');
    }

    // Display the specified resource.
    public function show(string $id)
    {
        //
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        return HelperClass::resourceDataEdit('testimonials', $id, 'testimonial');
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate(['title'=> 'required', 'serial'=> 'required', 'short_description'=> 'required']);

        return HelperClass::resourceDataUpdate('testimonials', $id, $request, ['title', 'serial', 'short_description', 'slug'], ['thumbnail'], 'media/testimonials/', 'testimonial');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, string $id)
    {
        return HelperClass::resourceDataDelete('testimonials', $request, $id, ['image']);
    }

}
