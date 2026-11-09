<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\DetailsCard;
use Illuminate\Http\Request;

class DetailsCardController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return HelperClass::resourceDataView(DetailsCard::query(), ['title', 'serial'], null, 'details-card');
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.details-card.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate(['title'=> 'required', 'serial'=> 'required', 'description'=> 'required']);

        return HelperClass::resourceDataStore('details_cards', $request, ['title', 'description', 'serial'], null, null, 'details-card');
    }

    // Display the specified resource.
    public function show(string $id){}

    // Show the form for editing the specified resource.
    public function edit(string $id)
    {
        return HelperClass::resourceDataEdit('details_cards', $id, 'details-card');
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id)
    {
        $request->validate(['title'=> 'required', 'serial'=> 'required','description'=> 'required']);

        return HelperClass::resourceDataUpdate('details_cards', $id, $request, ['title', 'description', 'serial'], null, null, 'details-card');
    }

    // Remove the specified resource from storage.
    public function destroy(Request $request, string $id)
    {
        return HelperClass::resourceDataDelete('details_cards', $request, $id, null);
    }
}
