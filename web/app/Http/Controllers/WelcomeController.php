<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            "header" => config("view.title"), 
            "products" => Product::all(), 
        ]);
    }
}
