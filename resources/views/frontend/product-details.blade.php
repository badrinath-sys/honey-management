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

                    <button type="submit" class="btn btn-warning w-10">

                        <i class="fas fa-shopping-cart"></i>

                        Add To Cart

                    </button>

                </form><br>

                <button class="btn btn-success btn-lg">

                    Buy Now

                </button>

            </div>

        </div>

    </div>

@endsection
