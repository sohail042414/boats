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
            'amenities' => $amenities,
            'electricty_options' => $this->electricty_options(),
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
            'ship_type' => 'required|numeric',
            'cruise_category' => 'required|numeric',
            'capacity_category' => 'required|numeric',
            'price' => 'required|numeric',
            //'capacity' => 'sometimes|numeric',
            'year_built' => 'numeric|nullable',
            'year_renovated' => 'numeric|nullable',
            'top_speed' => 'numeric|nullable',
            'cabins' => 'numeric|nullable',
            'bathrooms' => 'numeric|nullable',
            'tenders' => 'max:100',
            'safety' => 'max:100',
        ]);

        $ship = new Ship();

        $ship->name = $request->get('name'); 
        $ship->ship_link = $request->get('ship_link'); 
        $ship->short_description = $request->get('short_description'); 
        $ship->title_description_1 = $request->get('title_description_1'); 
        $ship->title_description_2 = $request->get('title_description_2'); 
        $ship->title_description_3 = $request->get('title_description_3'); 
        $ship->ship_type = $request->get('ship_type'); 
        $ship->cruise_category = $request->get('cruise_category'); 
        $ship->capacity_category = $request->get('capacity_category'); 
        $ship->price = $request->get('price'); 
        $ship->capacity = (int) $request->get('capacity');  
        $ship->year_built = (int)$request->get('year_built'); 
        $ship->year_renovated = (int) $request->get('year_renovated');
        $ship->length = $request->get('length'); 
        $ship->beam = $request->get('beam'); 
        $ship->draft = $request->get('draft'); 
        $ship->top_speed = $request->get('top_speed');
        $ship->crusing_speed = $request->get('crusing_speed'); 
        $ship->engines = $request->get('engines'); 
        $ship->cabins = (int)$request->get('cabins'); 
        $ship->bathrooms = (int)$request->get('bathrooms'); 
        $ship->electricity = $request->get('electricity');
        $ship->gross_tonnage = $request->get('gross_tonnage');  
        $ship->water_capacity = $request->get('water_capacity');  
        $ship->fuel_capacity = $request->get('fuel_capacity');  
        $ship->fresh_water_maker = $request->get('fresh_water_maker');  
        $ship->tenders = $request->get('tenders');  
        $ship->safety = $request->get('safety');  
        //hard coded 
        $ship->image = 'default_boat.jpg'; 

        //dd($ship);
        $ship->save();

        $ship->amenities()->attach($request->get('amenities'));

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
            'electricty_options' => $this->electricty_options(),
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
                'ship_type' => 'required|numeric',
                'cruise_category' => 'required|numeric',
                'capacity_category' => 'required|numeric',
                'price' => 'required|numeric',
                //'capacity' => 'sometimes|numeric',
                'year_built' => 'numeric|nullable',
                'year_renovated' => 'numeric|nullable',
                'top_speed' => 'numeric|nullable',
                'cabins' => 'numeric|nullable',
                'bathrooms' => 'numeric|nullable',
                'tenders' => 'max:100',
                'safety' => 'max:100',
            ]);
            
            $ship->name = $request->get('name'); 
            $ship->ship_link = $request->get('ship_link'); 
            $ship->short_description = $request->get('short_description'); 
            $ship->title_description_1 = $request->get('title_description_1'); 
            $ship->title_description_2 = $request->get('title_description_2'); 
            $ship->title_description_3 = $request->get('title_description_3'); 
            $ship->ship_type = $request->get('ship_type'); 
            $ship->cruise_category = $request->get('cruise_category'); 
            $ship->capacity_category = $request->get('capacity_category'); 
            $ship->price = $request->get('price'); 
            $ship->capacity = (int) $request->get('capacity');  
            $ship->year_built = (int)$request->get('year_built'); 
            $ship->year_renovated = (int) $request->get('year_renovated');
            $ship->length = $request->get('length'); 
            $ship->beam = $request->get('beam'); 
            $ship->draft = $request->get('draft'); 
            $ship->top_speed = $request->get('top_speed');
            $ship->crusing_speed = $request->get('crusing_speed'); 
            $ship->engines = $request->get('engines'); 
            $ship->cabins = (int)$request->get('cabins'); 
            $ship->bathrooms = (int)$request->get('bathrooms'); 
            $ship->electricity = $request->get('electricity');
            $ship->gross_tonnage = $request->get('gross_tonnage');  
            $ship->water_capacity = $request->get('water_capacity');  
            $ship->fuel_capacity = $request->get('fuel_capacity');  
            $ship->fresh_water_maker = $request->get('fresh_water_maker');  
            $ship->tenders = $request->get('tenders');  
            $ship->safety = $request->get('safety');  
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

    /**
     * 
     */
    private function electricty_options(){
        $options = [
            '110V' => '110V',
            '110V / 220V' => '110V / 220V',
            '120V' => '120V',
        ];

        return $options;
    }
}
