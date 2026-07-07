@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            <i class="bi bi-people-fill"></i>
            User Management
        </h3>

        <a href="{{ route('users.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Add User

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <table id="dataTable" class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>

                                @if ($user->role == 'Admin')
                                    <span class="badge bg-danger">

                                        Admin

                                    </span>
                                @else
                                    <span class="badge bg-primary">

                                        Staff

                                    </span>
                                @endif

                            </td>

                            <td>

                                <form action="{{ route('users.status', $user->id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    @if ($user->status)
                                        <button class="btn btn-success btn-sm">

                                            Active

                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm">

                                            Inactive

                                        </button>
                                    @endif

                                </form>

                            </td>
                            <td>

                                {{ $user->created_at->format('d-m-Y') }}

                            </td>

                            <td>

                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                @if (auth()->id() != $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
