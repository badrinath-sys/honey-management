@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">

                        <h4 class="mb-0">
                            <i class="bi bi-person-circle"></i>
                            My Profile
                        </h4>

                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">

                                {{ session('success') }}

                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">

                                <label class="form-label">

                                    Name

                                </label>

                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', auth()->user()->name) }}">

                                @error('name')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}">

                                @error('email')
                                    <small class="text-danger">

                                        {{ $message }}

                                    </small>
                                @enderror

                            </div>

                            <button class="btn btn-primary">

                                <i class="bi bi-check-circle"></i>

                                Update Profile

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
