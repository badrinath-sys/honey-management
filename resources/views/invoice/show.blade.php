@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="card shadow">

            <div class="card-body">

                <div class="text-end mb-3">

                    <button onclick="window.print()" class="btn btn-primary">

                        <i class="bi bi-printer"></i> Print Invoice

                    </button>

                </div>

                @php
                    $setting = \App\Models\Setting::first();
                @endphp

                <div class="text-center mb-4">

                    @if ($setting && $setting->company_logo)
                        <img src="{{ asset('storage/' . $setting->company_logo) }}" width="100" class="mb-2">
                    @endif

                    <h2 class="fw-bold">

                        {{ $setting->company_name ?? 'Honey ERP' }}

                    </h2>

                    <p class="mb-1">

                        {{ $setting->address }}

                    </p>

                    <p class="mb-1">

                        Phone : {{ $setting->phone }}

                    </p>

                    <p class="mb-1">

                        Email : {{ $setting->email }}

                    </p>

                    <p>

                        GST : {{ $setting->gst_number }}

                    </p>

                </div>

                <hr>

                <div class="row mb-4">

                    <div class="col-md-6">

                        <h4>Invoice</h4>

                        <p>

                            <strong>Invoice No :</strong>

                            INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}

                        </p>

                        <p>

                            <strong>Date :</strong>

                            {{ $order->order_date }}

                        </p>

                    </div>

                    <div class="col-md-6 text-end">

                        <h5>Customer Details</h5>

                        <p>

                            {{ $order->customer->name ?? '' }}

                        </p>

                    </div>

                </div>

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Product</th>

                            <th>Price</th>

                            <th>Qty</th>

                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                        @php $grandTotal = 0; @endphp

                        @foreach ($order->items as $item)
                            @php

                                $lineTotal = $item->price * $item->quantity;

                                $grandTotal += $lineTotal;

                            @endphp

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->product->name }}</td>

                                <td>₹ {{ number_format($item->price, 2) }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>₹ {{ number_format($lineTotal, 2) }}</td>

                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr>

                            <th colspan="4" class="text-end">

                                Grand Total

                            </th>

                            <th>

                                ₹ {{ number_format($grandTotal, 2) }}

                            </th>

                        </tr>

                    </tfoot>

                </table>

                <div class="text-center mt-5">

                    <p>

                        Thank you for your business!

                    </p>

                </div>

            </div>

        </div>

    </div>

    <style>
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
@endsection
