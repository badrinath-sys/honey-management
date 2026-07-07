<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Honey ERP</title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Chart.js -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            overflow-x: hidden;
            background: #f5f6fa;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .footer {
            background: #fff;
            border-top: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>

</head>

<body>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="main-content">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg bg-white">

            <div class="container-fluid">

                <span class="navbar-brand fw-bold">

                    🍯 Honey Management System

                </span>

                <div class="ms-auto">

                    <div class="dropdown">

                        <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle"></i>

                            {{ auth()->user()->name }}

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item" href="{{ route('profile.index') }}">

                                    <i class="bi bi-person"></i>

                                    My Profile

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item" href="{{ route('password.index') }}">

                                    <i class="bi bi-key"></i>

                                    Change Password

                                </a>

                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <form action="{{ route('logout') }}" method="POST">

                                    @csrf

                                    <button class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right"></i>

                                        Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>

        {{-- Success Message --}}

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    Swal.fire({

                        icon: 'success',

                        title: 'Success',

                        text: '{{ session('success') }}',

                        timer: 2000,

                        showConfirmButton: false

                    });

                });
            </script>
        @endif

        <div class="container-fluid mt-4">

            @yield('content')

        </div>

        <div class="footer">

            © {{ date('Y') }} Honey ERP | Developed with Laravel 12

        </div>

    </div>

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- SweetAlert -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Delete Confirmation -->

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {

            form.addEventListener('submit', function(e) {

                e.preventDefault();

                Swal.fire({

                    title: 'Are you sure?',

                    text: "You won't be able to recover this record!",

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#d33',

                    cancelButtonColor: '#3085d6',

                    confirmButtonText: 'Yes, Delete'

                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });
    </script>

    <!-- DataTable -->

    <script>
        $(document).ready(function() {

            if ($('#dataTable').length) {

                $('#dataTable').DataTable({

                    responsive: true,

                    pageLength: 10,

                    ordering: true,

                    searching: true,

                    lengthChange: true,

                    language: {

                        search: "Search : "

                    }

                });

            }

        });
    </script>
    @stack('scripts')

</body>

</html>
