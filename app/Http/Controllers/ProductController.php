<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact("products"));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact("categories"));
    }
    public function store(StoreProductRequest $request)
    {
        // dd($request);
        $product = new Product();
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->discounted_price == null) {
            $product->discounted_price = $request->price;
        } else {
            $product->discounted_price = $request->discounted_price;
        }
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        // Save Feature Image
        $newName = uniqid() . "_" . $request->file("featured_image")->getClientOriginalName();
        $request->file("featured_image")->storeAs('public', $newName);
        $product->featured_image = $newName;
        $product->save();

        foreach ($request->file('images') as $image) {
            $newName = uniqid() . "_" . $image->getClientOriginalName();
            $image->storeAs('public', $newName);
            $photo = new Photo();
            $photo->product_id = $product->id;
            $photo->image = $newName;
            $photo->save();
        }

        return redirect()->route('products.index')->with("message", "Successfully Added new Product.");
    }
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact("categories", "product"));
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        $feature_old_image = $product->featured_image;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->discounted_price == null) {
            $product->discounted_price = $request->price;
        } else {
            $product->discounted_price = $request->discounted_price;
        }
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        if ($request->hasFile('featured_image')) {
            $newName = uniqid() . "_" . $request->file('featured_image')->getClientOriginalName();
            $request->file('featured_image')->storeAs('public', $newName);
            $product->featured_image = $newName;
            if ($feature_old_image != "default_image.svg") {
                Storage::delete("public/" . $feature_old_image);
            }
        } else {
            $product->featured_image = $feature_old_image;
        }
        $product->update();

        if (!is_null($request->file('images'))) {
            foreach ($request->file('images') as $image) {
                $newName = uniqid() . "_" . $image->getClientOriginalName();
                $image->storeAs('public', $newName);
                $photo = new Photo();
                $photo->product_id = $product->id;
                $photo->image = $newName;
                $photo->save();
            }
        }

        return redirect()->route('products.index')->with("message", "Updated successfully.");
    }
    public function destroy(Product $product)
    {
        $isInOrder = OrderDetail::where('product_id', $product->id)->exists();

        if ($isInOrder) {
            return redirect()->route('products.index')->with("message", "You can not delete this product because it has customer order now.");
        }

        if ($product->featured_image != "default_image.svg") {
            Storage::delete("public/" . $product->featured_image);
        }
        foreach ($product->photos as $photo) {
            Storage::delete("public/" . $photo->image_url);
            $photo->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->with("message", "Deleted.");
    }
}
