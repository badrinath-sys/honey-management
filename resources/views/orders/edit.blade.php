@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            <h2>Edit Order #{{ $order->id }}</h2>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                Back
            </a>

        </div>

        <!-- Order Details -->

        <div class="card mb-4">

            <div class="card-header bg-primary text-white">

                Order Details

            </div>

            <div class="card-body">

                <form action="{{ route('orders.update', $order->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-4">

                            <label>Customer</label>

                            <select name="customer_id" class="form-control">

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $order->customer_id == $customer->id ? 'selected' : '' }}>

                                        {{ $customer->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label>Date</label>

                            <input type="date" name="order_date" class="form-control" value="{{ $order->order_date }}">

                        </div>

                        <div class="col-md-2">

                            <label>Payment</label>

                            <select name="payment_status" class="form-control">

                                <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>
                                    Paid
                                </option>

                            </select>

                        </div>

                        <div class="col-md-2">

                            <label>Status</label>

                            <select name="order_status" class="form-control">

                                <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>
                                    Processing
                                </option>

                                <option value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                        </div>

                        <div class="col-md-1 d-flex align-items-end">

                            <button class="btn btn-success w-100">

                                Save

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Add Product -->

        <div class="card mb-4">

            <div class="card-header bg-success text-white">

                Add Product

            </div>

            <div class="card-body">

                <form action="{{ route('orders.addItem', $order->id) }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6">

                            <label>Product</label>

                            <select name="product_id" class="form-control">

                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">

                                        {{ $product->name }}

                                        (₹{{ $product->price }})
                                        Stock :
                                        {{ $product->quantity }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2">

                            <label>Quantity</label>

                            <input type="number" name="quantity" value="1" min="1" class="form-control">

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button class="btn btn-primary">

                                Add

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Order Items -->

        <div class="card">

            <div class="card-header bg-dark text-white">

                Order Items

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Product</th>

                            <th>Price</th>

                            <th>Qty</th>

                            <th>Subtotal</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($order->items as $item)
                            <tr>

                                <td>{{ $item->product->name }}</td>

                                <td>₹ {{ number_format($item->price, 2) }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>₹ {{ number_format($item->subtotal, 2) }}</td>

                                <td>

                                    <form action="{{ route('orders.removeItem', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Remove Product?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">

                                            Remove

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    No Products Added

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                    <tfoot>

                        <tr>

                            <th colspan="3" class="text-end">

                                Total

                            </th>

                            <th>

                                ₹ {{ number_format($order->total_amount, 2) }}

                            </th>

                            <th></th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>
@endsection
