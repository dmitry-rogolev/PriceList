<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [ WelcomeController::class, "show" ])
    ->name("welcome");

Route::post("/", [ WelcomeController::class, "store" ])
    ->name("welcome.store");

Route::post("search", [ SearchController::class, "store" ])
    ->name("search.store");

Route::post("product/add", [ ProductController::class, "add" ])
    ->name("product.add");

Route::prefix("product/{product}")->name("product.")->group(function()
{
    Route::post("change", [ ProductController::class, "change" ])
        ->name("change");
        
    Route::post("remove", [ ProductController::class, "remove" ])
        ->name("remove");
});
