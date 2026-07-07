@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-body">

                <!-- Buttons -->

                <div class="text-end mb-3 no-print">

                    <button onclick="window.print()" class="btn btn-primary">

                        <i class="bi bi-printer"></i> Print

                    </button>

                    <a href="{{ route('orders.invoice.pdf', $order->id) }}" class="btn btn-danger">

                        <i class="bi bi-file-earmark-pdf"></i>

                        Download PDF

                    </a>

                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </div>

                <!-- Header -->

                <table width="100%">

                    <tr>

                        <td width="20%">

                            @if (!empty($setting->logo))
                                <img src="{{ asset('uploads/settings/' . $setting->logo) }}" width="100">
                            @endif

                        </td>

                        <td align="center">

                            <h2>

                                {{ $setting->company_name }}

                            </h2>

                            <div>

                                {{ $setting->address }}

                            </div>

                            <div>

                                Phone : {{ $setting->phone }}

                            </div>

                            <div>

                                Email : {{ $setting->email }}

                            </div>

                            <div>

                                Website : {{ $setting->website }}

                            </div>

                            <div>

                                GST : {{ $setting->gst }}

                            </div>

                        </td>

                    </tr>

                </table>

                <hr>

                <!-- Invoice Info -->

                <table width="100%">

                    <tr>

                        <td>

                            <h5>

                                Bill To

                            </h5>

                            <strong>

                                {{ $order->customer->name }}

                            </strong>

                            <br>

                            {{ $order->customer->phone }}

                            <br>

                            {{ $order->customer->address }}

                        </td>

                        <td align="right">

                            <h4>

                                TAX INVOICE

                            </h4>

                            <strong>

                                Invoice No :

                            </strong>

                            INV-{{ date('Y') }}-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}

                            <br>

                            <strong>

                                Date :

                            </strong>

                            {{ date('d-m-Y', strtotime($order->order_date)) }}

                            <br>

                            <strong>

                                Status :

                            </strong>

                            {{ $order->order_status }}

                        </td>

                    </tr>

                </table>

                <hr>

                <!-- Items -->

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Product</th>

                            <th width="100">Qty</th>

                            <th width="120">Price</th>

                            <th width="140">Total</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($order->items as $key => $item)
                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $item->product->name }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>

                                    ₹ {{ number_format($item->price, 2) }}

                                </td>

                                <td>

                                    ₹ {{ number_format($item->subtotal, 2) }}

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <!-- Total -->

                <div class="row mt-4">

                    <div class="col-md-6">

                        <h5>Bank Details</h5>

                        <table class="table table-bordered">

                            <tr>
                                <th width="40%">Bank</th>
                                <td>{{ $setting->bank_name }}</td>
                            </tr>

                            <tr>
                                <th>Account Name</th>
                                <td>{{ $setting->account_name }}</td>
                            </tr>

                            <tr>
                                <th>Account Number</th>
                                <td>{{ $setting->account_number }}</td>
                            </tr>

                            <tr>
                                <th>IFSC</th>
                                <td>{{ $setting->ifsc }}</td>
                            </tr>

                            <tr>
                                <th>Branch</th>
                                <td>{{ $setting->branch }}</td>
                            </tr>

                            <tr>
                                <th>UPI ID</th>
                                <td>{{ $setting->upi_id }}</td>
                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th width="60%">Grand Total</th>

                                <th>

                                    ₹ {{ number_format($order->total_amount, 2) }}

                                </th>

                            </tr>

                        </table>

                    </div>

                </div>

                <!-- QR + Signature -->

                <div class="row mt-5">

                    <div class="col-md-6">

                        <h6>Scan & Pay</h6>

                        @if (!empty($setting->upi_qr))
                            <img src="{{ asset('uploads/settings/' . $setting->upi_qr) }}" width="170">
                        @endif

                    </div>

                    <div class="col-md-6 text-end">

                        @if (!empty($setting->signature))
                            <img src="{{ asset('uploads/settings/' . $setting->signature) }}" height="80">
                        @endif

                        <br><br>

                        <strong>

                            Authorized Signature

                        </strong>

                    </div>

                </div>

                <!-- Terms -->

                <div class="mt-5">

                    <h6>

                        Terms & Conditions

                    </h6>

                    <p>

                        {!! nl2br(e($setting->terms)) !!}

                    </p>

                </div>

            </div>

        </div>

    </div>

    <style>
        @media print {
            .no-print {
                display: none;
            }

            .navbar,
            .sidebar,
            .footer {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .card {
                border: none;
                box-shadow: none;
            }
        }
    </style>
@endsection
