<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $orders = Order::where("customer_id", $user->id)->with('orderDetails')
            ->get();
        $customer_orders = [];
        $delivered_orders = [];

        foreach ($orders as $order) {
            foreach ($order->orderDetails as $product) {

                if ($order->status == "pending") {
                    $customer_orders[] = [
                        "order_id" => $product->order_id,
                        "product_image" => $product->product->featured_image,
                        "product_title" => $product->product->title,
                        "product_price" => $product->product->price,
                        "qty" => $product->qty,
                        "cost" => $product->product->price * $product->qty,
                    ];
                } else {
                    $delivered_orders[] = [
                        "order_id" => $product->order_id,
                        "product_image" => $product->product->featured_image,
                        "product_title" => $product->product->title,
                        "product_price" => $product->product->price,
                        "qty" => $product->qty,
                        "cost" => $product->product->price * $product->qty,
                    ];
                }
            }
        }

        //Get Delivered Orders

        return view('front_end.profile', compact("user", "customer_orders", "delivered_orders"));
    }

    public function orderDetail($id)
    {
        // $order = Order::findOrFail($id);
        $orders = OrderDetail::where("order_id", $id)->get();
        return view('front_end.order.order_detail', compact('orders'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
