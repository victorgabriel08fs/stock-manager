<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories.index', ['categories' => $categories]);
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
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        if (isset($request->icon)) {
            $path = $request->file('icon')->store('assets', 'public');
            $category->update(['icon' => $path]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update(['name' => $request->name, 'description' => $request->description]);
        if (isset($request->icon)) {
            $path = $request->file('icon')->store('assets', 'public');
            $old_path = $category->icon;
            $category->update(['icon' => $path]);
            if (Storage::exists('public/' . $old_path) && !str_contains($old_path, "doar.png")) {
                Storage::delete('public/' . $old_path);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $old_path = $category->icon;
        $category->delete();

        if (Storage::exists('public/' . $old_path) && !str_contains($old_path, "doar.png")) {
            Storage::delete('public/' . $old_path);
        }

        return redirect()->back();
    }
}
