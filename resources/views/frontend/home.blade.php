@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">

            <div class="row align-items-center">

                <!-- Left Content -->
                <div class="col-lg-6">

                    <span class="badge bg-warning text-dark px-3 py-2 mb-3">
                        🍯 100% Pure Natural Honey
                    </span>

                    <h1 class="hero-title mt-3">
                        Taste Nature's
                        <span class="text-warning">Pure Honey</span>
                    </h1>

                    <p class="hero-text mt-4">
                        Welcome to <strong>Nature's Gold Honey</strong>.
                        Our store is located in <strong>Hastinapur, Hyderabad</strong>.

                        We, <strong>Badrinath</strong> and <strong>Santhosh</strong>,
                        personally maintain our bee colonies and harvest
                        fresh natural honey using ethical beekeeping practices.
                    </p>

                    <div class="mt-4">

                        <a href="{{ route('shop') }}" class="btn btn-warning btn-lg rounded-pill px-4 me-2">
                            Shop Now
                        </a>

                        <a href="{{ route('about') }}" class="btn btn-outline-dark btn-lg rounded-pill px-4">
                            Our Story
                        </a>

                    </div>

                </div>

                <!-- Right Image -->
                <div class="col-lg-6 text-center">

                    <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid hero-img" alt="Nature's Gold Honey">

                </div>

            </div>

        </div>
    </section>

    <!---hero 2 section--->
    <section class="py-5" style="background: #fffdf5;">
        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Why Choose Nature's Gold Honey?
                </h2>

                <p class="text-muted">
                    Pure. Natural. Trusted.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🍯</div>
                        <h5 class="fw-bold mt-3">100% Pure Honey</h5>
                        <p class="text-muted">
                            Naturally harvested honey with no added sugar or preservatives.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🐝</div>
                        <h5 class="fw-bold mt-3">Own Bee Farms</h5>
                        <p class="text-muted">
                            We personally maintain healthy bee colonies and harvest fresh honey.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🌿</div>
                        <h5 class="fw-bold mt-3">Chemical Free</h5>
                        <p class="text-muted">
                            No artificial colors, chemicals, or preservatives.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🧴</div>
                        <h5 class="fw-bold mt-3">Hygienic Packing</h5>
                        <p class="text-muted">
                            Packed carefully to preserve freshness and quality.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">🚚</div>
                        <h5 class="fw-bold mt-3">Fast Delivery</h5>
                        <p class="text-muted">
                            Quick and secure delivery across Hyderabad and nearby areas.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon">❤️</div>
                        <h5 class="fw-bold mt-3">Trusted Quality</h5>
                        <p class="text-muted">
                            Every jar reflects our commitment to quality and customer satisfaction.
                        </p>
                    </div>
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

    <!-- our story -->
    <section class="story-section py-5 bg-white">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <img src="{{ asset('assets/images/story1.png') }}" class="img-fluid rounded-4 shadow"
                        alt="Our Story">

                </div>

                <div class="col-lg-6">

                    <span class="badge bg-warning text-dark mb-3">
                        Our Story
                    </span>

                    <h2 class="fw-bold mb-4">
                        Bringing Pure Honey From Our Bee Farms
                    </h2>

                    <p class="text-muted">

                        Welcome to <strong>Nature's Gold Honey</strong>.

                        Our store is located in <strong>Hastinapur, Hyderabad</strong>.

                    </p>

                    <p class="text-muted">

                        We, <strong>Badrinath</strong> and <strong>Santhosh</strong>,
                        personally maintain our bee colonies and harvest fresh,
                        natural honey using ethical and sustainable beekeeping
                        practices.

                    </p>

                    <p class="text-muted">

                        Every bottle is carefully collected, filtered, and packed
                        to preserve its natural taste and nutrients.

                    </p>

                    <a href="{{ route('about') }}" class="btn btn-warning rounded-pill px-4 mt-3">

                        Read More

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="stats-section py-5">

        <div class="container">

            <div class="row text-center">

                <div class="col-lg-3 col-6 mb-4">

                    <h2>500+</h2>

                    <p>Bee Colonies</p>

                </div>

                <div class="col-lg-3 col-6 mb-4">

                    <h2>1500+</h2>

                    <p>Happy Customers</p>

                </div>

                <div class="col-lg-3 col-6 mb-4">

                    <h2>5000+</h2>

                    <p>Orders Delivered</p>

                </div>

                <div class="col-lg-3 col-6 mb-4">

                    <h2>100%</h2>

                    <p>Pure Natural Honey</p>

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
@endsection

<!-- Footer -->
