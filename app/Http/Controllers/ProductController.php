<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::filter($request)->paginate(5);
        $categories = Category::orderBy('name', 'asc')->get();
        return view('products.index', ['products' => $products, 'categories' => $categories, 'request' => $request]);
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
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if (isset($request->photo)) {
            $path = $request->file('photo')->store('assets/products', 'public');
            $product->update(['photo' => $path]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update(['name' => $request->name, 'description' => $request->description]);
        if (isset($request->photo)) {
            $path = $request->file('photo')->store('assets/products', 'public');
            $old_path = $product->photo;
            $product->update(['photo' => $path]);
            if (Storage::exists('public/' . $old_path)) {
                Storage::delete('public/' . $old_path);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $old_path = $product->photo;
        $product->delete();


        if (Storage::exists('public/' . $old_path)) {
            Storage::delete('public/' . $old_path);
        }

        return redirect()->back();
    }
}
