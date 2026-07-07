@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Add Expense</h2>

            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('expenses.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">Expense Title</label>

                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">

                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Amount</label>

                        <input type="number" step="0.01" name="amount" class="form-control"
                            value="{{ old('amount') }}">

                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Expense Date</label>

                        <input type="date" name="expense_date" class="form-control"
                            value="{{ old('expense_date', date('Y-m-d')) }}">

                        @error('expense_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <button class="btn btn-primary">

                        Save Expense

                    </button>

                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
