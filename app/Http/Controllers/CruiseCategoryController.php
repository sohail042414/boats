<?php

namespace App\Http\Controllers;

use App\CruiseCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CruiseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/cruise-categories/list');
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
        //        //
        $validatedData = $request->validate([
            'boat_class_name' => 'required|max:255',
            'boat_class_description' => 'required|max:255',
        ]);

        $model = new CruiseCategory();
        $model->name = $validatedData['boat_class_name'];
        $model->description = $validatedData['boat_class_description'];
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CruiseCategory  $CruiseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CruiseCategory $cruiseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CruiseCategory  $CruiseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CruiseCategory $cruiseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CruiseCategory  $CruiseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CruiseCategory $cruiseCategory)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        $cruiseCategory->name = $validatedData['name'];
        $cruiseCategory->description = $validatedData['description'];
        $cruiseCategory->update();

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CruiseCategory  $CruiseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CruiseCategory $cruiseCategory)
    {
        $cruiseCategory->delete();

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
        return Datatables::of(CruiseCategory::query())->make(true);
    }
}
