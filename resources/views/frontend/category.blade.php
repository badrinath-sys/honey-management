@extends('layouts.frontend')

@section('title', $category->name)

@section('content')

    <div class="container py-5">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('shop') }}">Shop</a>
                </li>

                <li class="breadcrumb-item active">

                    {{ $category->name }}

                </li>

            </ol>

        </nav>

        {{-- Category Title --}}
        <div class="mb-4">

            <h2 class="fw-bold">

                {{ $category->name }}

            </h2>

            @if ($category->description)
                <p class="text-muted">

                    {{ $category->description }}

                </p>
            @endif

        </div>

        {{-- Products --}}
        <div class="row">

            @forelse($products as $product)
                @include('partials.product-card')

            @empty

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        No Products Found In This Category.

                    </div>

                </div>
            @endforelse

        </div>

        <div class="mt-4">

            {{ $products->links() }}

        </div>

    </div>

@endsection
