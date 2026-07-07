<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalCustomers = Customer::count();

        $totalSuppliers = Supplier::count();

        $totalOrders = Order::count();

        $totalRevenue = Order::sum('total_amount');

        $recentOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::where('quantity', '<=', 10)
            ->orderBy('quantity')
            ->get();

        $monthlySales = [];

        for ($i = 1; $i <= 12; $i++) {

            $monthlySales[] = Order::whereMonth('order_date', $i)
                ->sum('total_amount');

        }

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'totalSuppliers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts',
            'monthlySales'
        ));
    }
}
