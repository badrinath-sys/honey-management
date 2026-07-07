@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow">

                    <div class="card-header bg-danger text-white">

                        <h4 class="mb-0">

                            <i class="bi bi-key-fill"></i>

                            Change Password

                        </h4>

                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">

                                {{ session('success') }}

                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">

                                <label class="form-label">

                                    Current Password

                                </label>

                                <input type="password" name="current_password" class="form-control">

                                @error('current_password')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    New Password

                                </label>

                                <input type="password" name="password" class="form-control">

                                @error('password')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Confirm Password

                                </label>

                                <input type="password" name="password_confirmation" class="form-control">

                            </div>

                            <button class="btn btn-danger">

                                <i class="bi bi-shield-lock"></i>

                                Change Password

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
