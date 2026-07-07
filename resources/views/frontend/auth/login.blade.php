@extends('layouts.frontend')

@section('content')
    <section class="py-5 bg-light">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-5">

                    <div class="card shadow border-0">

                        <div class="card-header bg-warning text-center py-3">

                            <h3 class="mb-0">

                                Customer Login

                            </h3>

                        </div>

                        <div class="card-body p-4">

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif

                            @if ($errors->has('login'))
                                <div class="alert alert-danger">

                                    {{ $errors->first('login') }}

                                </div>
                            @endif

                            <form action="{{ route('customer.login.store') }}" method="POST">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">

                                        Mobile Number / Email

                                    </label>

                                    <input type="text" name="login" class="form-control" value="{{ old('login') }}"
                                        required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Password

                                    </label>

                                    <input type="password" name="password" class="form-control" required>

                                </div>
                                <div class="mb-3 form-check">

                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">

                                    <label class="form-check-label" for="remember">

                                        Remember Me

                                    </label>

                                </div>

                                <div class="d-grid">

                                    <button type="submit" class="btn btn-warning btn-lg">

                                        <i class="fas fa-sign-in-alt"></i>

                                        Login

                                    </button>

                                </div>

                                <div class="text-center mt-4">

                                    <p class="mb-2">

                                        Don't have an account?

                                        <a href="{{ route('customer.register') }}" class="fw-bold text-decoration-none">

                                            Register Here

                                        </a>

                                    </p>

                                    <a href="#" class="text-muted text-decoration-none">

                                        Forgot Password?

                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
