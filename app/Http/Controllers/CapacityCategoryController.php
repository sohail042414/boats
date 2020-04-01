<?php

namespace App\Http\Controllers;

use App\CapacityCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CapacityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/capacity-categories/list');
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
        ]);

        $model = new CapacityCategory();
        $model->name = $validatedData['name'];
        $model->description = $validatedData['description'];
        $model->min = $validatedData['min'];
        $model->max = $validatedData['max'];
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CapacityCategory  $capacityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CapacityCategory $capacityCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CapacityCategory  $capacityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CapacityCategory $capacityCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CapacityCategory  $capacityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CapacityCategory $capacityCategory)
    {
        //
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
        ]);
       
        $capacityCategory->name = $validatedData['name'];
        $capacityCategory->description = $validatedData['description'];
        $capacityCategory->min = $validatedData['min'];
        $capacityCategory->max = $validatedData['max'];
        $capacityCategory->save();

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CapacityCategory  $capacityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CapacityCategory $capacityCategory)
    {
        $capacityCategory->delete();

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
        return Datatables::of(CapacityCategory::query())->make(true);
    }
}
