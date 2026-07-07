@extends('layouts.frontend')

@section('content')
    <!-- Page Header -->

    <section class="bg-warning py-5">

        <div class="container text-center">

            <h1 class="fw-bold text-dark">

                Our Honey Collection

            </h1>

            <p class="lead">

                100% Pure Natural Honey From Nallamala Forest

            </p>

        </div>

    </section>

    <!-- Shop Section -->

    <section class="py-5">

        <div class="container">

            <div class="row">

                <!-- Sidebar -->

                <div class="col-lg-3">

                    <div class="card shadow-sm mb-4">

                        <div class="card-header bg-dark text-white">

                            <h5 class="mb-0">

                                Categories

                            </h5>

                        </div>

                        <div class="list-group list-group-flush">

                            <a href="{{ route('shop') }}" class="list-group-item list-group-item-action">

                            </a>

                            @foreach ($categories as $category)
                                <a href="{{ route('shop.category', $category->slug) }}"
                                    class="list-group-item list-group-item-action">

                                    {{ $category->name }}

                                </a>
                            @endforeach

                        </div>

                    </div>

                    <div class="card shadow-sm">

                        <div class="card-header bg-dark text-white">

                            Search

                        </div>

                        <div class="card-body">

                            <form method="GET" action="{{ route('shop') }}">

                                <input type="text" name="search" class="form-control mb-3" placeholder="Search Honey..."
                                    value="{{ request('search') }}">

                                <button class="btn btn-warning w-100">

                                    <i class="fas fa-search"></i>

                                    Search

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- Products -->

                <div class="col-lg-9">

                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-6 mb-4">

                                <div class="card shadow-sm border-0 h-100">

                                    <img src="{{ asset('assets/images/products/' . $product->image) }}"
                                        class="card-img-top p-3" style="height:220px;object-fit:contain;"
                                        alt="{{ $product->name }}">

                                    <div class="card-body">

                                        <small class="text-muted">

                                            {{ $product->category->name }}

                                        </small>

                                        <h5 class="mt-2">

                                            {{ $product->name }}

                                        </h5>

                                        <p class="text-muted mb-2">

                                            {{ $product->weight }}

                                        </p>

                                        @if ($product->quantity > 0)
                                            <span class="badge bg-success mb-2">

                                                In Stock

                                            </span>
                                        @else
                                            <span class="badge bg-danger mb-2">

                                                Out of Stock

                                            </span>
                                        @endif

                                        <h4 class="text-warning fw-bold">

                                            ₹{{ number_format($product->price, 2) }}

                                        </h4>

                                    </div>

                                    <div class="card-footer bg-white border-0">

                                        <div class="d-grid gap-2">

                                            <a href="{{ route('product.details', $product->slug) }}"
                                                class="btn btn-outline-dark">

                                                <i class="fas fa-eye"></i>

                                                View Details

                                            </a>

                                            @if ($product->quantity > 0)
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST">

                                                    @csrf

                                                    <button class="btn btn-warning w-100">

                                                        <i class="fas fa-shopping-cart"></i>

                                                        Add To Cart

                                                    </button>

                                                </form>
                                            @else
                                                <button class="btn btn-secondary w-100" disabled>

                                                    Out of Stock

                                                </button>
                                            @endif
                                            @if (Auth::guard('customer')->check())
                                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">

                                                    @csrf

                                                    <button class="btn btn-outline-danger w-100">

                                                        <i class="fa fa-heart"></i>

                                                        Add To Wishlist

                                                    </button>

                                                </form>
                                            @else
                                                <a href="{{ route('customer.login') }}"
                                                    class="btn btn-outline-danger w-100">

                                                    <i class="fa fa-heart"></i>

                                                    Login for Wishlist

                                                </a>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="col-12">

                                <div class="alert alert-warning text-center">

                                    No Products Found.

                                </div>

                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->

                    <div class="d-flex justify-content-center mt-4">

                        {{ $products->withQueryString()->links() }}

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
