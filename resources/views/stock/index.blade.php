@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">

            <h2>Stock Report</h2>

        </div>

        <form method="GET" action="{{ route('stock.index') }}" class="mb-4">

            <div class="row">

                <div class="col-md-4">

                    <input type="text" name="search" class="form-control" placeholder="Search Product..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">

                        Search

                    </button>

                </div>

                <div class="col-md-2">

                    <a href="{{ route('stock.index') }}" class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

        @php
            $totalInventory = 0;
        @endphp

        <table id="dataTable" class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Image</th>

                    <th>Category</th>

                    <th>Product</th>

                    <th>Price</th>

                    <th>Stock Qty</th>

                    <th>Stock Value</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($products as $product)
                    @php
                        $value = $product->price * $product->quantity;
                        $totalInventory += $value;
                    @endphp

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>

                            @if ($product->image)
                                <img src="{{ asset('product_images/' . $product->image) }}" width="60" class="rounded">
                            @else
                                No Image
                            @endif

                        </td>

                        <td>{{ $product->category->name }}</td>

                        <td>{{ $product->name }}</td>

                        <td>₹ {{ number_format($product->price, 2) }}</td>

                        <td>

                            {{ $product->quantity }}

                        </td>

                        <td>

                            ₹ {{ number_format($value, 2) }}

                        </td>

                        <td>

                            @if ($product->quantity == 0)
                                <span class="badge bg-danger">

                                    Out of Stock

                                </span>
                            @elseif($product->quantity <= 10)
                                <span class="badge bg-warning text-dark">

                                    Low Stock

                                </span>
                            @else
                                <span class="badge bg-success">

                                    In Stock

                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No Products Found

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        <div class="card mt-3">

            <div class="card-body">

                <h4>

                    Total Inventory Value :

                    <span class="text-success">

                        ₹ {{ number_format($totalInventory, 2) }}

                    </span>

                </h4>

            </div>

        </div>

        <div class="mt-3">

            {{ $products->links() }}

        </div>

    </div>
@endsection
