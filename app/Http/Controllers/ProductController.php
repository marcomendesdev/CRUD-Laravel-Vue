<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|string',
            'user_id' => 'required|numeric'
        ]);

        $product = Product::create($validatedData);

        return response(['message' => 'Product created', 'product' => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->save();

        return response()->json(['message' => 'Product updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(['message' => 'Product deleted']);
    }

    /**
     * Display a listing of the resource by user id.
     */
    public function indexByUserId(Product $product, $user_id)
    {
        $product = Product::where('user_id', $user_id)->get();

        return response()->json($product);
    }
}
