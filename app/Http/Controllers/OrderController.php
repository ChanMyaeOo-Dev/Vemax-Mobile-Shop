<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreOrderRequest $request)
    {
        // Upload Customer
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        // Upload Order
        $order = new Order();
        $total_amount = $request->total_amount;
        $order->total_amount = $total_amount;
        $order->customer_id = $customer->id;
        $order->save();

        $userCarts = Cart::where("user_id", Auth::id())->get();
        if (count($userCarts) <= 0) {
            return redirect()->back();
        }
        $allProducts = [];
        $orderProducts = [];

        foreach ($userCarts as $cart) {
            $allProducts[] = ["qty" => $cart->qty, "product_id" => $cart->product->id];
            $orderProducts[] = ["qty" => $cart->qty, "product" => $cart->product];
        }

        foreach ($allProducts as $product) {
            $orderItem = new OrderDetail();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product["product_id"];
            $orderItem->qty = $product['qty'];
            $orderItem->price = Product::findOrFail($product["product_id"])->price;
            $orderItem->save();
        }

        // Clear Cart
        Cart::where("user_id", Auth::id())->orderBy("id", "desc")->delete();

        return view('front_end.order.receipt', compact("customer", "orderProducts", "total_amount"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function buyNowOrderUpload(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required",
            "address" => "required",
        ]);
        $product = Product::findOrFail($request->product_id);
        // Upload Customer
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        // Upload Order
        $order = new Order();
        $total_amount = $request->total_amount;
        $order->total_amount = $total_amount;
        $order->customer_id = $customer->id;
        $order->save();

        // Upload Order Item
        $orderItem = new OrderDetail();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $qty = $request->qty;
        $orderItem->qty = $qty;
        $orderItem->price = $product->price;
        $orderItem->save();

        return view('front_end.order.buy_now_receipt', compact("customer", "product", "qty", "total_amount"));
    }
}
