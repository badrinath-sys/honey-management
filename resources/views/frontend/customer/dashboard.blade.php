@extends('layouts.frontend')

@section('title', 'My Account')

@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">

                @include('frontend.customer.sidebar')

            </div>

            <div class="col-lg-9">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <h3>

                            Welcome,

                            {{ $customer->name }}

                        </h3>

                        <hr>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="card text-center shadow-sm">

                                    <div class="card-body">

                                        <h2>

                                            {{ \App\Models\Order::where('customer_id', $customer->id)->count() }}

                                        </h2>

                                        <p>Total Orders</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="card text-center shadow-sm">

                                    <div class="card-body">

                                        <h2>

                                            {{ \App\Models\Wishlist::where('customer_id', $customer->id)->count() }}

                                        </h2>

                                        <p>Wishlist</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="card text-center shadow-sm">

                                    <div class="card-body">

                                        <h2>

                                            {{ $customer->phone }}

                                        </h2>

                                        <p>Phone</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
