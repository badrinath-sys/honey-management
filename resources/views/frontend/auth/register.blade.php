@extends('layouts.frontend')

@section('content')
    <section class="py-5 bg-light">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-6">

                    <div class="card shadow border-0">

                        <div class="card-header bg-warning text-center py-3">

                            <h3 class="mb-0">

                                Customer Registration

                            </h3>

                        </div>

                        <div class="card-body p-4">

                            @if (session('success'))
                                <div class="alert alert-success">

                                    {{ session('success') }}

                                </div>
                            @endif

                            <form action="{{ route('customer.register.store') }}" method="POST">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">

                                        Full Name

                                    </label>

                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required>

                                    @error('name')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Mobile Number

                                    </label>

                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" required>

                                    @error('phone')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>
                                <div class="mb-3">

                                    <label class="form-label">

                                        Email Address

                                    </label>

                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">

                                    @error('email')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Password

                                    </label>

                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>

                                    @error('password')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Confirm Password

                                    </label>

                                    <input type="password" name="password_confirmation" class="form-control" required>

                                </div>
                                <div class="d-grid">

                                    <button type="submit" class="btn btn-warning btn-lg">

                                        <i class="fas fa-user-plus"></i>

                                        Create Account

                                    </button>

                                </div>

                                <div class="text-center mt-4">

                                    <p class="mb-0">

                                        Already have an account?

                                        <a href="{{ route('customer.login') }}" class="fw-bold text-decoration-none">

                                            Login Here

                                        </a>

                                    </p>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
