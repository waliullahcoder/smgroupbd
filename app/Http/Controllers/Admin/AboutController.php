<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //Display a listing of the resource.
    public function index()
    {
        $data = About::latest('updated_at')->first();
        return view('admin.about.edit', compact('data'));
    }

    //Show the form for creating a new resource.
    public function create() {}

    //Store a newly created resource in storage.
    public function store(Request $request) {}

    //Display the specified resource.
    public function show(string $id) {}

    //Show the form for editing the specified resource.
    public function edit(string $id) {}

    //Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'faq_title' => 'required',
            'white_faq_name' => 'required',
            'black_faq_name' => 'required',
            'white_faq_description' => 'required',
            'black_faq_description' => 'required',
            'social_work_heading' => 'required',
            'social_work_title' => 'required',
            'social_work_description' => 'required',
        ]);

        $data = About::first();
        if (is_null($data)) $data = new About();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->faq_title = $request->faq_title;
        $data->white_faq_name = $request->white_faq_name;
        $data->black_faq_name = $request->black_faq_name;
        $data->white_faq_description = $request->white_faq_description;
        $data->black_faq_description = $request->black_faq_description;
        $data->social_work_heading = $request->social_work_heading;
        $data->social_work_title = $request->social_work_title;
        $data->social_work_description = $request->social_work_description;
        $data->link = $request->link;
        $data->save();
        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }


    // Remove the specified resource from storage.
    public function destroy(string $id) {}
}
