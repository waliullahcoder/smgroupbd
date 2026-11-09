<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use Illuminate\Http\Request;

class ClientReviewsController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        return HelperClass::resourceDataView(ClientReview::query(), ['name', 'title', 'company_name', 'ratings'], ['image'], 'client-review');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.client-review.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate(['name'=> 'required', 'ratings'=> 'required', 'reviews_description'=> 'required', 'image'=> 'required|image']);

        return HelperClass::resourceDataStore('client_reviews', $request, ['name', 'title', 'company_name', 'ratings', 'reviews_description'], ['image'], 'media/client_reviews/', 'client-review');
    }

    // Display the specified resource.
    public function show(string $id)
    {
        //
    }

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        return HelperClass::resourceDataEdit('client_reviews', $id, 'client-review');
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate(['name'=> 'required', 'ratings'=> 'required', 'reviews_description'=> 'required']);

        return HelperClass::resourceDataUpdate('client_reviews', $id, $request, ['name', 'title', 'company_name', 'ratings', 'reviews_description'], ['image'], 'media/client_reviews/', 'client-review');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, string $id)
    {
        return HelperClass::resourceDataDelete('client_reviews', $request, $id, ['image']);
    }

}
