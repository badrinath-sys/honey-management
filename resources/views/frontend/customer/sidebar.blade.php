<div class="list-group shadow rounded">

    <a href="{{ route('customer.dashboard') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">

        <i class="fa fa-home me-2"></i>
        Dashboard

    </a>

    <a href="{{ route('my.orders') }}" class="list-group-item list-group-item-action">

        <i class="fa fa-box me-2"></i>
        My Orders

    </a>

    <a href="{{ route('wishlist.index') }}" class="list-group-item list-group-item-action">

        <i class="fa fa-heart me-2"></i>
        Wishlist

    </a>

    <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action">

        <i class="fa fa-user me-2"></i>
        Edit Profile

    </a>

    <a href="{{ route('customer.password') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('customer.password*') ? 'active' : '' }}">

        <i class="fa fa-lock me-2"></i>

        Change Password

    </a>
    <a href="{{ route('customer.orders') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">

        <i class="fa fa-box me-2"></i>

        My Orders

    </a>

    <a href="{{ route('customer.addresses') }}" class="list-group-item list-group-item-action">

        <i class="fa fa-location-dot me-2"></i>
        Address Book

    </a>

    <form action="{{ route('customer.logout') }}" method="POST">

        @csrf

        <button class="list-group-item list-group-item-action text-danger w-100 text-start">

            <i class="fa fa-sign-out-alt me-2"></i>

            Logout

        </button>

    </form>

</div>
