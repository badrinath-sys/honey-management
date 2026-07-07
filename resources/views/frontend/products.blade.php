@extends('layouts.frontend')

@section('title', 'Shop')

@section('content')

    <div class="container py-5">

        <h2 class="fw-bold mb-4">

            All Products

        </h2>

        <div class="row">

            @foreach ($products as $product)
                @include('partials.product-card')
            @endforeach

        </div>

        <div class="mt-4">

            {{ $products->links() }}

        </div>

    </div>

@endsection
