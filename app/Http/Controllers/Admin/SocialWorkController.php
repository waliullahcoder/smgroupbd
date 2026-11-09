<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\SocialWork;
use Illuminate\Http\Request;

class SocialWorkController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        return HelperClass::resourceDataView(SocialWork::query(), ['title', 'serial'], ['image'], 'social-working');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.social-working.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate(['image'=> 'required|image']);

        return HelperClass::resourceDataStore('social_works', $request, ['title', 'serial'], ['image'], 'media/social_works/', 'social-working');
    }

    // Display the specified resource.
    public function show(string $id)
    {
        //
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        return HelperClass::resourceDataEdit('social_works', $id, 'social-working');
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        return HelperClass::resourceDataUpdate('social_works', $id, $request, ['title', 'serial'], ['image'], 'media/social_works/', 'social-working');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, string $id)
    {
        return HelperClass::resourceDataDelete('social_works', $request, $id, ['image']);
    }

}
