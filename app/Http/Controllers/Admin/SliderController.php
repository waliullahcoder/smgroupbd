<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return HelperClass::resourceDataView(Slider::orderBy('id', 'desc'), 'image', NULL, 'slider', 'Slider');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.slider.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        Slider::create([
            'heading' => $request->heading,
            'title' => $request->title,
            'show_btn' => $request->show_btn,
            'image' => isset($request->image) ? HelperClass::saveImage($request->image, 1200, 'media/slider/') : NULL,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.slider.index')->withSuccessMessage('Created Successfully!');
    }

    // Display the specified resource.
    public function show(string $id) {}

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        $title = 'Update Slider';
        $data = Slider::findOrFail($id);
        $link = Route('admin.slider.update', $id);
        return view('admin.slider.edit', compact('title', 'data', 'link'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $data = Slider::findOrFail($id);
        $data->update([
            'heading' => $request->heading,
            'title' => $request->title,
            'show_btn' => $request->show_btn,
            'image' => isset($request->image) ? HelperClass::saveImage($request->image, 1200, 'media/slider/', $data->image) : $data->image,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.slider.index')->withSuccessMessage('Updated Successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, string $id)
    {
        return HelperClass::resourceDataDelete(Slider::class, $id, 'image');
    }
}
