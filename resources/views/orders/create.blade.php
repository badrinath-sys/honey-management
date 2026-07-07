@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Create Order</h2>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('orders.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">Customer</label>

                        <select name="customer_id" class="form-control">

                            <option value="">Select Customer</option>

                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                                    {{ $customer->name }}

                                </option>
                            @endforeach

                        </select>

                        @error('customer_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Order Date</label>

                        <input type="date" name="order_date" class="form-control"
                            value="{{ old('order_date', date('Y-m-d')) }}">

                        @error('order_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Payment Status</label>

                        <select name="payment_status" class="form-control">

                            <option value="Pending" {{ old('payment_status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Paid" {{ old('payment_status') == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                        </select>

                        @error('payment_status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Order Status</label>

                        <select name="order_status" class="form-control">

                            <option value="Pending" {{ old('order_status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Processing" {{ old('order_status') == 'Processing' ? 'selected' : '' }}>
                                Processing
                            </option>

                            <option value="Completed" {{ old('order_status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="Cancelled" {{ old('order_status') == 'Cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                        @error('order_status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i> Next
                        </button>

                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
