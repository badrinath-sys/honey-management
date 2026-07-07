@extends('layouts.master')

@section('content')

    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            <h2>Edit Purchase #{{ $purchase->id }}</h2>

            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

        <!-- Purchase Details -->

        <div class="card shadow mb-4">

            <div class="card-header bg-primary text-white">

                Purchase Details

            </div>

            <div class="card-body">

                <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-4">

                            <label>Supplier</label>

                            <select name="supplier_id" class="form-control">

                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>

                                        {{ $supplier->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label>Date</label>

                            <input type="date" name="purchase_date" class="form-control"
                                value="{{ $purchase->purchase_date }}">

                        </div>

                        <div class="col-md-3">

                            <label>Payment</label>

                            <select name="payment_status" class="form-control">

                                <option value="Pending" {{ $purchase->payment_status == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Paid" {{ $purchase->payment_status == 'Paid' ? 'selected' : '' }}>
                                    Paid
                                </option>

                            </select>

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button class="btn btn-success w-100">

                                Save

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Add Product -->

        <div class="card shadow mb-4">

            <div class="card-header bg-success text-white">

                Add Product

            </div>

            <div class="card-body">

                <form action="{{ route('purchases.addItem', $purchase->id) }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6">

                            <label>Product</label>

                            <select name="product_id" class="form-control">

                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">

                                        {{ $product->name }}

                                        (₹ {{ number_format($product->price, 2) }})
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2">

                            <label>Price</label>

                            <input type="number" name="price" step="0.01" class="form-control" required>

                        </div>

                        <div class="col-md-2">

                            <label>Quantity</label>

                            <input type="number" name="quantity" value="1" min="1" class="form-control">

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button class="btn btn-primary w-100">

                                Add

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Purchase Items -->

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                Purchased Products

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">

                        <tr>

                            <th>Product</th>

                            <th>Price</th>

                            <th>Qty</th>

                            <th>Subtotal</th>

                            <th width="120">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($purchase->items as $item)
                            <tr>

                                <td>{{ $item->product->name }}</td>

                                <td>

                                    ₹ {{ number_format($item->price, 2) }}

                                </td>

                                <td>

                                    {{ $item->quantity }}

                                </td>

                                <td>

                                    ₹ {{ number_format($item->subtotal, 2) }}

                                </td>

                                <td>

                                    <form action="{{ route('purchases.removeItem', $item->id) }}" method="POST"
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

                                Grand Total

                            </th>

                            <th>

                                ₹ {{ number_format($purchase->total_amount, 2) }}

                            </th>

                            <th></th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

@endsection
