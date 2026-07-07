@extends('adminlte::page')

@section('title', 'Sales Report')

@section('content_header')
    <h1>Sales Report</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-header">

            <form method="GET" action="{{ route('reports.sales') }}">

                <div class="row">

                    <div class="col-md-3">
                        <label>From Date</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>

                    <div class="col-md-3">
                        <label>To Date</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>

                    <div class="col-md-2 mt-4">

                        <button class="btn btn-primary">

                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="small-box bg-success">

        <div class="inner">

            <h3>₹ {{ number_format($totalSales, 2) }}</h3>

            <p>Total Sales</p>

        </div>

        <div class="icon">

            <i class="fas fa-indian-rupee-sign"></i>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            Sales Report

        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Customer</th>

                        <th>Date</th>

                        <th>Total</th>

                        <th>Payment</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)
                        <tr>

                            <td>{{ $order->id }}</td>

                            <td>{{ $order->customer->name }}</td>

                            <td>{{ $order->order_date }}</td>

                            <td>₹ {{ number_format($order->total_amount, 2) }}</td>

                            <td>

                                <span class="badge bg-success">

                                    {{ $order->payment_status }}

                                </span>

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $order->order_status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                No Records Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

@stop
