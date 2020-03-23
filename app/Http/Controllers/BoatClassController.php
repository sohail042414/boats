<?php

namespace App\Http\Controllers;

use App\BoatClass;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BoatClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/boat-classes/list');
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
     * @param  \App\BoatClass  $boatClass
     * @return \Illuminate\Http\Response
     */
    public function show(BoatClass $boatClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoatClass  $boatClass
     * @return \Illuminate\Http\Response
     */
    public function edit(BoatClass $boatClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoatClass  $boatClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoatClass $boatClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoatClass  $boatClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoatClass $boatClass)
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
        return Datatables::of(BoatClass::query())->make(true);
    }
}
