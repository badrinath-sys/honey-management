@extends('layouts.frontend')

@section('content')
    <section class="bg-warning py-5">

        <div class="container text-center">

            <h1 class="fw-bold">

                Order Details

            </h1>

            <p class="lead">

                Order #{{ $order->id }}

            </p>

        </div>

    </section>

    <section class="py-5">

        <div class="container">

            <div class="row">

                <div class="col-lg-4">

                    <div class="card shadow">

                        <div class="card-header bg-dark text-white">

                            Customer Details

                        </div>

                        <div class="card-body">

                            <p>

                                <strong>Name :</strong>

                                {{ $order->customer->name }}

                            </p>

                            <p>

                                <strong>Phone :</strong>

                                {{ $order->customer->phone }}

                            </p>

                            <p>

                                <strong>Email :</strong>

                                {{ $order->customer->email ?? '-' }}

                            </p>

                            <p>

                                <strong>Address :</strong>

                                {{ $order->customer->address }}

                            </p>

                        </div>

                    </div>

                    <br>

                    <div class="card shadow">

                        <div class="card-header bg-dark text-white">

                            Order Information

                        </div>

                        <div class="card-body">

                            <p>

                                <strong>Order ID :</strong>

                                #{{ $order->id }}

                            </p>

                            <p>

                                <strong>Order Date :</strong>

                                {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}

                            </p>

                            <p>

                                <strong>Status :</strong>

                                <span class="badge bg-primary">

                                    {{ $order->order_status }}

                                </span>

                            </p>

                            <p>

                                <strong>Payment :</strong>

                                <span class="badge bg-success">

                                    {{ $order->payment_status }}

                                </span>

                            </p>

                            <p>

                                <strong>Total :</strong>

                                ₹{{ number_format($order->total_amount, 2) }}

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-8">

                    <div class="card shadow">

                        <div class="card-header bg-dark text-white">

                            Ordered Products

                        </div>

                        <div class="table-responsive">

                            <table class="table table-bordered mb-0">

                                <thead>

                                    <tr>

                                        <th>Image</th>

                                        <th>Product</th>

                                        <th>Price</th>

                                        <th>Qty</th>

                                        <th>Subtotal</th>

                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>

                                            <td width="100">

                                                <img src="{{ asset('assets/images/products/' . $item->product->image) }}"
                                                    class="img-fluid" style="height:70px;object-fit:contain;"
                                                    alt="{{ $item->product->name }}">

                                            </td>

                                            <td>

                                                <strong>{{ $item->product->name }}</strong>

                                                <br>

                                                <small class="text-muted">

                                                    {{ $item->product->weight }}

                                                </small>

                                            </td>

                                            <td>

                                                ₹{{ number_format($item->price, 2) }}

                                            </td>

                                            <td>

                                                {{ $item->quantity }}

                                            </td>

                                            <td>

                                                ₹{{ number_format($item->subtotal, 2) }}

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                                <tfoot>

                                    <tr class="table-warning">

                                        <th colspan="4" class="text-end">

                                            Grand Total

                                        </th>

                                        <th>

                                            ₹{{ number_format($order->total_amount, 2) }}

                                        </th>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                        <div class="card-footer d-flex justify-content-between">

                            <a href="{{ route('my.orders') }}" class="btn btn-secondary">

                                <i class="fas fa-arrow-left"></i>

                                Back

                            </a>

                            <a href="{{ route('orders.invoice.pdf', $order) }}" class="btn btn-danger">

                                <i class="fas fa-file-pdf"></i>

                                Download Invoice

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
