@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3>Products</h3>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow">

            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th width="160">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($products as $product)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    @if ($product->image)
                                        <img src="{{ asset('assets/images/products/' . $product->image) }}" width="70"
                                            class="img-thumbnail">
                                    @else
                                        <img src="{{ asset('assets/images/no-image.png') }}" width="70"
                                            class="img-thumbnail">
                                    @endif

                                </td>

                                <td>

                                    <strong>{{ $product->name }}</strong>

                                    @if ($product->is_featured)
                                        <span class="badge bg-warning text-dark">Featured</span>
                                    @endif

                                    @if ($product->is_best_seller)
                                        <span class="badge bg-success">Best Seller</span>
                                    @endif

                                </td>

                                <td>

                                    {{ $product->category->name ?? '-' }}

                                </td>

                                <td>

                                    {{ $product->sku ?? '-' }}

                                </td>

                                <td>

                                    ₹{{ number_format($product->price, 2) }}

                                </td>

                                <td>

                                    {{ $product->quantity }}

                                </td>

                                <td>

                                    @if ($product->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning me-2">

                                        <i class="fas fa-edit"></i> Edit

                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Delete this product?')">

                                            <i class="fas fa-trash"></i> Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    No Products Found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <div class="mt-3">

                    {{ $products->links() }}

                </div>

            </div>

        </div>

    </div>
@endsection
