<?php

namespace App\Http\Controllers;

use App\AnimalImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AnimalImageController extends Controller
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
     * @param  \App\AnimalImage  $animalImage
     * @return \Illuminate\Http\Response
     */
    public function show(AnimalImage $animalImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnimalImage  $animalImage
     * @return \Illuminate\Http\Response
     */
    public function edit(AnimalImage $animalImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnimalImage  $animalImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnimalImage $animalImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnimalImage  $animalImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalImage $animalImage)
    {
        
        $animalImage->delete();

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
        return Datatables::of(AnimalImage::query())
        ->filter(function ($query) use ($request) {
            $animal_id = $request->get('animal_id');
            $query->where('animal_id', '=', $animal_id);            
        })->make(true);

    }
}
