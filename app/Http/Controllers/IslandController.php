<?php

namespace App\Http\Controllers;

use App\Island;
use App\IslandImage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return view('admin/islands/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $island = new Island();    

        return view('admin/islands/create',[
            'island' => $island
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
            'short_description' => 'required|max:255',
        ]);

        $island = new Island();
        $island->name = $request->get('name');
        $island->short_description = $request->get('short_description');  
        $island->description = $request->get('description');  
        //set default image.
        $island->image = 'default_island.png';
        $island->save();

        return redirect('/islands/'.$island->id.'/edit')->with('global_success', 'New Island added, Add images here!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function show(Island $island)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function edit(Island $island)
    {
        return view('admin/islands/edit',[
            'island' => $island
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Island $island)
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

            $island->image = $file_name;
            $island->update();

            return redirect('/islands/'.$island->id.'/edit')->with('global_success', 'Image Uploaded!');
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

            $island_image = new IslandImage();
            $island_image->name = $file_name;
            $island_image->island_id = $island->id;
            $island_image->save();

            return redirect('/islands/'.$island->id.'/edit')->with('global_success', 'Image Uploaded!');
        }


        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required|max:255',
        ]);

        $island->name = $request->get('name');
        $island->short_description = $request->get('short_description');  
        $island->description = $request->get('description');          
        $island->update();

        return redirect('/islands/'.$island->id.'/edit')->with('global_success', 'Island Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function destroy(Island $island)
    {
        $island->delete();
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
        return Datatables::of(Island::query())->make(true);
    }
}
