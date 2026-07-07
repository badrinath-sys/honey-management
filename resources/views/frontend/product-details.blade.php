@extends('layouts.frontend')

@section('title', $product->name)

@section('content')

    <div class="container py-5">

        <div class="row">

            <!-- Product Image -->
            <div class="col-lg-6">

                <div class="card shadow-sm border-0">

                    <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top p-3"
                        style="height:220px;object-fit:contain;" alt="{{ $product->name }}">
                </div>

            </div>

            <!-- Product Info -->
            <div class="col-lg-6">

                <h2 class="fw-bold">{{ $product->name }}</h2>

                <p class="text-muted">
                    {{ $product->description }}
                </p>

                <h3 class="text-warning">
                    ₹{{ number_format($product->price, 2) }}
                </h3>

                <span class="badge bg-success">
                    In Stock : {{ $product->stock }}
                </span>

                <hr>

                <div class="d-flex align-items-center mb-4">

                    <label class="me-3 fw-bold">
                        Quantity
                    </label>

                    <input type="number" class="form-control" value="1" min="1" style="width:100px;">

                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">

                    @csrf

                    <button type="submit" class="btn btn-warning w-100">

                        <i class="fas fa-shopping-cart"></i>

                        Add To Cart

                    </button>

                </form>

                <button class="btn btn-success btn-lg">

                    Buy Now

                </button>

            </div>

        </div>

    </div>

    <!-- Related Products -->

    <div class="container pb-5">

        <h3 class="fw-bold mb-4">

            Related Products

        </h3>

        <div class="row">

            @foreach ($relatedProducts as $item)
                <div class="col-md-3 mb-4">

                    <div class="card h-100 shadow-sm border-0">

                        <img src="{{ asset('assets/images/products/' . $product->image) }}" class="card-img-top p-3"
                            style="height:220px;object-fit:contain;" alt="{{ $product->name }}">
                        <div class="card-body">

                            <h5>{{ $item->name }}</h5>

                            <h5 class="text-warning">

                                ₹{{ $item->price }}

                            </h5>

                            <a href="{{ route('product.show', $item->id) }}" class="btn btn-outline-warning w-100">

                                View

                            </a>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

@endsection
