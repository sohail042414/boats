<?php

namespace App\Http\Controllers;

use App\ShipType;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ShipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/ship-types/list');
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
            'boat_type_name' => 'required|max:255',
            'boat_type_description' => 'required|max:255',
        ]);

        $model = new ShipType();
        $model->name = $validatedData['boat_type_name'];
        $model->description = $validatedData['boat_type_description'];
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShipType  $shipType
     * @return \Illuminate\Http\Response
     */
    public function show(ShipType $shipType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShipType  $shipType
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipType $shipType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShipType  $shipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipType $shipType)
    {
               //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        $shipType->name = $validatedData['name'];
        $shipType->description = $validatedData['description'];
        $shipType->update();

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShipType  $shipType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipType $shipType)
    {
        $shipType->delete();

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
        return Datatables::of(ShipType::query())->make(true);
    }
}
