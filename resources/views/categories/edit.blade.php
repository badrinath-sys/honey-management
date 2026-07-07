@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3>Edit Category</h3>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">Edit Category</h5>

            </div>

            <div class="card-body">

                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Category Name

                            </label>

                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $category->name) }}">

                            @error('name')
                                <small class="text-danger">

                                    {{ $message }}

                                </small>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Slug

                            </label>

                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ old('slug', $category->slug) }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $category->sort_order) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>
                    <hr>

                    <h5 class="mb-3">Category Description</h5>

                    <div class="mb-3">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea name="description" rows="5" class="form-control">{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <small class="text-danger">

                                {{ $message }}

                            </small>
                        @enderror

                    </div>

                    <hr>

                    <h5 class="mb-3">Category Image</h5>

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">

                                Upload New Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control">

                            @error('image')
                                <small class="text-danger">

                                    {{ $message }}

                                </small>
                            @enderror

                        </div>

                        <div class="col-md-6 text-center">

                            <label class="form-label d-block">

                                Current Image

                            </label>

                            @if ($category->image)
                                <img id="preview" src="{{ asset('assets/images/categories/' . $category->image) }}"
                                    class="img-thumbnail" style="height:180px;width:180px;object-fit:contain;">
                            @else
                                <img id="preview" src="{{ asset('assets/images/no-image.png') }}" class="img-thumbnail"
                                    style="height:180px;width:180px;object-fit:contain;">
                            @endif

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('categories.index') }}" class="btn btn-secondary me-2">

                            <i class="fas fa-times"></i>

                            Cancel

                        </a>

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Category

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // ===========================
        // Auto Slug Generate
        // ===========================

        document.getElementById('name').addEventListener('keyup', function() {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');

            document.getElementById('slug').value = slug;

        });


        // ===========================
        // Image Preview
        // ===========================

        document.getElementById('image').addEventListener('change', function(e) {

            if (e.target.files.length > 0) {

                let reader = new FileReader();

                reader.onload = function(event) {

                    document.getElementById('preview').src = event.target.result;

                }

                reader.readAsDataURL(e.target.files[0]);

            }

        });
    </script>
@endpush
