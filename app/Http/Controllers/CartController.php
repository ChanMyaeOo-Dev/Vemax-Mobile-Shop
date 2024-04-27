<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $cartItem = [
            'product_id' => $request->product_id,
            'qty' => $request->quantity,
            'user_id' => Auth::id(),
        ];
        return response()->json($cartItem);
    }

    public function addItem(Request $request)
    {
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        if (is_null($request->qty)) {
            $cart->qty = 1;
        } else {
            $cart->qty = $request->qty;
        }
        $cart->user_id = Auth::id();
        $cart->save();
        $cartNewCount = Cart::count();
        return response()->json(["count" => $cartNewCount]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $newQty = 0;
        if ($request->updateAction == "plus") {
            $newQty = $cart->qty + 1;
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
        return response()->json(["newQty" => $newQty, "totalCost" => $totalCost]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
