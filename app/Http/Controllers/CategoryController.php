<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);

        $newName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $newName);

        $category->image = $newName;
        $category->save();

        return redirect()->route("categories.index")->with("message", "New Category Added Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact("category"));
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $old_image = $category->image;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);

        if ($request->hasFile("image")) {
            $newName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $newName);
            Storage::delete("public/" . $old_image);
            $category->image = $newName;
        } else {
            $category->image = $old_image;
        }

        $category->update();

        return redirect()->route("categories.index")->with("message", "Updated.");
    }
    public function destroy(Category $category)
    {
        if ($category->cover_image != "default_image.svg") {
            Storage::delete("public/" . $category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with("message", "Deleted.");
    }
}
