<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with('images','sizes')->get();
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
        $status = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'description' => $request->description,
            'shipping_info' => $request->shipping_info,
            'currency_type' => $request->currency_type,
            'price' => $request->price,
            'discount' => $request->discount / 100,
        ]);
        if($status){return "Product Saved Successfully!";}
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
        $status = Product::find($id)->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'description' => $request->description,
            'shipping_info' => $request->shipping_info,
            'currency_type' => $request->currency_type,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);
        if($status){ return "Product Upadted Succeffully!";}
        return "Error During Updating";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Product::find($id)->delete();
        if($status){return "Deleted Succeffully!";}
        return "Error During Deleting";
    }
}
