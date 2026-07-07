<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white vh-100 position-fixed shadow"
    style="width:250px; overflow-y:auto;">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">

        <i class="bi bi-shop fs-3 me-2 text-warning"></i>

        <span class="fs-4 fw-bold">
            Honey ERP
        </span>

    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

        <!-- Dashboard -->
        <li class="mb-2">

            <a href="{{ route('dashboard') }}"
                class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-primary' : '' }}">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

        </li>

        @if (auth()->user()->role == 'Admin')
            <!-- Categories -->
            <li class="mb-2">

                <a href="{{ route('categories.index') }}"
                    class="nav-link text-white {{ request()->routeIs('categories.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-grid me-2"></i>

                    Categories

                </a>

            </li>

            <!-- Products -->
            <li class="mb-2">

                <a href="{{ route('products.index') }}"
                    class="nav-link text-white {{ request()->routeIs('products.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-box-seam me-2"></i>

                    Products

                </a>

            </li>
            <li class="mb-2">

                <a href="{{ route('galleries.index') }}"
                    class="nav-link text-white {{ request()->routeIs('galleries.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-images me-2"></i>

                    Gallery

                </a>

            </li>

            <!-- Suppliers -->
            <li class="mb-2">

                <a href="{{ route('suppliers.index') }}"
                    class="nav-link text-white {{ request()->routeIs('suppliers.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-truck me-2"></i>

                    Suppliers

                </a>

            </li>
        @endif

        <!-- Customers -->
        <li class="mb-2">

            <a href="{{ route('customers.index') }}"
                class="nav-link text-white {{ request()->routeIs('customers.*') ? 'active bg-primary' : '' }}">

                <i class="bi bi-people me-2"></i>

                Customers

            </a>

        </li>

        <!-- Orders -->
        <li class="mb-2">

            <a href="{{ route('orders.index') }}"
                class="nav-link text-white {{ request()->routeIs('orders.*') ? 'active bg-primary' : '' }}">

                <i class="bi bi-cart-check me-2"></i>

                Orders

            </a>

        </li>

        @if (auth()->user()->role == 'Admin')
            <!-- Reports -->
            <li class="mb-2">

                <a href="{{ route('reports.sales') }}"
                    class="nav-link text-white {{ request()->routeIs('reports.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-bar-chart-line me-2"></i>

                    Reports

                </a>

            </li>

            <!-- User Management -->
            <li class="mb-2">

                <a href="{{ route('users.index') }}"
                    class="nav-link text-white {{ request()->routeIs('users.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-person-gear me-2"></i>

                    User Management

                </a>

            </li>

            <!-- Backup -->

            <!-- Settings -->
            <li class="mb-2">

                <a href="{{ route('settings.index') }}"
                    class="nav-link text-white {{ request()->routeIs('settings.*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-gear me-2"></i>

                    Settings

                </a>

            </li>
        @endif

    </ul>

    <hr>

    <!-- Logged User -->

    <div class="text-center mb-3">

        <i class="bi bi-person-circle fs-1"></i>

        <h6 class="mt-2 mb-1">
            {{ auth()->user()->name }}
        </h6>

        @if (auth()->user()->role == 'Admin')
            <span class="badge bg-danger">
                Admin
            </span>
        @else
            <span class="badge bg-info">
                Staff
            </span>
        @endif

    </div>

    <!-- Logout -->

    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button class="btn btn-danger w-100">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </button>

    </form>

</div>
