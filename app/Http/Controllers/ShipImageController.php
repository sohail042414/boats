<?php

namespace App\Http\Controllers;

use App\ShipImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ShipImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShipImage  $shipImage
     * @return \Illuminate\Http\Response
     */
    public function show(ShipImage $shipImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShipImage  $shipImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipImage $shipImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShipImage  $shipImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipImage $shipImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShipImage  $shipImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipImage $shipImage)
    {

        $shipImage->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gridData(Request $request)
    {
        return Datatables::of(ShipImage::query())
        ->filter(function ($query) use ($request) {
            $ship_id = $request->get('ship_id');
            $query->where('ship_id', '=', $ship_id);            
        })->make(true);

    }
}
