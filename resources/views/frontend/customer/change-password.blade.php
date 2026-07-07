@extends('layouts.frontend')

@section('title', 'Change Password')

@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">

                @include('frontend.customer.sidebar')

            </div>

            <div class="col-lg-9">

                <div class="card shadow">

                    <div class="card-header">

                        <h4>Change Password</h4>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('customer.password.update') }}" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label>Current Password</label>

                                <input type="password" name="current_password" class="form-control">

                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label>New Password</label>

                                <input type="password" name="password" class="form-control">

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label>Confirm Password</label>

                                <input type="password" name="password_confirmation" class="form-control">

                            </div>

                            <button class="btn btn-success">

                                Change Password

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
