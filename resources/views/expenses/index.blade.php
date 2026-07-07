@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            <h2>Expenses</h2>

            <a href="{{ route('expenses.create') }}" class="btn btn-primary">

                Add Expense

            </a>

        </div>

        <form method="GET" action="{{ route('expenses.index') }}" class="mb-3">

            <div class="row">

                <div class="col-md-4">

                    <input type="text" name="search" class="form-control" placeholder="Search Expense..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">

                        Search

                    </button>

                </div>

                <div class="col-md-2">

                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Title</th>

                    <th>Amount</th>

                    <th>Date</th>

                    <th>Description</th>

                    <th width="170">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($expenses as $expense)
                    <tr>

                        <td>{{ $expense->id }}</td>

                        <td>{{ $expense->title }}</td>

                        <td>₹ {{ number_format($expense->amount, 2) }}</td>

                        <td>{{ date('d-m-Y', strtotime($expense->expense_date)) }}</td>

                        <td>{{ $expense->description }}</td>

                        <td>

                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete Expense?')">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            No Expenses Found

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        {{ $expenses->links() }}

    </div>
@endsection
