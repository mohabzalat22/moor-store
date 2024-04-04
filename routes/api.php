<?php

use App\Http\Controllers\builderController;
use App\Http\Controllers\CategoryController;
use App\Http\Resources\Navbar;
use App\Http\Controllers\PageProducts;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductDataController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('products/{type}/{category?}/{subcategory?}', [PageProducts::class, 'index']);


Route::prefix('admin')->group(function(){
    Route::prefix('dashboard')->group(function(){
        Route::resource('category', CategoryController::class);
        Route::resource('products' , ProductsController::class);
        Route::resource('product/data' , ProductDataController::class);
        Route::get('site/builder', [builderController::class, 'index']);
    });
});

