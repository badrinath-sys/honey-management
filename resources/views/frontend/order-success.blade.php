@extends('layouts.frontend')

@section('content')
    <section class="py-5" style="background:#fffdf7;">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card border-0 shadow-lg rounded-4">

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-check-circle text-success" style="font-size:90px;"></i>

                            </div>

                            <h2 class="fw-bold text-success">

                                Order Placed Successfully!

                            </h2>

                            <p class="text-muted fs-5">

                                Thank you for shopping with

                                <strong>Nature's Gold Honey</strong> 🍯

                            </p>

                            <hr>

                            <div class="row text-start mt-4">

                                <div class="col-md-6 mb-3">

                                    <strong>Order ID</strong><br>

                                    #{{ $order->id }}

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Order Date</strong><br>

                                    {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y h:i A') }}

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Customer</strong><br>

                                    {{ $order->customer->name }}

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Mobile</strong><br>

                                    {{ $order->customer->phone }}

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Payment Method</strong><br>

                                    {{ $order->payment_method }}

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Payment Status</strong><br>

                                    <span class="badge bg-warning">

                                        {{ $order->payment_status }}

                                    </span>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Order Status</strong><br>

                                    <span class="badge bg-primary">

                                        {{ $order->order_status }}

                                    </span>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Total Amount</strong><br>

                                    <span class="fw-bold text-success fs-5">

                                        ₹{{ number_format($order->total_amount, 2) }}

                                    </span>

                                </div>

                            </div>

                            <div class="alert alert-success mt-4">

                                <i class="fas fa-truck"></i>

                                Your order has been received successfully.
                                We will contact you shortly and dispatch your order as soon as possible.

                            </div>

                            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">

                                <a href="{{ route('shop') }}" class="btn btn-warning rounded-pill px-4">

                                    Continue Shopping

                                </a>

                                <a href="{{ route('customer.orders') }}" class="btn btn-outline-dark rounded-pill px-4">

                                    My Orders

                                </a>

                                <a href="{{ route('orders.invoice.pdf', $order->id) }}"
                                    class="btn btn-success rounded-pill px-4">

                                    <i class="fas fa-file-pdf"></i>

                                    Invoice

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
