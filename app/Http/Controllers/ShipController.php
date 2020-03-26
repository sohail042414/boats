<?php

namespace App\Http\Controllers;

use App\Ship;
use App\ShipType;
use App\CruiseCategory;
use App\CapacityCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/ships/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $ship_types = ShipType::all();
        $cruise_cats = CruiseCategory::all();
        $capacity_cats = CapacityCategory::all();

        //dd($capacity_cats);

        return view('admin/ships/create',[
            'ship_types' => $ship_types,
            'cruise_cats'=> $cruise_cats,
            'capacity_cats'=> $capacity_cats,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ship_link' => 'required|max:255',
            'short_description' => 'required|max:255|min:20',
            'title_description_1' => 'required|min:20',
            'title_description_2' => 'required|min:20',
            'title_description_3' => 'required|min:20',
            'ship_type' => 'required|numeric',
            'cruise_category' => 'required|numeric',
            'capacity_category' => 'required|numeric',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
            'year_built' => 'required|numeric',
            'year_renovated' => 'required|numeric',
            'length' => 'required|numeric',
            'beam' => 'required|numeric',
            'top_speed' => 'required|numeric',
            'engines' => 'required|numeric',
            'cabins' => 'required|numeric',
            'draft' => 'required|numeric',
            'gross_tonnage' => 'required',
            'electricity' => 'required',
        ]);

        $model = new Ship();

        $model->name = $validatedData['name']; 
        $model->ship_link = $validatedData['ship_link']; 
        $model->short_description = $validatedData['short_description']; 
        $model->title_description_1 = $validatedData['title_description_1']; 
        $model->title_description_2 = $validatedData['title_description_2']; 
        $model->title_description_3 = $validatedData['title_description_3']; 
        $model->ship_type = $validatedData['ship_type']; 
        $model->cruise_category = $validatedData['cruise_category']; 
        $model->capacity_category = $validatedData['capacity_category']; 
        $model->price = $validatedData['price']; 
        $model->capacity = $validatedData['capacity']; 
        $model->year_renovated = $validatedData['year_renovated']; 
        $model->year_built = $validatedData['year_built']; 
        $model->length = $validatedData['length']; 
        $model->beam = $validatedData['beam']; 
        $model->top_speed = $validatedData['top_speed']; 
        $model->engines = $validatedData['engines']; 
        $model->cabins = $validatedData['cabins']; 
        $model->draft = $validatedData['draft']; 
        $model->gross_tonnage = $validatedData['gross_tonnage']; 
        $model->electricity = $validatedData['electricity']; 
            
        //hard coded 
        $model->image = 'default_boat.jpg'; 

        $model->save();

        return redirect('/ships')->with('global_success', 'New Ship Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //

        $ship_types = ShipType::all();
        $cruise_cats = CruiseCategory::all();
        $capacity_cats = CapacityCategory::all();

        //dd($capacity_cats);

        return view('admin/ships/edit',[
            'ship' => $ship,
            'ship_types' => $ship_types,
            'cruise_cats'=> $cruise_cats,
            'capacity_cats'=> $capacity_cats,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
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
        //return Datatables::of(Ship::query())->make(true);
        //$ships = Ship::with('type')->with('class')->select('Ships.*');
        $ships = Ship::with('shipType')->with('cruiseCategory')->select('ships.*');

        return Datatables::of($ships)->make(true);

    }
}
