<?php
namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'    => 'required|exists:customers,id',
            'order_date'     => 'required|date',
            'payment_status' => 'required',
            'order_status'   => 'required',
        ]);

        $order = Order::create([
            'customer_id'    => $request->customer_id,
            'order_date'     => $request->order_date,
            'payment_status' => $request->payment_status,
            'order_status'   => $request->order_status,
            'total_amount'   => 0,
        ]);

        return redirect()
            ->route('orders.edit', $order->id)
            ->with('success', 'Order Created Successfully. Now Add Products.');
    }

    public function show(Order $order)
    {
        $order->load('customer', 'items.product');

        return view('orders.show', compact('order'));
    }
    public function export()
    {
        return Excel::download(
            new OrdersExport,
            'orders.xlsx'
        );
    }

    public function edit(Order $order)
    {
        $customers = Customer::where('status', 1)->get();

        $products = Product::where('status', 1)
            ->orderBy('name')
            ->get();

        $order->load('customer', 'items.product');

        return view('orders.edit', compact(
            'order',
            'customers',
            'products'
        ));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id'    => 'required|exists:customers,id',
            'order_date'     => 'required|date',
            'payment_status' => 'required',
            'order_status'   => 'required',
        ]);

        $order->update([
            'customer_id'    => $request->customer_id,
            'order_date'     => $request->order_date,
            'payment_status' => $request->payment_status,
            'order_status'   => $request->order_status,
        ]);

        return back()->with('success', 'Order Updated Successfully');
    }

    public function destroy(Order $order)
    {
        foreach ($order->items as $item) {

            $item->product->increment('quantity', $item->quantity);

            $item->delete();
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order Deleted Successfully');
    }

    public function addItem(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->quantity < $request->quantity) {

            return back()->withErrors([
                'quantity' => 'Insufficient Stock',
            ]);
        }

        $existing = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {

            $existing->quantity += $request->quantity;

            $existing->subtotal = $existing->quantity * $existing->price;

            $existing->save();

        } else {

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
                'subtotal'   => $product->price * $request->quantity,
            ]);
        }

        $product->decrement('quantity', $request->quantity);

        $order->update([
            'total_amount' => $order->items()->sum('subtotal'),
        ]);

        return back()->with('success', 'Product Added Successfully');
    }

    public function removeItem(OrderItem $item)
    {
        $item->product->increment('quantity', $item->quantity);

        $order = $item->order;

        $item->delete();

        $order->update([
            'total_amount' => $order->items()->sum('subtotal'),
        ]);

        return back()->with('success', 'Item Removed Successfully');
    }
    public function downloadInvoice(Order $order)
    {
        $order->load('customer', 'items.product');

        $setting = \App\Models\Setting::first();

        $pdf = Pdf::loadView('orders.invoice_pdf', compact('order', 'setting'))
            ->setPaper('a4', 'portrait');

        return $pdf->download(
            'INV-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf'
        );
    }

}
