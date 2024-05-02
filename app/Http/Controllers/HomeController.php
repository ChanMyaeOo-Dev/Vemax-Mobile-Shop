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
        $search = $request->search;

        $query = Product::query();
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('title', 'like', "%$searchTerm%");
        }
        if ($request->has('sort_by') && $request->input('sort_by') == 'best_match') {
            $query->orderBy('id', "desc");
        }

        if ($request->has('sort_by') && $request->input('sort_by') == 'price_low_to_high') {
            $query->orderBy('price', 'asc');
        }

        if ($request->has('sort_by') && $request->input('sort_by') == 'price_high_to_low') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(24);
        $products->appends(['search' => $request->input('search')]);
        $products->appends(['sort_by' => $request->input('sort_by')]);


        return view('shop', compact('products',  "search"));
    }

    public function detail($slug)
    {
        $product = Product::where("slug", "=", $slug)->firstOrFail();
        $related_products = Product::where("category_id", $product->category_id)->take(6)->get();
        return view('front_end.shop.detail', compact('product', "related_products"));
    }


    public function buyNow(Request $request, $slug)
    {
        $product = Product::where("slug", "=", $slug)->firstOrFail();
        return view('front_end.carts.buy_now', compact('product'));
    }
}
