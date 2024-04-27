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
}
