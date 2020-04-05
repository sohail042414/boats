<?php

namespace App\Http\Controllers;

use App\Spot;
use App\Island;
use App\Animal;
use App\SpotImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // 
       return view('admin/spots/list');
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
        
        $island = new Island();
        $islands_list = $island->getList();   

        $animal = new Animal();
        $animals_list = $animal->getList(); 

        return view('admin/spots/create',[
            'spot' => $spot,
            'islands_list' => $islands_list,
            'animals_list' => $animals_list,
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'island_id' => 'required',
            'short_description' => 'required|max:255',
        ]);

        $spot = new Spot();
        $spot->name = $request->get('name');
        $spot->island_id = $request->get('island_id');
        $spot->short_description = $request->get('short_description');  
        $spot->description = $request->get('description');  
        //set default image.
        $spot->image = 'spot_island.png';
        $spot->save();

        $spot->animals()->attach($request->get('animals'));

        return redirect('/spots/'.$spot->id.'/edit')->with('global_success', 'New Spot(Point)  added, Add images here!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {

      $island = new Island();
      $islands_list = $island->getList();   

      $animal = new Animal();
      $animals_list = $animal->getList(); 

      $spot_animals = [];
      foreach($spot->animals as $record){
          $spot_animals[] = $record->id;
      }

      return view('admin/spots/edit',[
          'spot' => $spot,
          'islands_list' => $islands_list,
          'animals_list' => $animals_list,
          'spot_animals' => $spot_animals
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spot $spot)
    {
        //

        $upload_display_image = $request->upload_display_image;

        if($upload_display_image == 'Upload'){

            request()->validate([
                'display_image' => 'required|image|mimes:jpeg,png,jpg|max:512',
                //'display_image' => 'required|image|mimes:jpeg,png,jpg|max:512|dimensions:min_width=500,min_height=300',
            ]);

            $display_file = $request->file('display_image');
            $destination_path = 'uploads';
            $file_name = time().'_'.$display_file->getClientOriginalName();
            $display_file->move($destination_path,$file_name);

            $spot->image = $file_name;
            $spot->update();

            return redirect('/spots/'.$spot->id.'/edit')->with('global_success', 'Image Uploaded!');
        }

        $upload_additional_image = $request->upload_additional_image;

        if($upload_additional_image == 'Upload'){

            request()->validate([
                'additional_image' => 'required|image|mimes:jpeg,png,jpg|max:512',
                //'additional_image' => 'required|image|mimes:jpeg,png,jpg|max:512|dimensions:min_width=500,min_height=300',
            ]);
            
            $additional_image = $request->file('additional_image');
            $destination_path = 'uploads';
            $file_name = time().'_'.$additional_image->getClientOriginalName();
            $additional_image->move($destination_path,$file_name);

            $spot_image = new SpotImage();
            $spot_image->name = $file_name;
            $spot_image->spot_id = $spot->id;
            $spot_image->save();

            return redirect('/spots/'.$spot->id.'/edit')->with('global_success', 'Image Uploaded!');
        }

        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required|max:255',
        ]);

        $spot->name = $request->get('name');
        $spot->short_description = $request->get('short_description');  
        $spot->description = $request->get('description');          
        $spot->update();

        $spot->animals()->sync($request->get('animals'));

        return redirect('/spots/'.$spot->id.'/edit')->with('global_success', 'Spot(Point) Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        
        $spot->delete();
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
        return Datatables::of(Spot::query())->make(true);
    }
}
