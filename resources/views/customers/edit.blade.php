@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Edit Customer</h2>

            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
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

            <div class="card-body">

                <form action="{{ route('customers.update', $customer->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">Customer Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Phone Number</label>

                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $customer->phone) }}">

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Email</label>

                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $customer->email) }}">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Address</label>

                        <textarea name="address" rows="3" class="form-control">{{ old('address', $customer->address) }}</textarea>

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-control">

                            <option value="1" {{ old('status', $customer->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', $customer->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mt-4">

                        <button class="btn btn-success">
                            <i class="fas fa-save"></i> Update Customer
                        </button>

                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
