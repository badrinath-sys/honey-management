<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Nature\'s Gold Honey')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">

</head>

<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.navbar')

    <main>

        @yield('content')

    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/frontend.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({

                icon: 'success',

                title: 'Success',

                text: '{{ session('success') }}',

                timer: 1800,

                showConfirmButton: false

            });
        </script>
    @endif

</body>

</html>
