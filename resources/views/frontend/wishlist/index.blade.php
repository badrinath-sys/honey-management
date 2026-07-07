@extends('layouts.frontend')

@section('title', 'My Wishlist')

@section('content')

    <div class="container py-5">

        <h2 class="fw-bold mb-4">
            ❤️ My Wishlist
        </h2>

        @if ($items->count())

            <div class="row">

                @foreach ($items as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card shadow-sm h-100">

                            <img src="{{ asset('assets/images/products/' . $item->product->image) }}" class="card-img-top"
                                style="height:220px;object-fit:cover;">

                            <div class="card-body">

                                <h5>{{ $item->product->name }}</h5>

                                <h4 class="text-success">
                                    ₹{{ number_format($item->product->price, 2) }}
                                </h4>

                            </div>

                            <div class="card-footer bg-white">

                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST">

                                    @csrf

                                    <button class="btn btn-success w-100 mb-2">

                                        <i class="fa fa-shopping-cart"></i>

                                        Add To Cart

                                    </button>

                                </form>

                                <a href="{{ route('wishlist.remove', $item->product->id) }}" class="btn btn-danger w-100">

                                    <i class="fa fa-trash"></i>

                                    Remove

                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="alert alert-warning text-center">

                <h4>Your Wishlist is Empty ❤️</h4>

                <a href="{{ route('shop') }}" class="btn btn-warning mt-3">

                    Continue Shopping

                </a>

            </div>

        @endif

    </div>

@endsection
