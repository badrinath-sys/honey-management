@extends('layouts.frontend')

@section('content')
    <section class="py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card shadow border-0">

                        <div class="card-body text-center p-5">

                            <i class="fas fa-check-circle text-success" style="font-size:80px;"></i>

                            <h2 class="mt-4">

                                Order Placed Successfully

                            </h2>

                            <p class="lead">

                                Thank you for choosing

                                <strong>Nature's Gold Honey</strong>

                            </p>

                            <hr>

                            <h5>

                                Order ID :
                                <strong>#{{ $order->id }}</strong>

                            </h5>

                            <h5>

                                Customer :
                                {{ $order->customer->name }}

                            </h5>

                            <h5>

                                Total :

                                ₹{{ number_format($order->total_amount, 2) }}

                            </h5>

                            <div class="mt-4">

                                <a href="{{ route('shop') }}" class="btn btn-warning">

                                    Continue Shopping

                                </a>

                                <a href="{{ route('orders.invoice.pdf', $order->id) }}" class="btn btn-dark">

                                    <i class="fas fa-file-pdf"></i>

                                    Download Invoice

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
