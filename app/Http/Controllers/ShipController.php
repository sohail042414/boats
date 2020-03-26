<?php

namespace App\Http\Controllers;

use App\Ship;
use App\ShipType;
use App\Amenity;
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
        $amenities = Amenity::all();
        $ship_types = ShipType::all();
        $cruise_cats = CruiseCategory::all();
        $capacity_cats = CapacityCategory::all();

        return view('admin/ships/create',[
            'ship_types' => $ship_types,
            'cruise_cats'=> $cruise_cats,
            'capacity_cats'=> $capacity_cats,
            'amenities' => $amenities
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

        $ship = new Ship();

        $ship->name = $validatedData['name']; 
        $ship->ship_link = $validatedData['ship_link']; 
        $ship->short_description = $validatedData['short_description']; 
        $ship->title_description_1 = $validatedData['title_description_1']; 
        $ship->title_description_2 = $validatedData['title_description_2']; 
        $ship->title_description_3 = $validatedData['title_description_3']; 
        $ship->ship_type = $validatedData['ship_type']; 
        $ship->cruise_category = $validatedData['cruise_category']; 
        $ship->capacity_category = $validatedData['capacity_category']; 
        $ship->price = $validatedData['price']; 
        $ship->capacity = $validatedData['capacity']; 
        $ship->year_renovated = $validatedData['year_renovated']; 
        $ship->year_built = $validatedData['year_built']; 
        $ship->length = $validatedData['length']; 
        $ship->beam = $validatedData['beam']; 
        $ship->top_speed = $validatedData['top_speed']; 
        $ship->engines = $validatedData['engines']; 
        $ship->cabins = $validatedData['cabins']; 
        $ship->draft = $validatedData['draft']; 
        $ship->gross_tonnage = $validatedData['gross_tonnage']; 
        $ship->electricity = $validatedData['electricity']; 

        //hard coded 
        $ship->image = 'default_boat.jpg'; 
        $ship->save();


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
        $amenities = Amenity::all();
        $ship_types = ShipType::all();
        $cruise_cats = CruiseCategory::all();
        $capacity_cats = CapacityCategory::all();

        $ship_amenities = array();
        foreach($ship->amenities as $record){
            $ship_amenities[] = $record->id;
        }

        return view('admin/ships/edit',[
            'ship' => $ship,
            'ship_amenities' => $ship_amenities,
            'amenities' => $amenities,
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
    
            $ship->name = $validatedData['name']; 
            $ship->ship_link = $validatedData['ship_link']; 
            $ship->short_description = $validatedData['short_description']; 
            $ship->title_description_1 = $validatedData['title_description_1']; 
            $ship->title_description_2 = $validatedData['title_description_2']; 
            $ship->title_description_3 = $validatedData['title_description_3']; 
            $ship->ship_type = $validatedData['ship_type']; 
            $ship->cruise_category = $validatedData['cruise_category']; 
            $ship->capacity_category = $validatedData['capacity_category']; 
            $ship->price = $validatedData['price']; 
            $ship->capacity = $validatedData['capacity']; 
            $ship->year_renovated = $validatedData['year_renovated']; 
            $ship->year_built = $validatedData['year_built']; 
            $ship->length = $validatedData['length']; 
            $ship->beam = $validatedData['beam']; 
            $ship->top_speed = $validatedData['top_speed']; 
            $ship->engines = $validatedData['engines']; 
            $ship->cabins = $validatedData['cabins']; 
            $ship->draft = $validatedData['draft']; 
            $ship->gross_tonnage = $validatedData['gross_tonnage']; 
            $ship->electricity = $validatedData['electricity']; 
    
            //hard coded 
            $ship->image = 'default_boat.jpg'; 
            $ship->save();

            $ship->amenities()->sync($request->get('amenities'));

            return redirect('/ships')->with('global_success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {

        $ship->amenities()->detach();
        $ship->delete();

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
        //return Datatables::of(Ship::query())->make(true);
        //$ships = Ship::with('type')->with('class')->select('Ships.*');
        $ships = Ship::with('shipType')->with('cruiseCategory')->select('ships.*');

        return Datatables::of($ships)->make(true);

    }
}
