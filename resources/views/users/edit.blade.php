@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-warning">

                <h4 class="mb-0">

                    <i class="bi bi-pencil-square"></i>

                    Edit User

                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Name</label>

                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>New Password</label>

                            <input type="password" name="password" class="form-control">

                            <small class="text-muted">

                                Leave blank if you don't want to change it.

                            </small>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Role</label>

                            <select name="role" class="form-select">

                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>

                                    Admin

                                </option>

                                <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>

                                    Staff

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select name="status" class="form-select">

                                <option value="1" {{ $user->status ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="0" {{ !$user->status ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <button class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Update User

                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </form>

            </div>

        </div>

    </div>
@endsection
