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

            <h2>Purchases</h2>

            <a href="{{ route('purchases.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>

                New Purchase

            </a>

        </div>

        <table id="dataTable" class="table table-bordered table-striped table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Supplier</th>

                    <th>Date</th>

                    <th>Total Amount</th>

                    <th>Payment</th>

                    <th width="220">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($purchases as $purchase)
                    <tr>

                        <td>{{ $purchase->id }}</td>

                        <td>{{ $purchase->supplier->name }}</td>

                        <td>{{ date('d-m-Y', strtotime($purchase->purchase_date)) }}</td>

                        <td>

                            ₹ {{ number_format($purchase->total_amount, 2) }}

                        </td>

                        <td>

                            @if ($purchase->payment_status == 'Paid')
                                <span class="badge bg-success">

                                    Paid

                                </span>
                            @else
                                <span class="badge bg-warning text-dark">

                                    Pending

                                </span>
                            @endif

                        </td>

                        <td>

                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete Purchase?')">

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

                            No Purchases Found

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        {{ $purchases->links() }}

    </div>
@endsection
