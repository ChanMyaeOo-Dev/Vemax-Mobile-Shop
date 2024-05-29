<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $products = Product::take(10)->get();
        $top_products = Product::take(5)->get();
        $new_orders = OrderDetail::orderBy("id", "desc")->take(5)->get();
        $transactionCount = Product::count();
        $categoryCount = Category::count();
        $categoryBookCount = Category::withCount('products')->pluck('products_count', 'title');
        $transactionCountsInLastSixMonth = [];
        for ($i = 0; $i < 6; $i++) {
            // Get the date for the start of the current month
            $startDate = Carbon::now()->subMonths($i)->startOfMonth();
            // Get the date for the end of the current month
            $endDate = Carbon::now()->subMonths($i)->endOfMonth();

            $transaction = Product::whereBetween('created_at', [$startDate, $endDate])->count();
            $transactionCountsInLastSixMonth[$startDate->format('M')] = $transaction;
        }
        return view('admin.dashboard', compact('products', 'top_products', 'new_orders', 'categoryBookCount', 'transactionCountsInLastSixMonth'));
    }
}
