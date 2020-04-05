<?php

namespace App\Http\Controllers;

use App\SpotImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SpotImageController extends Controller
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
     * @param  \App\SpotImage  $spotImage
     * @return \Illuminate\Http\Response
     */
    public function show(SpotImage $spotImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpotImage  $spotImage
     * @return \Illuminate\Http\Response
     */
    public function edit(SpotImage $spotImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpotImage  $spotImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpotImage $spotImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpotImage  $spotImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpotImage $spotImage)
    {
        $spotImage->delete();

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
        return Datatables::of(SpotImage::query())
        ->filter(function ($query) use ($request) {
            $spot_id = $request->get('spot_id');
            $query->where('spot_id', '=', $spot_id);            
        })->make(true);

    }
}
