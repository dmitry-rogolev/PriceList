<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            "name" => [ "string", "max:255" ], 
            "measure" => [ "string", "max:255" ], 
            "price" => [ "numeric" ], 
            "count" => [ "numeric" ], 
        ]);

        Product::create([
            "name" => $request->name, 
            "measure" => $request->measure, 
            "price" => $request->price, 
            "count" => $request->count, 
        ]);

        return response()->json([
            "products" => Product::all(), 
        ]);
    }

    public function change(Request $request, Product $product)
    {
        $request->validate([
            "name" => [ "string", "max:255" ], 
            "measure" => [ "string", "max:255" ], 
            "price" => [ "numeric" ], 
            "count" => [ "numeric" ], 
        ]);

        if ($request->has("name")) $product->name = $request->name;
        if ($request->has("measure")) $product->measure = $request->measure;
        if ($request->has("price")) $product->price = $request->price;
        if ($request->has("count")) $product->count = $request->count;
        $product->save();

        return response()->json([
            "products" => Product::all(), 
        ]);
    }

    public function remove(Request $request, Product $product)
    {
        $product->delete();

        return response()->json([
            "products" => Product::all(), 
        ]);
    }
}
