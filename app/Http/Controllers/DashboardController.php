<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $products = Product::take(10)->get();

        $topFiveProducts = Product::withSum('orderDetails', 'qty')
            ->orderBy('order_details_sum_qty', 'desc')
            ->limit(5)
            ->get();

        $totalOrders = OrderDetail::sum('qty');
        $totalIncome = Order::sum('total_amount');
        $customerCount = Order::distinct('customer_id')->count('customer_id');
        $totalUser = User::count();

        $new_orders = OrderDetail::orderBy("id", "desc")->take(5)->get();

        $transactionCount = Product::count();
        $categoryCount = Category::count();

        $orderCountsInLastSixMonth = [];

        for ($i = 0; $i < 6; $i++) {
            // Get the date for the start of the current month
            $startDate = Carbon::now()->subMonths($i)->startOfMonth();
            // Get the date for the end of the current month
            $endDate = Carbon::now()->subMonths($i)->endOfMonth();

            $transaction = OrderDetail::whereBetween('created_at', [$startDate, $endDate])->count();
            $orderCountsInLastSixMonth[$startDate->format('M')] = $transaction;
        }
        return view('admin.dashboard', compact('totalOrders', 'totalIncome', 'customerCount', 'totalUser', 'products', 'topFiveProducts', 'new_orders',  'orderCountsInLastSixMonth'));
    }
}
