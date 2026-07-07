@extends('layouts.frontend')

@section('content')

    <section class="bg-warning py-5">

        <div class="container text-center">

            <h1 class="fw-bold">My Orders</h1>

            <p class="lead">

                Enter your mobile number to view your orders

            </p>

        </div>

    </section>

    <section class="py-5">

        <div class="container">

            @if (session('error'))
                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>
            @endif

            <div class="row justify-content-center">

                <div class="col-lg-6">

                    <div class="card shadow">

                        <div class="card-body">

                            <form action="{{ route('my.orders.search') }}" method="POST">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">

                                        Mobile Number

                                    </label>

                                    <input type="text" name="phone" class="form-control"
                                        placeholder="Enter Mobile Number" required>

                                </div>

                                <div class="d-grid">

                                    <button class="btn btn-warning">

                                        <i class="fas fa-search"></i>

                                        Search Orders

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
            @if (isset($orders))
                <div class="card shadow mt-5">

                    <div class="card-header bg-dark text-white">

                        My Orders

                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered mb-0">

                            <thead>

                                <tr>

                                    <th>Order ID</th>

                                    <th>Date</th>

                                    <th>Total</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($orders as $order)
                                    <tr>

                                        <td>#{{ $order->id }}</td>

                                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>

                                        <td>₹{{ number_format($order->total_amount, 2) }}</td>

                                        <td>

                                            <span class="badge bg-primary">

                                                {{ $order->order_status }}

                                            </span>

                                        </td>

                                        <td>

                                            <a href="{{ route('my.orders.show', $order) }}" class="btn btn-sm btn-warning">

                                                View

                                            </a>

                                            <a href="{{ route('orders.invoice.pdf', $order) }}" class="btn btn-sm btn-dark">

                                                PDF

                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>
            @endif

        </div>

    </section>

@endsection
