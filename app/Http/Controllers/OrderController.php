<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where("status", "pending")->with(['customer', 'orderDetails'])
            ->get();

        $customer_orders = [];

        foreach ($orders as $order) {
            $id = $order->id;
            $customerName = $order->customer->name;
            $customerProfileImage = $order->customer->profile_image;
            $productCount = $order->orderDetails->count();
            $order_status = $order->status;
            $response = [
                'id' => $id,
                'customer_name' => $customerName,
                'customer_profile_image' => $customerProfileImage,
                'product_count' => $productCount,
                'order_status' => $order_status,
            ];

            $customer_orders[] = $response;
        }

        return view('admin.order.index', compact("customer_orders"));
    }

    public function orderHistory()
    {
        $orders = Order::where("status", "delivered")->with(['customer', 'orderDetails'])
            ->get();

        $customer_orders = [];

        foreach ($orders as $order) {
            $id = $order->id;
            $customerName = $order->customer->name;
            $customerProfileImage = $order->customer->profile_image;
            $productCount = $order->orderDetails->count();
            $order_status = $order->status;
            $response = [
                'id' => $id,
                'customer_name' => $customerName,
                'customer_profile_image' => $customerProfileImage,
                'product_count' => $productCount,
                'order_status' => $order_status,
            ];

            $customer_orders[] = $response;
        }

        return view('admin.order.index', compact("customer_orders"));
    }

    public function create()
    {
        //
    }

    public function store(StoreOrderRequest $request)
    {
        // Upload Order
        $order = new Order();
        $total_amount = $request->total_amount;
        $order->total_amount = $total_amount;
        $order->customer_id = Auth::id();
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
            $order_product = Product::findOrFail($product["product_id"]);
            $orderItem = new OrderDetail();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product["product_id"];
            $orderItem->qty = $product['qty'];
            $orderItem->price = $order_product->price;
            $orderItem->user_id = Auth::id();
            $orderItem->name = $request->name;
            $orderItem->phone = $request->phone;
            $orderItem->address = $request->address;
            $orderItem->save();

            $currentProductStock = $order_product->stock;
            $order_product->stock = $currentProductStock - $product['qty'];
            $order_product->update();
        }

        // Clear Cart
        Cart::where("user_id", Auth::id())->orderBy("id", "desc")->delete();
        $order_id = $order->id;

        return view('front_end.order.receipt', compact("order_id", "orderItem", "orderProducts", "total_amount"));
    }

    public function show(Order $order)
    {
        $products = OrderDetail::where("order_id", "=", $order->id)->get();
        return view('admin.order.show', compact('order', 'products'));
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
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->status = $request->status;
        $order->update();

        return redirect()->back()->with("message", "Status updated.");
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

        // Upload Order
        $order = new Order();
        $total_amount = $request->total_amount;
        $order->total_amount = $total_amount;
        $order->customer_id = Auth::id();
        $order->save();

        // Upload Order Item
        $orderItem = new OrderDetail();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $qty = $request->qty;
        $orderItem->qty = $qty;
        $orderItem->price = $product->price;
        $orderItem->user_id = Auth::id();
        $orderItem->name = $request->name;
        $orderItem->phone = $request->phone;
        $orderItem->address = $request->address;
        $orderItem->save();

        $currentProductStock = $product->stock;
        $product->stock = $currentProductStock - $qty;
        $product->update();

        $order_id = $order->id;

        return view('front_end.order.buy_now_receipt', compact("order_id", "orderItem", "product", "qty", "total_amount"));
    }
}
