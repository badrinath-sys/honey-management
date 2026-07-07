@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->

    <section class="bg-warning-subtle py-5">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <span class="badge bg-success mb-3">

                        🌿 100% Natural Honey

                    </span>

                    <h1 class="display-4 fw-bold">

                        Pure Natural Honey

                    </h1>

                    <h2 class="text-warning fw-bold">

                        From Nallamala Forest

                    </h2>

                    <p class="lead mt-4">

                        Experience the taste of pure, raw and natural honey
                        collected directly from the forests.

                        No Sugar

                        No Chemicals

                        No Preservatives

                    </p>

                    <a href="{{ route('shop') }}" class="btn btn-warning btn-lg me-3">

                        Shop Now

                    </a>

                    <a href="#featured" class="btn btn-outline-dark btn-lg">

                        Explore

                    </a>

                </div>

                <div class="col-lg-6 text-center">

                    <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid">

                </div>

            </div>

        </div>

    </section>

    <!-- Categories -->

    <section class="py-5">

        <div class="container">

            <h2 class="text-center mb-5">

                Shop By Category

            </h2>

            <div class="row">

                @foreach ($categories as $category)
                    <div class="col-md-3 mb-4">

                        <div class="card border-0 shadow h-100">

                            <img src="{{ asset('assets/images/categories/' . $category->image) }}" class="card-img-top p-3"
                                style="height:180px;object-fit:contain;">

                            <div class="card-body text-center">

                                <h5>

                                    {{ $category->name }}

                                </h5>

                                <a href="{{ route('shop.category', $category->slug) }}" class="btn btn-warning">
                                    View Products
                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>
    <!-- Featured Products -->

    <section class="py-5 bg-light" id="featured">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    ⭐ Featured Products

                </h2>

                <p class="text-muted">

                    Our Most Popular Honey Collection

                </p>

            </div>

            <div class="row">

                @foreach ($featuredProducts as $product)
                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="card border-0 shadow-sm h-100">

                            <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top p-3"
                                style="height:220px;object-fit:contain;" alt="{{ $product->name }}">

                            <div class="card-body">

                                <small class="text-muted">

                                    {{ $product->category->name }}

                                </small>

                                <h5 class="mt-2">

                                    {{ $product->name }}

                                </h5>

                                <div class="mb-2">

                                    @if ($product->quantity > 0)
                                        <span class="badge bg-success">

                                            In Stock

                                        </span>
                                    @else
                                        <span class="badge bg-danger">

                                            Out of Stock

                                        </span>
                                    @endif

                                </div>

                                <h4 class="text-warning fw-bold">

                                    ₹{{ number_format($product->price, 2) }}

                                </h4>

                            </div>

                            <div class="card-footer bg-white border-0">

                                <div class="d-grid gap-2">

                                    <a href="{{ route('product.details', $product->slug) }}" class="btn btn-outline-dark">

                                        <i class="fas fa-eye"></i>

                                        View Details

                                    </a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">

                                        @csrf

                                        <button type="submit" class="btn btn-warning w-100">

                                            <i class="fas fa-shopping-cart"></i>

                                            Add To Cart

                                        </button>

                                    </form>
                                    @if (Auth::guard('customer')->check())
                                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">

                                            @csrf

                                            <button class="btn btn-outline-danger w-100">

                                                <i class="fa fa-heart"></i>

                                                Add To Wishlist

                                            </button>

                                        </form>
                                    @else
                                        <a href="{{ route('customer.login') }}" class="btn btn-outline-danger w-100">

                                            <i class="fa fa-heart"></i>

                                            Login for Wishlist

                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>
    <!-- Best Seller Products -->

    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    🔥 Best Seller Products

                </h2>

                <p class="text-muted">

                    Customer Favorite Honey Collection

                </p>

            </div>

            <div class="row">

                @foreach ($bestSellerProducts as $product)
                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="card shadow border-0 h-100">

                            <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top p-3"
                                style="height:220px;object-fit:contain;">

                            <div class="card-body text-center">

                                <span class="badge bg-danger mb-2">

                                    BEST SELLER

                                </span>

                                <h5>

                                    {{ $product->name }}

                                </h5>

                                <h4 class="text-success">

                                    ₹{{ number_format($product->price, 2) }}

                                </h4>

                            </div>

                            <div class="card-footer bg-white border-0">

                                <div class="d-grid">

                                    <a href="{{ route('product.details', $product->slug) }}" class="btn btn-warning">

                                        View Product

                                    </a>

                                </div>

                            </div>
                            <div class="card-footer bg-white border-0">
                                @if (Auth::guard('customer')->check())
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">

                                        @csrf

                                        <button class="btn btn-outline-danger w-100">

                                            <i class="fa fa-heart"></i>

                                            Add To Wishlist

                                        </button>

                                    </form>
                                @else
                                    <a href="{{ route('customer.login') }}" class="btn btn-outline-danger w-100">

                                        <i class="fa fa-heart"></i>

                                        Login for Wishlist

                                    </a>
                                @endif
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <!-- Why Choose Us -->

    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    Why Choose Nature's Gold Honey?

                </h2>

            </div>

            <div class="row text-center">

                <div class="col-md-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <h1>🍯</h1>

                            <h5>100% Pure</h5>

                            <p>

                                No Sugar Added

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <h1>🌿</h1>

                            <h5>Natural</h5>

                            <p>

                                Collected From Forest

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <h1>🧪</h1>

                            <h5>Quality Tested</h5>

                            <p>

                                Hygienically Packed

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <h1>🚚</h1>

                            <h5>Fast Delivery</h5>

                            <p>

                                Across India

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Customer Reviews -->

    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    ❤️ What Our Customers Say

                </h2>

                <p class="text-muted">

                    Trusted by Thousands of Happy Customers

                </p>

            </div>

            <div class="row">

                <div class="col-md-4 mb-4">

                    <div class="card shadow border-0 h-100">

                        <div class="card-body">

                            <h4 class="text-warning">★★★★★</h4>

                            <p>

                                Excellent quality honey. Pure taste and fast delivery.
                                My family loves it.

                            </p>

                            <h6 class="mb-0">

                                - Ravi Kumar

                            </h6>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-4">

                    <div class="card shadow border-0 h-100">

                        <div class="card-body">

                            <h4 class="text-warning">★★★★★</h4>

                            <p>

                                Best honey I have purchased online.
                                Highly recommended.

                            </p>

                            <h6 class="mb-0">

                                - Suresh

                            </h6>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-4">

                    <div class="card shadow border-0 h-100">

                        <div class="card-body">

                            <h4 class="text-warning">★★★★★</h4>

                            <p>

                                Original forest honey with natural taste.
                                Very satisfied.

                            </p>

                            <h6 class="mb-0">

                                - Priya

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Call To Action -->

    <section class="py-5 bg-warning">

        <div class="container text-center">

            <h2 class="fw-bold mb-3">

                Ready To Taste Pure Honey?

            </h2>

            <p class="lead mb-4">

                Order today and experience the authentic taste of
                Nature's Gold Honey.

            </p>

            <a href="{{ route('shop') }}" class="btn btn-dark btn-lg">

                Shop Now

            </a>

        </div>

    </section>

    <!-- Footer -->

    <footer class="bg-dark text-white pt-5 pb-3">

        <div class="container">

            <div class="row">

                <div class="col-lg-4">

                    <h4 class="text-warning">

                        Nature's Gold Honey

                    </h4>

                    <p>

                        Premium quality natural honey collected from
                        the forests of Nallamala.

                    </p>

                </div>

                <div class="col-lg-2">

                    <h5>Quick Links</h5>

                    <ul class="list-unstyled">

                        <li><a href="/" class="text-white text-decoration-none">Home</a></li>

                        <li><a href="{{ route('shop') }}" class="text-white text-decoration-none">Shop</a></li>

                        <li><a href="#" class="text-white text-decoration-none">About</a></li>

                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>

                    </ul>

                </div>

                <div class="col-lg-3">

                    <h5>Contact</h5>

                    <p>

                        📍 Telangana, India

                    </p>

                    <p>

                        📞 +91 XXXXX XXXXX

                    </p>

                    <p>

                        ✉ info@naturesgoldhoney.com

                    </p>

                </div>

                <div class="col-lg-3">

                    <h5>Follow Us</h5>

                    <a href="#" class="btn btn-outline-light btn-sm me-2">

                        Facebook

                    </a>

                    <a href="#" class="btn btn-outline-light btn-sm me-2">

                        Instagram

                    </a>

                    <a href="#" class="btn btn-outline-light btn-sm">

                        YouTube

                    </a>

                </div>

            </div>

            <hr>

            <div class="text-center">

                © {{ date('Y') }} Nature's Gold Honey. All Rights Reserved.

            </div>

        </div>

    </footer>
@endsection
