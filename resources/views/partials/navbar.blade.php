<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" height="45" alt="">
            Nature's Gold<br> Honey
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainMenu">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">

                        Categories

                    </a>

                    <ul class="dropdown-menu">

                        @foreach (\App\Models\Category::where('status', 1)->orderBy('name')->get() as $category)
                            <li>

                                <a class="dropdown-item" href="{{ route('shop.category', $category->slug) }}">

                                    {{ $category->name }}

                                </a>

                            </li>
                        @endforeach

                    </ul>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('offers') }}">

                        🔥 Offers

                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">
                        Gallery
                    </a>
                </li>

            </ul>
            <form action="{{ route('search') }}" method="GET" class="d-flex me-3">

                <div class="input-group">

                    <input type="text" name="search" class="form-control border-warning rounded-start-pill"
                        placeholder="Search Products..." value="{{ request('search') }}">

                    <button class="btn btn-warning rounded-end-pill px-4">
                        <i class="fa fa-search"></i>
                    </button>

                </div>

            </form>
            <a href="{{ route('cart') }}" class="btn btn-warning position-relative me-3 rounded-pill">

                <i class="fa-solid fa-cart-shopping"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart', [])) }}
                </span>

            </a>
            @if (Auth::guard('customer')->check())
                <a href="{{ route('wishlist.index') }}" class="btn btn-outline-danger position-relative rounded-pill">

                    <i class="fa fa-heart"></i>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $wishlistCount ?? 0 }}
                    </span>

                </a>
            @endif

        </div>
        @if (Auth::guard('customer')->check())
            <div class="dropdown ms-3">

                <button class="btn btn-outline-dark dropdown-toggle rounded-pill" data-bs-toggle="dropdown">

                    <i class="fa fa-user-circle"></i>

                    {{ Auth::guard('customer')->user()->name }}

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="{{ route('customer.dashboard') }}">

                            <i class="fa fa-home me-2"></i>

                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('customer.orders') }}">

                            <i class="fa fa-box me-2"></i>

                            My Orders
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('wishlist.index') }}">

                            <i class="fa fa-heart me-2"></i>

                            Wishlist
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('customer.profile') }}">

                            <i class="fa fa-user me-2"></i>

                            Edit Profile
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form action="{{ route('customer.logout') }}" method="POST">

                            @csrf

                            <button class="dropdown-item text-danger">

                                <i class="fa fa-sign-out-alt me-2"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>
        @else
            <div class="ms-3">

                <a href="{{ route('customer.login') }}" class="btn btn-outline-primary rounded-pill">

                    Login

                </a>

            </div>
        @endif

    </div>
</nav>
