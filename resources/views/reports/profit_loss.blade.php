@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Profit & Loss Report</h2>

        <div class="card mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('reports.profitloss') }}">

                    <div class="row">

                        <div class="col-md-4">

                            <label>From Date</label>

                            <input type="date" name="from" class="form-control" value="{{ $from }}">

                        </div>

                        <div class="col-md-4">

                            <label>To Date</label>

                            <input type="date" name="to" class="form-control" value="{{ $to }}">

                        </div>

                        <div class="col-md-4 d-flex align-items-end">

                            <button class="btn btn-primary me-2">

                                Filter

                            </button>

                            <a href="{{ route('reports.profitloss') }}" class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="row">

            <div class="col-md-3">

                <div class="card bg-success text-white mb-3">

                    <div class="card-body">

                        <h5>Total Sales</h5>

                        <h3>₹ {{ number_format($totalSales, 2) }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-warning text-dark mb-3">

                    <div class="card-body">

                        <h5>Total Purchase</h5>

                        <h3>₹ {{ number_format($totalPurchase, 2) }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-danger text-white mb-3">

                    <div class="card-body">

                        <h5>Total Expense</h5>

                        <h3>₹ {{ number_format($totalExpense, 2) }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card bg-info text-white mb-3">

                    <div class="card-body">

                        <h5>Gross Profit</h5>

                        <h3>₹ {{ number_format($grossProfit, 2) }}</h3>

                    </div>

                </div>

            </div>

        </div>

        <div class="card border-primary">

            <div class="card-body text-center">

                <h3>Net Profit</h3>

                @if ($netProfit >= 0)
                    <h1 class="text-success">

                        ₹ {{ number_format($netProfit, 2) }}

                    </h1>
                @else
                    <h1 class="text-danger">

                        ₹ {{ number_format($netProfit, 2) }}

                    </h1>
                @endif

            </div>

        </div>

        <div class="mt-3">

            <button onclick="window.print()" class="btn btn-dark">

                Print Report

            </button>

        </div>

    </div>
@endsection
