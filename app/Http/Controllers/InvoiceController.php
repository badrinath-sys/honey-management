<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show(Order $order)
    {
        $order->load('customer', 'items.product');

        $setting = Setting::first();

        return view('orders.invoice', compact('order', 'setting'));
    }

    public function download(Order $order)
    {
        $order->load('customer', 'items.product');

        $setting = Setting::first();

        $pdf = Pdf::loadView(
            'orders.invoice_pdf',
            compact('order', 'setting')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'INV-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf'
        );
    }

    public function print(Order $order)
    {
        $order->load('customer', 'items.product');

        $setting = Setting::first();

        return view('orders.invoice', compact('order', 'setting'));
    }
}
