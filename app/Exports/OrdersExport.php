<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    public function collection()
    {
        return Order::with('customer')
            ->get()
            ->map(function ($order) {

                return [

                    'Order ID'       => $order->id,

                    'Customer'       => $order->customer->name,

                    'Order Date'     => $order->order_date,

                    'Total Amount'   => $order->total_amount,

                    'Payment Status' => $order->payment_status,

                    'Order Status'   => $order->order_status,

                ];

            });

    }
}
