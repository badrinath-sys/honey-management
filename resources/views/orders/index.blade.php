@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Orders</h2>

            <a href="{{ route('orders.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Create Order

            </a>
            <a href="{{ route('orders.export') }}" class="btn btn-success">

                Export Excel

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Customer</th>

                        <th>Order Date</th>

                        <th>Total Amount</th>

                        <th>Payment</th>

                        <th>Status</th>

                        <th width="260">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)
                        <tr>

                            <td>{{ $order->id }}</td>

                            <td>{{ $order->customer->name }}</td>

                            <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>

                            <td>

                                ₹ {{ number_format($order->total_amount, 2) }}

                            </td>

                            <td>

                                @if ($order->payment_status == 'Paid')
                                    <span class="badge bg-success">

                                        Paid

                                    </span>
                                @elseif($order->payment_status == 'Pending')
                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>
                                @else
                                    <span class="badge bg-danger">

                                        Unpaid

                                    </span>
                                @endif

                            </td>

                            <td>

                                @if ($order->order_status == 'Completed')
                                    <span class="badge bg-success">

                                        Completed

                                    </span>
                                @elseif($order->order_status == 'Processing')
                                    <span class="badge bg-info">

                                        Processing

                                    </span>
                                @else
                                    <span class="badge bg-secondary">

                                        {{ $order->order_status }}

                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-info btn-sm">

                                    Invoice

                                </a>

                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this order?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                No Orders Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $orders->links() }}

        </div>

    </div>
@endsection
