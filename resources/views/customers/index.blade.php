@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Customers</h2>

            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Customer
            </a>
            <a href="{{ route('customers.export') }}" class="btn btn-success">

                Export Excel

            </a>

        </div>

        <!-- Search -->

        <form method="GET" action="{{ route('customers.index') }}" class="mb-4">

            <div class="row">

                <div class="col-md-10">

                    <input type="text" name="search" class="form-control" placeholder="Search Name / Phone / Email"
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        Search

                    </button>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table id="dataTable" class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Phone</th>

                        <th>Email</th>

                        <th>Status</th>

                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)
                        <tr>

                            <td>{{ $customer->id }}</td>

                            <td>{{ $customer->name }}</td>

                            <td>{{ $customer->phone }}</td>

                            <td>{{ $customer->email ?? '-' }}</td>

                            <td>

                                @if ($customer->status)
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

                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i> Edit

                                </a>

                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this customer?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i> Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                No Customers Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $customers->links() }}

        </div>

    </div>
@endsection
