<?php

namespace App\Http\Controllers;

use App\Itinerary;
use App\Ship;
use App\Tour;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/tours/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ship = new Ship();
        $ships_list = $ship->getList();

        $itinerary = new Itinerary();
        $itineraries_list= $itinerary->getList();

        return view('admin/tours/create',[
            'ships_list' => $ships_list,
            'itineraries_list' => $itineraries_list
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
        $validated_data = $request->validate([
            'ship_id' => 'required',
            'itinerary_id' => 'required',
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'nights' => 'required|numeric',
            'current_gross_rate' => 'required|numeric',
            'original_gross_rate' => 'required|numeric',
            'current_net_rate' => 'required|numeric',
            'original_net_rate' => 'required|numeric',
            'promotion' => 'max:255',
        ]);

        $tour = new Tour();
        $tour->ship_id = $validated_data['ship_id'];
        $tour->itinerary_id = $validated_data['itinerary_id'];  
        $tour->title = $validated_data['title'];  
        $tour->start_date = $validated_data['start_date'];  
        $tour->end_date = $validated_data['end_date'];
        $tour->nights = $validated_data['nights'];
        $tour->current_gross_rate = $request->get('current_gross_rate');
        $tour->original_gross_rate = $request->get('original_gross_rate');
        $tour->current_net_rate = $request->get('current_net_rate');
        $tour->original_net_rate = $request->get('original_net_rate');
        $tour->promotion = $request->get('promotion');
        
        $vailable = $request->get('available');
        $tour->available = ($vailable == 1) ? 1: 0;

        $on_hold = $request->get('on_hold');
        $tour->on_hold = ($on_hold == 1) ? 1: 0;

        $tour->save();

        //$tour->spots()->attach($request->get('spots'));

        return redirect('/tours/'.$tour->id.'/edit')->with('global_success', 'New Itinerary  added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {

        $ship = new Ship();
        $ships_list = $ship->getList();

        $itinerary = new Itinerary();
        $itineraries_list= $itinerary->getList();

        return view('admin/tours/edit',[
            'tour' => $tour,
            'ships_list' => $ships_list,
            'itineraries_list' => $itineraries_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        //
        $validated_data = $request->validate([
            'ship_id' => 'required',
            'itinerary_id' => 'required',
            'title' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'nights' => 'required|numeric',
            'current_gross_rate' => 'required|numeric',
            'original_gross_rate' => 'required|numeric',
            'current_net_rate' => 'required|numeric',
            'original_net_rate' => 'required|numeric',
            'promotion' => 'max:255',
        ]);

        $tour->ship_id = $validated_data['ship_id'];
        $tour->itinerary_id = $validated_data['itinerary_id'];  
        $tour->title = $validated_data['title'];  
        $tour->start_date = $validated_data['start_date'];  
        $tour->end_date = $validated_data['end_date'];
        $tour->nights = $validated_data['nights'];
        $tour->current_gross_rate = $request->get('current_gross_rate');
        $tour->original_gross_rate = $request->get('original_gross_rate');
        $tour->current_net_rate = $request->get('current_net_rate');
        $tour->original_net_rate = $request->get('original_net_rate');
        $tour->promotion = $request->get('promotion');
        
        $vailable = $request->get('available');
        $tour->available = ($vailable == 1) ? 1: 0;

        $on_hold = $request->get('on_hold');
        $tour->on_hold = ($on_hold == 1) ? 1: 0;

        $tour->update();

        //$tour->spots()->attach($request->get('spots'));

        return redirect('/tours/'.$tour->id.'/edit')->with('global_success', 'New Itinerary  added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gridData()
    {
        return Datatables::of(Tour::query())->make(true);
    }
}
