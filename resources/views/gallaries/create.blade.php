@extends('layouts.master')

@section('content')
    <div class="card shadow">

        <div class="card-header">

            <h4>Add Gallery Image</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label>Title</label>

                    <input type="text" name="title" class="form-control" required>

                </div>

                <div class="mb-3">

                    <label>Image</label>

                    <input type="file" name="image" class="form-control" required>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Sort Order</label>

                        <input type="number" name="sort_order" value="0" class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label>Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-success">

                        Save

                    </button>

                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
