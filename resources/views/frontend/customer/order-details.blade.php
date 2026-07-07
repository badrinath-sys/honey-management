@extends('layouts.frontend')

@section('title', 'Order Details')

@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">

                @include('frontend.customer.sidebar')

            </div>

            <div class="col-lg-9">

                <div class="card shadow">

                    <div class="card-header d-flex justify-content-between">

                        <h4>

                            Order #{{ $order->id }}

                        </h4>

                        <a href="{{ route('customer.orders.invoice', $order) }}" class="btn btn-danger">

                            <i class="fa fa-file-pdf"></i>

                            Download Invoice

                        </a>

                    </div>

                    <div class="card-body">

                        <div class="row mb-4">

                            <div class="col-md-6">

                                <h5>Order Information</h5>

                                <p><strong>Date :</strong>

                                    {{ $order->created_at->format('d-m-Y') }}

                                </p>

                                <p><strong>Status :</strong>

                                    <span class="badge bg-primary">

                                        {{ ucfirst($order->order_status) }}

                                    </span>

                                </p>

                            </div>

                            <div class="col-md-6">

                                <h5>Shipping Address</h5>

                                <p>

                                    {{ $order->customer->name }}<br>

                                    {{ $order->customer->phone }}<br>

                                    {{ $order->customer->address }}

                                </p>

                            </div>

                        </div>

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>Product</th>

                                    <th>Qty</th>

                                    <th>Price</th>

                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($order->items as $item)
                                    <tr>

                                        <td>

                                            {{ $item->product->name }}

                                        </td>

                                        <td>

                                            {{ $item->quantity }}

                                        </td>

                                        <td>

                                            ₹{{ number_format($item->price, 2) }}

                                        </td>

                                        <td>

                                            ₹{{ number_format($item->subtotal, 2) }}

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                        <div class="text-end">

                            <h4>

                                Grand Total :

                                ₹₹{{ number_format($order->total_amount, 2) }}

                            </h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
