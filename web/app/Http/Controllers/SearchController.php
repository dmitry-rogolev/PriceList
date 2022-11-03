<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            "products" => $request->q ? Product::search($request->q)->get()->toJson() : Product::all()->toJson(), 
        ]);
    }
}
