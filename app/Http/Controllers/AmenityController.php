<?php

namespace App\Http\Controllers;

use App\Amenity;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin/amenities/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'amenity_name' => 'required|max:255',
        ]);

        $model = new Amenity();
        $model->name = $validatedData['amenity_name'];
        $model->save();

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenity $amenity)
    {
        //
        $validatedData = $request->validate([
            'amenity_name' => 'required|max:255',
        ]);
        
        $amenity->name = $validatedData['amenity_name'];
        $amenity->update();

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        
        $amenity->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Amenity::query())->make(true);
    }
}
