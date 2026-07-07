@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Add Product</h3>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Product Information</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <!-- Category -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Category <span class="text-danger">*</span></label>

                            <select name="category_id" class="form-select">

                                <option value="">Select Category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>
                                @endforeach

                            </select>

                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Product Name <span class="text-danger">*</span></label>

                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Slug -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Slug</label>

                            <input type="text" name="slug" id="slug" class="form-control"
                                value="{{ old('slug') }}">

                        </div>

                        <!-- SKU -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">SKU</label>

                            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">

                        </div>

                        <!-- Barcode -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Barcode</label>

                            <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">Pricing</h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Purchase Price</label>

                            <input type="number" step="0.01" name="purchase_price" class="form-control"
                                value="{{ old('purchase_price') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">MRP</label>

                            <input type="number" step="0.01" name="mrp" class="form-control"
                                value="{{ old('mrp') }}">

                        </div>
                        <div class="row">

                            <div class="col-md-4">

                                <label class="form-label">Offer Product</label>

                                <select name="is_offer" class="form-select">

                                    <option value="0">No</option>

                                    <option value="1">Yes</option>

                                </select>

                            </div>

                            <div class="col-md-4">

                                <label class="form-label">Offer Price</label>

                                <input type="number" step="0.01" name="offer_price" class="form-control">

                            </div>

                            <div class="col-md-4">

                                <label class="form-label">Offer End Date</label>

                                <input type="date" name="offer_end_date" class="form-control">

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Selling Price</label>

                            <input type="number" step="0.01" name="price" class="form-control"
                                value="{{ old('price') }}">

                        </div>

                    </div>
                    <hr>

                    <h5 class="mb-3">Inventory</h5>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}">

                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Minimum Stock</label>
                            <input type="number" name="minimum_stock" class="form-control"
                                value="{{ old('minimum_stock', 5) }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Weight</label>
                            <input type="text" name="weight" class="form-control" placeholder="500"
                                value="{{ old('weight') }}">

                            @error('weight')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Unit</label>

                            <select name="unit" class="form-select">

                                <option value="gm" {{ old('unit') == 'gm' ? 'selected' : '' }}>gm</option>

                                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>kg</option>

                                <option value="ml" {{ old('unit') == 'ml' ? 'selected' : '' }}>ml</option>

                                <option value="ltr" {{ old('unit') == 'ltr' ? 'selected' : '' }}>ltr</option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">Description</h5>

                    <div class="mb-3">

                        <label class="form-label">Short Description</label>

                        <textarea name="short_description" rows="2" class="form-control">{{ old('short_description') }}</textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Description</label>

                        <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <hr>

                    <h5 class="mb-3">Product Image</h5>

                    <div class="row">

                        <div class="col-md-6">

                            <input type="file" name="image" id="image" class="form-control">

                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <img id="preview" src="{{ asset('assets/images/no-image.png') }}" class="img-thumbnail"
                                style="height:180px;">

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">Options</h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_featured" value="1">

                                <label class="form-check-label">

                                    Featured Product

                                </label>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_best_seller" value="1">

                                <label class="form-check-label">

                                    Best Seller

                                </label>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="text-end">

                        <a href="{{ route('products.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Save Product

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        // Auto Slug Generate
        document.getElementById('name').addEventListener('keyup', function() {

            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');

            document.getElementById('slug').value = slug;

        });


        // Image Preview
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
