<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PageProducts extends Controller
{
    public function index($type, $category=null, $subcategory=null){
        if($category != null && $subcategory != null){
            $category_id = Category::where('type', $type)->where('category', $category)->where('subcategory', $subcategory)->first()->id;
            return Product::with('images', 'sizes')->where('category_id', $category_id)->paginate(9);
        }
        else if($category != null){
            $category_id = Category::where('type', $type)->where('category', $category)->first()->id;
            return Product::with('images', 'sizes')->where('category_id', $category_id)->paginate(9);
        }
        else {
            $category_id = Category::where('type', $type)->first()->id;
            return Product::with('images', 'sizes')->where('category_id', $category_id)->paginate(9);
        }
    }
}
