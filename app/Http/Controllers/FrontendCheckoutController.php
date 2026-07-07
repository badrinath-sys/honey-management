<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendCheckoutController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'customer_name'  => 'required|max:100',

            'phone'          => 'required|max:20',

            'address'        => 'required',

            'payment_method' => 'required',

        ]);

        // Customer must be logged in
        $customer = Auth::guard('customer')->user();

        if (! $customer) {
            return redirect()
                ->route('customer.login')
                ->with('error', 'Please login to place an order.');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart')
                ->with('error', 'Cart is empty.');
        }

        DB::beginTransaction();

        try {

            // Update customer details from checkout
            $customer->update([
                'name'    => $request->customer_name,
                'phone'   => $request->phone,
                'address' => $request->address,
                'city'    => $request->city,
                'state'   => $request->state,
                'pincode' => $request->pincode,
            ]);

            // Grand Total
            $grandTotal = 0;

            foreach ($cart as $item) {
                $grandTotal += $item['price'] * $item['quantity'];
            }

            // Create Order
            // Create Order
            $order = Order::create([

                'customer_id'    => $customer->id,

                'order_date'     => now(),

                'total_amount'   => $grandTotal,

                'payment_method' => $request->payment_method,

                'payment_status' => 'Pending',

                'order_status'   => 'Pending',

            ]);

// Save Items & Update Stock
            // Save Items & Update Stock
            foreach ($cart as $productId => $item) {

                // Product Fetch
                $product = \App\Models\Product::findOrFail($productId);

                // Stock Check
                if ($product->quantity < $item['quantity']) {

                    DB::rollBack();

                    return redirect()
                        ->route('cart')
                        ->with('error', $product->name . ' has insufficient stock.');
                }

                // Save Order Item
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                    'subtotal'   => $item['price'] * $item['quantity'],
                ]);

                // Reduce Stock
                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            // Clear Cart
            session()->forget('cart');

            return redirect()
                ->route('order.success', $order->id)
                ->with('success', 'Order placed successfully.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

    }

    public function success(Order $order)
    {
        $order->load('customer', 'items.product');

        return view('frontend.order-success', compact('order'));
    }
}
