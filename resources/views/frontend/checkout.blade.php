@extends('layouts.frontend')

@section('content')
    <!-- Checkout Header -->

    <section class="bg-warning py-5">

        <div class="container text-center">

            <h1 class="fw-bold">

                Checkout

            </h1>

            <p class="lead">

                Complete your order

            </p>

        </div>

    </section>

    <!-- Checkout Section -->

    <section class="py-5">

        <div class="container">

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Billing Details -->

                    <div class="col-lg-7">

                        <div class="card shadow">

                            <div class="card-header bg-dark text-white">

                                <h4 class="mb-0">

                                    Billing Details

                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Full Name

                                        </label>

                                        <input type="text" name="customer_name" class="form-control" required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Mobile Number

                                        </label>

                                        <input type="text" name="phone" class="form-control" required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Email

                                        </label>

                                        <input type="email" name="email" class="form-control">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Pincode

                                        </label>

                                        <input type="text" name="pincode" class="form-control">

                                    </div>

                                    <div class="col-12 mb-3">

                                        <label class="form-label">

                                            Address

                                        </label>

                                        <textarea name="address" rows="4" class="form-control" required></textarea>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            City

                                        </label>

                                        <input type="text" name="city" class="form-control">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            State

                                        </label>

                                        <input type="text" name="state" class="form-control">

                                    </div>

                                    <div class="col-12">

                                        <label class="form-label">

                                            Order Notes

                                        </label>

                                        <textarea name="notes" rows="3" class="form-control"></textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Order Summary -->

                    <div class="col-lg-5">

                        <div class="card shadow">

                            <div class="card-header bg-dark text-white">

                                <h4 class="mb-0">

                                    Order Summary

                                </h4>

                            </div>

                            <div class="card-body">

                                @php

                                    $grandTotal = 0;

                                @endphp

                                @foreach (session('cart', []) as $id => $item)
                                    @php

                                        $subtotal = $item['price'] * $item['quantity'];

                                        $grandTotal += $subtotal;

                                    @endphp

                                    <div class="d-flex justify-content-between mb-3">

                                        <div>

                                            <strong>{{ $item['name'] }}</strong>

                                            <br>

                                            <small class="text-muted">

                                                {{ $item['quantity'] }} × ₹{{ number_format($item['price'], 2) }}

                                            </small>

                                        </div>

                                        <div>

                                            ₹{{ number_format($subtotal, 2) }}

                                        </div>

                                    </div>

                                    <hr>
                                @endforeach

                                <div class="d-flex justify-content-between mb-3">

                                    <strong>Subtotal</strong>

                                    <strong>

                                        ₹{{ number_format($grandTotal, 2) }}

                                    </strong>

                                </div>

                                <div class="d-flex justify-content-between mb-3">

                                    <strong>Shipping</strong>

                                    <strong class="text-success">

                                        FREE

                                    </strong>

                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">

                                    <h4>Total</h4>

                                    <h4 class="text-success">

                                        ₹{{ number_format($grandTotal, 2) }}

                                    </h4>

                                </div>

                                <div class="d-grid mt-4">

                                    <button type="submit" class="btn btn-warning btn-lg">

                                        <i class="fas fa-check-circle"></i>

                                        Place Order

                                    </button>

                                </div>

                                <div class="mt-3 text-center">

                                    <a href="{{ route('cart') }}" class="btn btn-outline-secondary">

                                        Back to Cart

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>
@endsection
