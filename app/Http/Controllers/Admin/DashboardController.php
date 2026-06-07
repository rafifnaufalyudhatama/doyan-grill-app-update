<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Key Statistics
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();

        // Chart Data (Monthly Sales for Current Year)
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Format data for Chart.js (12 months)
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = isset($monthlySales[$i]) ? $monthlySales[$i] : 0;
        }

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalProducts', 'totalCustomers', 'chartData'));
    }
}
