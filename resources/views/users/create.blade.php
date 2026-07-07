@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">
                    <i class="bi bi-person-plus-fill"></i>
                    Add New User
                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Full Name</label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Email</label>

                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Password</label>

                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Confirm Password</label>

                            <input type="password" name="password_confirmation" class="form-control" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Role</label>

                            <select name="role" class="form-select" required>

                                <option value="">Select Role</option>

                                <option value="Admin">Admin</option>

                                <option value="Staff">Staff</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <button class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Save User

                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
