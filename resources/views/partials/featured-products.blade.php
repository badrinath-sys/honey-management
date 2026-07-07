<section class="py-5 bg-light">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="fw-bold">
                Featured Products
            </h2>

            <a href="/products" class="btn btn-outline-warning">
                View All
            </a>

        </div>

        <div class="row">

            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-6 mb-4">

                    <div class="card border-0 shadow-sm h-100 product-card">

                        <div class="position-relative">
                            <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top p-3"
                                style="height:220px;object-fit:contain;" alt="{{ $product->name }}">

                            <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                In Stock
                            </span>

                        </div>

                        <div class="card-body">

                            <h5 class="card-title">

                                {{ $product->name }}

                            </h5>

                            <small class="text-muted">

                                {{ $product->weight }}

                            </small>

                            <h4 class="text-warning mt-3">

                                ₹{{ number_format($product->price, 2) }}

                            </h4>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <div class="d-grid gap-2">

                                <a href="/product/{{ $product->id }}" class="btn btn-outline-dark">

                                    View Details

                                </a>

                                <button class="btn btn-warning add-cart" data-id="{{ $product->id }}">

                                    <i class="fa fa-cart-plus"></i>

                                    Add To Cart

                                </button>
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

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">

                        Products Not Available

                    </div>

                </div>
            @endforelse

        </div>

    </div>

</section>
