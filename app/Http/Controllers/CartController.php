<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where("user_id", Auth::id())->orderBy("id", "desc")->get();
        $totalCost = 0;

        foreach ($carts as $cart) {
            $totalCost += $cart->product->price * $cart->qty;
        }


        return view('front_end.carts.index', compact("carts", "totalCost"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cartNewCount = Cart::count();

        $productId = $request->product_id;
        $cartQuery = Cart::where('product_id', $productId)
            ->where('user_id', Auth::id());

        if ($cartQuery->exists()) {
            $cart = $cartQuery->firstOrFail();
            $currentQty = $cart->qty;
            if ($cart->product->stock > $cart->qty) {
                $cart->qty = $currentQty + 1;
                $cart->update();
                return response()->json(["count" => $cartNewCount, "message" => "New Cart Added."]);
            } else {
                return response()->json(["count" => $cartNewCount, "message" => "Cart Already Exist."]);
            }
        } else {
            $cart = new Cart();
            $cart->product_id = $request->product_id;
            if (is_null($request->qty)) {
                $cart->qty = 1;
            } else {
                $cart->qty = $request->qty;
            }
            $cart->user_id = Auth::id();
            $cart->save();
        }
        $cartNewCount = Cart::count();
        return response()->json(["count" => $cartNewCount, "message" => "New Cart Added."]);
    }

    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $newQty = 0;
        if ($request->updateAction == "plus") {

            if ($cart->product->stock > $cart->qty) {
                $newQty = $cart->qty + 1;
            } else {
                $newQty = $cart->qty;
                $carts = Cart::where("user_id", Auth::id())->orderBy("id", "desc")->get();
                $totalCost = 0;
                foreach ($carts as $cart) {
                    $totalCost += $cart->product->price * $cart->qty;
                }
                return response()->json(["newQty" => $newQty, "totalCost" => $totalCost, "message" => "You are at the maximum quantity."]);
            }
        } else {
            if ($cart->qty > 1) {
                $newQty = $cart->qty - 1;
            } else {
                $cart->delete();
                return response()->json(["newQty" => $newQty]);
            }
        }

        $cart->qty = $newQty;
        $cart->update();

        $carts = Cart::where("user_id", Auth::id())->orderBy("id", "desc")->get();
        $totalCost = 0;
        foreach ($carts as $cart) {
            $totalCost += $cart->product->price * $cart->qty;
        }

        return response()->json(["newQty" => $newQty, "totalCost" => $totalCost, "message" => "Updated"]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with("message", "Deleted.");
    }
}
