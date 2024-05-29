<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


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
        // $product = Product::where('stock', '>', 1)->where("slug", "=", $slug)->firstOrFail();
        $photos = $product->photos->pluck("image");
        $featured_image = $product->featured_image;
        $photos->prepend($featured_image);
        return view('admin.products.show', compact('product', 'photos'));
        // return view('admin.products.show', compact('product'));
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
            $order_detail = OrderDetail::where('product_id', $product->id)->firstOrFail();
            $status = $order_detail->order->status;
            if ($status == "pending") {
                return response()->json(['success' => false, 'message' => 'You can not delete this product because it has customer order now.']);
            }
        }
        // Perform the deletion
        if ($product->delete()) {
            return response()->json(['product' => $product, 'success' => true, 'message' => 'Product deleted successfully.']);
        }

        // if ($product->featured_image != "default_image.svg") {
        //     Storage::delete("public/" . $product->featured_image);
        // }
        // foreach ($product->photos as $photo) {
        //     Storage::delete("public/" . $photo->image_url);
        //     $photo->delete();
        // }

        // // Perform the deletion
        // if ($product->delete()) {
        //     return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
        // }

        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    public function getTrash()
    {
        $products = Product::onlyTrashed()->latest()->get();
        return view('admin.products.trash', compact("products"));
    }

    public function restore(Request $request)
    {
        $product = Product::onlyTrashed()
            ->where('id', $request->id)
            ->first();
        $product->restore();
        return redirect()->back()->with("message", "Successfully restored.");
    }

    public function forceDelete(Request $request)
    {
        $product = Product::onlyTrashed()
            ->where('id', $request->id)
            ->first();

        if ($product->featured_image != "default_image.svg") {
            Storage::delete("public/" . $product->featured_image);
        }
        foreach ($product->photos as $photo) {
            Storage::delete("public/" . $photo->image);
            $photo->delete();
        }

        $product->forceDelete();
        return redirect()->back()->with("message", "Successfully deleted.");
    }
}
