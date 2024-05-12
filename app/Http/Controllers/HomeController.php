<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $get_6_categories = Category::take(6)->get();
        $get_6_products = Product::take(6)->get();
        $get_12_products = Product::take(12)->get();
        $feature_product = Product::latest()->first();

        if (!isset(request()->search)) {
            $products = Product::orderBy("id", "desc")->paginate(12);
            return view('home', compact('products', "feature_product", "categories", "get_6_categories", "get_12_products", "get_6_products"));
        } else {
            $search = request()->search;
            $products = Product::where(function ($query) use ($search) {
                $query->where("name", "like", "%$search%")
                    ->orWhere("description", "like", "%$search%");
            })->paginate(12);
            return view('home', compact('products', 'feature_product', "categories", "get_6_categories", "get_12_products", "get_6_products",   'search'));
        }
    }

    public function shop(Request $request)
    {
        $categories = Category::all();
        $products = Product::latest()->paginate(24);
        return view('shop', compact('products',  "categories"));
    }


    public function search(Request $request)
    {
        $categories = Category::all();

        $search = $request->search;
        $category = $request->category;
        $category_title = "";
        $sortBy = $request->sort_by;

        $query = Product::query();

        if ($search) {
            $query->where('title', 'like', "%$search%");
        }
        // Apply sorting
        if ($sortBy == 'best_match') {
            // Default sorting (latest)
            $query->orderBy('id', 'desc');
        } elseif ($sortBy == 'price_low_to_high') {
            // Sort by price low to high
            $query->orderBy('price', 'asc');
        } elseif ($sortBy == 'price_high_to_low') {
            // Sort by price high to low
            $query->orderBy('price', 'desc');
        }
        // Filter by category
        if ($category) {
            $query->where('category_id', $category);
            $category_title = Category::findOrFail($category)->title;
        }

        $products = $query->paginate(24);
        $products->appends(['search' => $search, 'sort_by' => $sortBy, 'category' => $category]);

        return view('shop', compact('categories', 'category', 'category_title', 'products',  "search", 'sortBy'));
    }

    public function detail($slug)
    {
        $product = Product::where("slug", "=", $slug)->firstOrFail();
        $photos = $product->photos->pluck("image");
        $featured_image = $product->featured_image;
        $photos->prepend($featured_image);
        $related_products = Product::where("category_id", $product->category_id)->take(6)->get();
        return view('front_end.shop.detail', compact('product', 'photos', "related_products"));
    }


    public function buyNow(Request $request, $slug)
    {
        $product = Product::where("slug", "=", $slug)->firstOrFail();
        return view('front_end.carts.buy_now', compact('product'));
    }
}
