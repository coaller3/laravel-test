<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $name = $request->name != "" ? $request->name : "";

        $products = Product::query();

        if($name != ''){
            $products = $products->where('name', 'like', '%'.$name.'%');
        }

        $products = $products->orderByDesc('id')->get();

        return view('product.listing', [
            'datas' => $products,
            'name'=> $name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'required|string',
            'publish' => 'required|boolean',
        ]);

        $product_data = [
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'publish' => $request->publish,
        ];
        
        $product = Product::create($product_data);
        
        return response()->json(['status'=>"success"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view("product.show", ["product"=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view("product.edit", ["product"=> $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'required|string',
            'publish' => 'required|boolean',
        ]);

        $product_data = [
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'publish' => $request->publish,
        ];
        
        $product->fill($product_data);
        $product->save();
        
        return response()->json(['status'=>"success"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return response()->json(['status'=>"success"], 200);
    }
}
