<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class builderController extends Controller
{
    public function index(Request $request){
        $data = Category::where('type', $request->type)->where('category', $request->category)->get()->pluck('subcategory');
        return response()->json($data);
    }
}
