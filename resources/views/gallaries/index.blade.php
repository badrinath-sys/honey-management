@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            Gallery Management
        </h3>

        <a href="{{ route('galleries.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Add Image

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover" id="dataTable">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>Image</th>

                        <th>Title</th>

                        <th>Sort Order</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($galleries as $gallery)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>

                                <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" width="80"
                                    class="rounded shadow">

                            </td>

                            <td>{{ $gallery->title }}</td>

                            <td>{{ $gallery->sort_order }}</td>

                            <td>

                                @if ($gallery->status)
                                    <span class="badge bg-success">

                                        Active

                                    </span>
                                @else
                                    <span class="badge bg-danger">

                                        Inactive

                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ route('galleries.destroy', $gallery) }}" method="POST"
                                    class="d-inline delete-form">

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
