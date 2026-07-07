@extends('layouts.frontend')

@section('content')

    <!-- Page Header -->

    <section class="bg-warning py-5">

        <div class="container text-center">

            <h1 class="fw-bold">

                Shopping Cart

            </h1>

            <p class="lead">

                Review your selected honey products

            </p>

        </div>

    </section>

    <!-- Cart Section -->

    <section class="py-5">

        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">

                    {{ session('success') }}

                </div>
            @endif

            @if (count(session('cart', [])) > 0)
                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>Image</th>

                                <th>Product</th>

                                <th>Weight</th>

                                <th>Price</th>

                                <th width="170">Quantity</th>

                                <th>Subtotal</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @php

                                $total = 0;

                            @endphp

                            @foreach (session('cart') as $id => $item)
                                @php

                                    $subtotal = $item['price'] * $item['quantity'];

                                    $total += $subtotal;

                                @endphp

                                <tr>

                                    <td width="120">

                                        <img src="{{ asset('assets/images/products/' . $item['image']) }}" class="img-fluid"
                                            style="height:80px;object-fit:contain;">

                                    </td>

                                    <td>

                                        <strong>{{ $item['name'] }}</strong>

                                    </td>

                                    <td>

                                        {{ $item['weight'] }}

                                    </td>

                                    <td>

                                        ₹{{ number_format($item['price'], 2) }}

                                    </td>
                                    <td>

                                        <form action="{{ route('cart.update') }}" method="POST">

                                            @csrf

                                            <input type="hidden" name="id" value="{{ $id }}">

                                            <div class="input-group">

                                                <input type="number" name="quantity" class="form-control" min="1"
                                                    value="{{ $item['quantity'] }}">

                                                <button class="btn btn-primary">

                                                    Update

                                                </button>

                                            </div>

                                        </form>

                                    </td>

                                    <td>

                                        <strong>

                                            ₹{{ number_format($subtotal, 2) }}

                                        </strong>

                                    </td>

                                    <td>

                                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Remove this product?')">

                                            <i class="fas fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                <div class="row mt-4">

                    <div class="col-md-6">

                        <a href="{{ route('shop') }}" class="btn btn-outline-dark">

                            <i class="fas fa-arrow-left"></i>

                            Continue Shopping

                        </a>

                    </div>

                    <div class="col-md-6">

                        <div class="card shadow">

                            <div class="card-body">

                                <h4 class="mb-3">

                                    Cart Summary

                                </h4>

                                <hr>

                                <div class="d-flex justify-content-between">

                                    <h5>Grand Total</h5>

                                    <h4 class="text-success">

                                        ₹{{ number_format($total, 2) }}

                                    </h4>

                                </div>

                                <div class="d-grid mt-3">

                                    <a href="{{ route('checkout') }}" class="btn btn-warning btn-lg">

                                        <i class="fas fa-credit-card"></i>

                                        Proceed To Checkout

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            @else
                <div class="text-center py-5">

                    <i class="fas fa-shopping-cart fa-5x text-secondary mb-3"></i>

                    <h3>Your Cart is Empty</h3>

                    <p class="text-muted">

                        Add some delicious honey products to your cart.

                    </p>

                    <a href="{{ route('shop') }}" class="btn btn-warning btn-lg">

                        Shop Now

                    </a>

                </div>
            @endif

        </div>

    </section>

@endsection
