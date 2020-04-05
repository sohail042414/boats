<?php

namespace App\Http\Controllers;

use App\IslandImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class IslandImageController extends Controller
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
     * @param  \App\IslandImage  $islandImage
     * @return \Illuminate\Http\Response
     */
    public function show(IslandImage $islandImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IslandImage  $islandImage
     * @return \Illuminate\Http\Response
     */
    public function edit(IslandImage $islandImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IslandImage  $islandImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IslandImage $islandImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IslandImage  $islandImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(IslandImage $islandImage)
    {
        
        $islandImage->delete();

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
        return Datatables::of(IslandImage::query())
        ->filter(function ($query) use ($request) {
            $island_id = $request->get('island_id');
            $query->where('island_id', '=', $island_id);            
        })->make(true);

    }
}
