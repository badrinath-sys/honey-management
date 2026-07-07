@extends('layouts.frontend')

@section('title', 'Search')

@section('content')

    <div class="container py-5">

        <h2 class="fw-bold mb-4">

            Search Results :
            <span class="text-warning">
                "{{ $keyword }}"
            </span>

        </h2>

        <div class="row">

            @forelse($products as $product)
                @include('partials.product-card')

            @empty

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        No Products Found.

                    </div>

                </div>
            @endforelse

        </div>

        <div class="mt-4">

            {{ $products->links() }}

        </div>

    </div>

@endsection
