@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2>Dashboard</h2>

                <p class="text-muted">
                    Welcome {{ auth()->user()->name }}
                </p>

            </div>

            <div>

                <h5>{{ now()->format('d M Y') }}</h5>

            </div>

        </div>

        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card text-white shadow-lg border-0"
                style="background:linear-gradient(135deg,#4e73df,#224abe); border-radius:15px;">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-uppercase">Products</h6>

                            <h2>{{ $totalProducts }}</h2>

                        </div>

                        <i class="bi bi-box-seam fs-1"></i>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card text-white shadow-lg border-0"
                style="background:linear-gradient(135deg,#1cc88a,#13855c); border-radius:15px;">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6>Categories</h6>

                            <h2>{{ $totalCategories }}</h2>

                        </div>

                        <i class="bi bi-grid fs-1"></i>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card text-white shadow-lg border-0"
                style="background:linear-gradient(135deg,#36b9cc,#258391); border-radius:15px;">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Customers</h6>

                            <h2>{{ $totalCustomers }}</h2>

                        </div>

                        <i class="bi bi-people fs-1"></i>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4 mb-3">

            <div class="card bg-info text-white shadow">

                <div class="card-body">

                    <h5>Total Suppliers</h5>

                    <h2>{{ $totalSuppliers }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card text-white shadow-lg border-0"
                style="background:linear-gradient(135deg,#f6c23e,#dda20a); border-radius:15px;">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h6>Orders</h6>

                            <h2>{{ $totalOrders }}</h2>

                        </div>

                        <i class="bi bi-cart-check fs-1"></i>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4 mb-3">

            <div class="card bg-dark text-white shadow">

                <div class="card-body">

                    <h5>Total Revenue</h5>

                    <h2>₹ {{ number_format($totalRevenue, 2) }}</h2>

                </div>

            </div>

        </div>

    </div>
    <div class="row mt-4">

        <!-- Recent Orders -->

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">Recent Orders</h5>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Customer</th>

                                <th>Date</th>

                                <th>Total</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentOrders as $order)
                                <tr>

                                    <td>{{ $order->id }}</td>

                                    <td>{{ $order->customer->name ?? '-' }}</td>

                                    <td>{{ $order->order_date }}</td>

                                    <td>₹ {{ number_format($order->total_amount, 2) }}</td>

                                    <td>

                                        @if ($order->order_status == 'Completed')
                                            <span class="badge bg-success">
                                                {{ $order->order_status }}
                                            </span>
                                        @elseif($order->order_status == 'Pending')
                                            <span class="badge bg-warning text-dark">
                                                {{ $order->order_status }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                {{ $order->order_status }}
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center">

                                        No Orders Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Low Stock -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-danger text-white">

                    <h5 class="mb-0">

                        Low Stock Products

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-sm table-bordered">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Qty</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($lowStockProducts as $product)
                                <tr>

                                    <td>{{ $product->name }}</td>

                                    <td>

                                        <span class="badge bg-danger">

                                            {{ $product->quantity }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="2" class="text-center">

                                        No Low Stock

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    <div class="row mt-4">

        <div class="col-lg-12">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        Monthly Sales Report

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="salesChart" height="100"></canvas>

                </div>

            </div>

        </div>

    </div>

    <script>
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: [

                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',

                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'

                ],

                datasets: [{

                    label: 'Sales (₹)',

                    data: @json($monthlySales),

                    borderWidth: 1

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: true

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });
    </script>
@endsection
