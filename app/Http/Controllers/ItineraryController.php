<?php

namespace App\Http\Controllers;

use App\Itinerary;
use App\Spot;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/itineraries/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        

        $spot = new Spot();
        $spots_list = $spot->getList();   

        return view('admin/itineraries/create',[
            'spots_list' => $spots_list
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
        $validated_data = $request->validate([
            'code' => 'required|max:10',
            'title' => 'required|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $itinerary = new Itinerary();
        $itinerary->ship_id = $request->get('ship_id');
        $itinerary->code = $validated_data['code'];
        $itinerary->title = $validated_data['title'];  
        $itinerary->start_date = $validated_data['start_date'];  
        $itinerary->end_date = $validated_data['end_date'];
        $itinerary->save();

        $itinerary->spots()->attach($request->get('spots'));

        return redirect()->back()->with([
            'global_success' => 'New Itinerary  added!',
            'tab' => 'itineraries'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(Itinerary $itinerary)
    {
        $spot = new Spot();
        $spots_list = $spot->getList();   

        $itinerary_spots = [];

        $itinerary_spots = [];
        foreach($itinerary->spots as $record){
            $itinerary_spots[] = $record->id;
        }

        return view('admin/itineraries/edit',[
            'itinerary' => $itinerary,
            'spots_list' => $spots_list,
            'itinerary_spots' => $itinerary_spots,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itinerary $itinerary)
    {

        $validated_data = $request->validate([
            'code' => 'required|max:10',
            'title' => 'required|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        $itinerary->code = $validated_data['code'];
        $itinerary->title = $validated_data['title'];  
        $itinerary->start_date = $validated_data['start_date'];  
        $itinerary->end_date = $validated_data['end_date'];

        $itinerary->update();

        $itinerary->spots()->sync($request->get('spots'));

        return redirect('/itineraries/'.$itinerary->id.'/edit')->with('global_success', 'New Itinerary  added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itinerary $itinerary)
    {
        $itinerary->delete();
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
        //return Datatables::of(Itinerary::query())->make(true);

        return Datatables::of(Itinerary::query())
        ->filter(function ($query) use ($request) {
            $ship_id = $request->get('ship_id');
            $query->where('ship_id', '=', $ship_id);            
        })->make(true);
    }
}
