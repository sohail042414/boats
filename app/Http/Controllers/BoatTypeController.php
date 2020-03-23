<?php

namespace App\Http\Controllers;

use App\BoatType;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BoatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/boat-types/list');
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
     * @param  \App\BoatType  $boatType
     * @return \Illuminate\Http\Response
     */
    public function show(BoatType $boatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoatType  $boatType
     * @return \Illuminate\Http\Response
     */
    public function edit(BoatType $boatType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoatType  $boatType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoatType $boatType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoatType  $boatType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoatType $boatType)
    {
        //
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(BoatType::query())->make(true);
    }
}
