@extends('layouts.frontend')

@section('title', "Today's Offers")

@section('content')

    <div class="container py-5">

        <h2 class="fw-bold text-danger mb-4">
            🔥 Today's Offers
        </h2>

        <div class="row">

            @forelse($products as $product)
                @include('partials.product-card')

            @empty

                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No Offers Available.
                    </div>
                </div>
            @endforelse

        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>

@endsection
