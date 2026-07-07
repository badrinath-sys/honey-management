@extends('layouts.frontend')

@section('title', 'Gallery')

@section('content')

    <div class="container py-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Our Gallery
            </h2>

            <p class="text-muted">
                Nature's Gold Honey Collection
            </p>

        </div>

        <div class="row">

            @forelse($galleries as $gallery)
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow border-0 h-100">

                        <a href="{{ asset('uploads/gallery/' . $gallery->image) }}" target="_blank">

                            <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" class="card-img-top"
                                style="height:250px;object-fit:cover;">

                        </a>

                        <div class="card-body text-center">

                            <h5>

                                {{ $gallery->title }}

                            </h5>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        No Gallery Images Found.

                    </div>

                </div>
            @endforelse

        </div>

    </div>

@endsection
