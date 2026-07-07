<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function profitLoss(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        // Sales
        $sales = Order::query();

        if ($from && $to) {
            $sales->whereBetween('order_date', [$from, $to]);
        }

        $totalSales = $sales->sum('total_amount');

        // Purchases
        $purchases = Purchase::query();

        if ($from && $to) {
            $purchases->whereBetween('purchase_date', [$from, $to]);
        }

        $totalPurchase = $purchases->sum('total_amount');

        // Expenses
        $expenses = Expense::query();

        if ($from && $to) {
            $expenses->whereBetween('expense_date', [$from, $to]);
        }

        $totalExpense = $expenses->sum('amount');

        $grossProfit = $totalSales - $totalPurchase;

        $netProfit = $grossProfit - $totalExpense;

        return view('reports.profit_loss', compact(

            'totalSales',
            'totalPurchase',
            'totalExpense',
            'grossProfit',
            'netProfit',
            'from',
            'to'

        ));
    }
    public function sales()
    {
        $orders = Order::with('customer')
            ->latest()
            ->paginate(10);

        $totalSales  = Order::sum('total_amount');
        $totalOrders = Order::count();

        return view('reports.sales', compact(
            'orders',
            'totalSales',
            'totalOrders'
        ));
    }
}
