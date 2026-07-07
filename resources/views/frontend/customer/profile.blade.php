@extends('layouts.frontend')

@section('title', 'Edit Profile')

@section('content')

    <div class="container py-5">

        <div class="row">

            <div class="col-lg-3">

                @include('frontend.customer.sidebar')

            </div>

            <div class="col-lg-9">

                <div class="card shadow">

                    <div class="card-header">

                        <h4>Edit Profile</h4>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('customer.profile.update') }}" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label>Name</label>

                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $customer->name) }}">

                            </div>

                            <div class="mb-3">

                                <label>Phone</label>

                                <input type="text" class="form-control" value="{{ $customer->phone }}" readonly>

                            </div>

                            <div class="mb-3">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $customer->email) }}">

                            </div>

                            <div class="mb-3">

                                <label>Address</label>

                                <textarea name="address" class="form-control" rows="4">{{ old('address', $customer->address) }}</textarea>

                            </div>

                            <button class="btn btn-success">

                                Save Changes

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
