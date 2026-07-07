@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Edit Expense</h2>

            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">Expense Title</label>

                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $expense->title) }}">

                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Amount</label>

                        <input type="number" step="0.01" name="amount" class="form-control"
                            value="{{ old('amount', $expense->amount) }}">

                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Expense Date</label>

                        <input type="date" name="expense_date" class="form-control"
                            value="{{ old('expense_date', $expense->expense_date) }}">

                        @error('expense_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $expense->description) }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <button class="btn btn-success">

                        Update Expense

                    </button>

                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
