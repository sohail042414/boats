<?php

namespace App\Http\Controllers;

use App\Animal;
use App\AnimalImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/animals/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animal = new Animal();    

        return view('admin/animals/create',[
            'animal_types' => $animal->animalTypes()
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
            'type' => 'required',
            'short_description' => 'required|max:255',
        ]);

        $animal = new Animal();
        $animal->name = $request->get('name');
        $animal->type = $request->get('type');
        $animal->short_description = $request->get('short_description');  
        $animal->description = $request->get('description');  
        
        if($animal->type =='animal'){
            $animal->image = 'default_animal.jpeg';
        }else{
            $animal->image = 'default_bird.png';
        }

        $animal->save();

        return redirect('/animals/'.$animal->id.'/edit')->with('global_success', 'New Animal added, Add images here!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {

        return view('admin/animals/edit',[
            'animal' => $animal,
            'animal_types' => $animal->animalTypes()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {

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

            $animal->image = $file_name;
            $animal->update();

            return redirect('/animals/'.$animal->id.'/edit')->with('global_success', 'Image Uploaded!');
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

            $animal_image = new AnimalImage();
            $animal_image->name = $file_name;
            $animal_image->animal_id = $animal->id;
            $animal_image->save();

            return redirect('/animals/'.$animal->id.'/edit')->with('global_success', 'Image Uploaded!');
        }


        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'short_description' => 'required|max:255',
        ]);

        $animal->name = $request->get('name');
        $animal->type = $request->get('type');
        $animal->short_description = $request->get('short_description');  
        $animal->description = $request->get('description');          
        $animal->update();

        return redirect('/animals/'.$animal->id.'/edit')->with('global_success', 'Animal/Bird Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
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
        return Datatables::of(Animal::query())->make(true);
    }
}
