@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Create Purchase</h2>

            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('purchases.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">Supplier</label>

                        <select name="supplier_id" class="form-control">

                            <option value="">Select Supplier</option>

                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>

                                    {{ $supplier->name }}

                                </option>
                            @endforeach

                        </select>

                        @error('supplier_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Purchase Date</label>

                        <input type="date" name="purchase_date" class="form-control"
                            value="{{ old('purchase_date', date('Y-m-d')) }}">

                        @error('purchase_date')
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

                    <button type="submit" class="btn btn-primary">

                        Next

                    </button>

                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
