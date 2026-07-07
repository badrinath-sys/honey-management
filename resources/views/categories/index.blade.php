@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3>Categories</h3>

            <a href="{{ route('categories.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Add Category

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <form method="GET" action="{{ route('categories.index') }}">

            <div class="input-group">

                <input type="text" name="search" class="form-control" placeholder="Search Category..."
                    value="{{ request('search') }}">

                <button class="btn btn-primary">

                    <i class="fas fa-search"></i>

                </button>

                @if (request('search'))
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">

                        Reset

                    </a>
                @endif

            </div>

        </form>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="60">#</th>

                        <th width="120">Image</th>

                        <th>Name</th>

                        <th>Slug</th>

                        <th>Sort</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)
                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                @if ($category->image)
                                    <img src="{{ asset('assets/images/categories/' . $category->image) }}"
                                        class="img-thumbnail" style="width:70px;height:70px;object-fit:contain;">
                                @else
                                    <img src="{{ asset('assets/images/no-image.png') }}" class="img-thumbnail"
                                        style="width:70px;height:70px;object-fit:contain;">
                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $category->name }}

                                </strong>

                            </td>

                            <td>

                                {{ $category->slug }}

                            </td>
                            <td>

                                {{ $category->sort_order }}

                            </td>

                            <td>

                                @if ($category->status)
                                    <span class="badge bg-success">

                                        Active

                                    </span>
                                @else
                                    <span class="badge bg-danger">

                                        Inactive

                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning me-2">

                                    <i class="fas fa-edit"></i>

                                    Edit

                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this category?')">

                                        <i class="fas fa-trash"></i>

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                No Categories Found.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $categories->links() }}

            </div>

        </div>

    </div>

    </div>
@endsection
