<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendOrderController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();

        $orders = Order::where('customer_id', $customer->id)
            ->latest()
            ->paginate(10);

        return view('frontend.customer.orders', compact('orders'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

        if (! $customer) {

            return back()->with(
                'error',
                'No orders found for this mobile number.'
            );
        }

        $orders = Order::with('items')
            ->where('customer_id', $customer->id)
            ->latest()
            ->paginate(10);

        return view(
            'frontend.my-orders',
            compact('orders', 'customer')
        );
    }
    /**
     * Show Order Details
     */
    public function show(Order $order)
    {
        $customer = Auth::guard('customer')->user();

        abort_if($order->customer_id != $customer->id, 403);

        return view('frontend.customer.order-details', compact('order'));
    }
    public function invoice(Order $order)
    {
        $customer = Auth::guard('customer')->user();

        abort_if($order->customer_id != $customer->id, 403);

        return redirect()->route('orders.invoice.pdf', $order);
    }
}
