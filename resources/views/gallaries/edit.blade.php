@extends('layouts.master')

@section('content')
    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>Edit Gallery Image</h4>

            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">Title</label>

                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Current Image</label><br>

                    <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" width="180" class="img-thumbnail">

                </div>

                <div class="mb-3">

                    <label class="form-label">Change Image</label>

                    <input type="file" name="image" class="form-control">

                    <small class="text-muted">
                        Leave blank to keep current image.
                    </small>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">Sort Order</label>

                        <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1" {{ $gallery->status ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ !$gallery->status ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>

                        Update

                    </button>

                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
