<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 25px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .left {
            float: left;
            width: 60%;
        }

        .right {
            float: right;
            width: 35%;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p {
            margin: 2px;
        }

        .company {
            font-size: 24px;
            font-weight: bold;
            color: #b8860b;
        }

        .invoice-title {
            text-align: center;
            background: #f4b400;
            color: #fff;
            padding: 8px;
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            border: 1px solid #999;
            padding: 8px;
        }

        .label {
            font-weight: bold;
            width: 35%;
        }
    </style>

</head>

<body>

    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <div class="header">

        <div class="left">

            @if ($setting && $setting->logo)
                <img src="{{ public_path('storage/' . $setting->logo) }}" height="70">
            @endif

            <div class="company">

                {{ $setting->company_name ?? "Nature's Gold Honey" }}

            </div>

            <p>{{ $setting->address }}</p>

            <p>

                Phone :
                {{ $setting->phone }}

            </p>

            <p>

                Email :
                {{ $setting->email }}

            </p>

            <p>

                GSTIN :
                {{ $setting->gst }}

            </p>

        </div>

        <div class="right">

            <h2>INVOICE</h2>

            <h4>

                INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}

            </h4>

            <p>

                Date :

                {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}

            </p>

        </div>

        <div class="clear"></div>

    </div>

    <div class="invoice-title">

        TAX INVOICE

    </div>

    <table class="info">

        <tr>

            <td width="50%">

                <h4>Bill To</h4>

                <br>

                <strong>

                    {{ $order->customer->name }}

                </strong>

                <br>

                @if (!empty($order->customer->phone))
                    Phone :
                    {{ $order->customer->phone }}

                    <br>
                @endif

                @if (!empty($order->customer->email))
                    Email :
                    {{ $order->customer->email }}

                    <br>
                @endif

                @if (!empty($order->customer->address))
                    Address :

                    {{ $order->customer->address }}
                @endif

            </td>

            <td width="50%">

                <strong>Invoice No :</strong>

                INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}

                <br><br>

                <strong>Invoice Date :</strong>

                {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}

                <br><br>

                <strong>Status :</strong>

                {{ $order->order_status }}

            </td>

        </tr>

    </table>

    <br>
