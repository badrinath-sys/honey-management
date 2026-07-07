<div class="col-lg-3 col-md-4 col-sm-6 mb-4">

    <div class="card h-100 shadow-sm border-0">

        {{-- Product Image --}}
        <a href="{{ route('product.details', $product->slug) }}">

            @if ($product->image)
                <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top"
                    style="height:220px; object-fit:cover;" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/300x220?text=No+Image" class="card-img-top"
                    style="height:220px; object-fit:cover;">
            @endif

        </a>
        @if ($product->is_offer)
            <span class="badge bg-danger position-absolute m-2">

                🔥 OFFER

            </span>
        @endif

        <div class="card-body d-flex flex-column">

            {{-- Product Name --}}
            <h5 class="card-title">
                {{ $product->name }}
            </h5>

            {{-- Category --}}
            @if ($product->category)
                <small class="text-muted">
                    {{ $product->category->name }}
                </small>
            @endif

            {{-- Price --}}
            @if ($product->is_offer && $product->offer_price)
                <h5>

                    <span class="text-danger fw-bold">

                        ₹{{ $product->offer_price }}

                    </span>

                    <del class="text-muted">

                        ₹{{ $product->price }}

                    </del>

                </h5>
            @else
                <h5 class="text-success">

                    ₹{{ $product->price }}

                </h5>
            @endif

            <div class="mt-auto">

                {{-- View Details --}}
                <a href="{{ route('product.details', $product->slug) }}" class="btn btn-warning w-100 mb-2">

                    <i class="fa fa-eye"></i>

                    View Details

                </a>

                {{-- Add To Cart --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">

                    @csrf

                    <button class="btn btn-success w-100 mb-2">

                        <i class="fa fa-shopping-cart"></i>

                        Add To Cart

                    </button>

                </form>

                {{-- Wishlist --}}
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
