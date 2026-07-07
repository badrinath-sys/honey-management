<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .items th,
        .items td {
            border: 1px solid #666;
            padding: 6px;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }
    </style>

</head>

<body>

    <table class="header">

        <tr>

            <td width="20%">

                @if (!empty($setting->logo))
                    <img src="{{ public_path('uploads/settings/' . $setting->logo) }}" width="90">
                @endif

            </td>

            <td class="center">

                <div class="title">

                    {{ $setting->company_name }}

                </div>

                {{ $setting->address }}<br>

                Phone : {{ $setting->phone }}<br>

                Email : {{ $setting->email }}<br>

                Website : {{ $setting->website }}<br>

                GST : {{ $setting->gst }}

            </td>

        </tr>

    </table>

    <table>

        <tr>

            <td>

                <b>Bill To</b><br><br>

                {{ $order->customer->name }}<br>

                {{ $order->customer->phone }}<br>

                {{ $order->customer->address }}

            </td>

            <td class="right">

                <b>Invoice No</b><br>

                INV-{{ date('Y') }}-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}

                <br><br>

                <b>Date</b><br>

                {{ date('d-m-Y', strtotime($order->order_date)) }}

            </td>

        </tr>

    </table>

    <br>

    <table class="items">

        <thead>

            <tr>

                <th>#</th>

                <th>Product</th>

                <th>Qty</th>

                <th>Rate</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($order->items as $key => $item)
                <tr>

                    <td>{{ $key + 1 }}</td>

                    <td>{{ $item->product->name }}</td>

                    <td>{{ $item->quantity }}</td>

                    <td>₹ {{ number_format($item->price, 2) }}</td>

                    <td>₹ {{ number_format($item->subtotal, 2) }}</td>

                </tr>
            @endforeach

            <tr>

                <td colspan="4" class="right">

                    <b>Grand Total</b>

                </td>

                <td>

                    <b>

                        ₹ {{ number_format($order->total_amount, 2) }}

                    </b>

                </td>

            </tr>

        </tbody>

    </table>

    <br><br>

    <table>

        <tr>

            <td width="60%">

                <b>Bank Details</b><br><br>

                Bank :

                {{ $setting->bank_name }}<br>

                A/C :

                {{ $setting->account_number }}<br>

                IFSC :

                {{ $setting->ifsc }}<br>

                UPI :

                {{ $setting->upi_id }}

            </td>

            <td class="right">

                @if (!empty($setting->upi_qr))
                    <img src="{{ public_path('uploads/settings/' . $setting->upi_qr) }}" width="100">
                @endif

                <br><br>

                @if (!empty($setting->signature))
                    <img src="{{ public_path('uploads/settings/' . $setting->signature) }}" height="60">
                @endif

                <br>

                <b>Authorized Signature</b>

            </td>

        </tr>

    </table>

    <br>

    <hr>

    <b>Terms & Conditions</b>

    <br><br>

    {!! nl2br(e($setting->terms)) !!}

</body>

</html>
