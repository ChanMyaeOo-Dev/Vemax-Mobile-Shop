<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
// use Barryvdh\DomPDF\Facade\PDF;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
                    // dd($product->product->featured_image);
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

    public function orderDetail($order_id)
    {
        $total_cost = Order::where('id', $order_id)->firstOrFail()->total_amount;
        $orders = OrderDetail::where("order_id", $order_id)->get();

        $delivery_fee = 2500;
        $all_total_cost = intval($total_cost) + 2500;
        return view('front_end.order.order_detail', compact("order_id", 'orders', 'total_cost', 'all_total_cost'));
    }

    public function generatePDF($id)
    {
        $total_cost = Order::where('id', $id)->firstOrFail()->total_amount;
        $delivery_fee = 2500;
        $all_total = $total_cost + $delivery_fee;
        $orders = OrderDetail::where("order_id", $id)->get();

        $customer_name = $orders[0]->name;
        $customer_phone = $orders[0]->phone;
        $customer_address = $orders[0]->address;

        $data = [
            'orders' => $orders,
            'total_cost' => $total_cost,
            "delivery_fee" => $delivery_fee,
            "all_total" => $all_total,
            "customer_name" => $orders[0]->name,
            "customer_phone" => $orders[0]->phone,
            "customer_address" => $orders[0]->address,
        ];

        $pdf = PDF::loadView('front_end.print', $data);
        return $pdf->download('document222.pdf');
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
        $products = Product::all();
        return response()->json($products);
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
