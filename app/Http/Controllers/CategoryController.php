<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'type' => $request->type,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
        ]);
        if($category){return "Stored Succefully!";}
        return "Error During Storing";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = Category::find($id)->update([
            'type' => $request->type,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
        ]);
        if($status){return "Updated Succefully!";}

        return "Error during Updating";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Category::find($id)->delete();
        if($status){return "Deleted Succesfully!";}
        return "Error during Deleting";
    }
}
