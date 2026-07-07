@extends('layouts.frontend')

@section('title', 'My Orders')

@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">

                @include('frontend.customer.sidebar')

            </div>

            <div class="col-lg-9">

                <div class="card shadow">

                    <div class="card-header">

                        <h4>My Orders</h4>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>Order #</th>

                                    <th>Date</th>

                                    <th>Total</th>

                                    <th>Status</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($orders as $order)
                                    <tr>

                                        <td>#{{ $order->id }}</td>

                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>

                                        <td>₹₹{{ number_format($order->total_amount, 2) }}</td>

                                        <td>

                                            <span class="badge bg-primary">

                                                {{ ucfirst($order->order_status) }}

                                            </span>

                                        </td>

                                        <td>
                                            <a href="{{ route('customer.orders.show', $order) }}"
                                                class="btn btn-warning btn-sm">

                                                <i class="fa fa-eye"></i>

                                                View

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center">

                                            No Orders Found

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                        {{ $orders->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
