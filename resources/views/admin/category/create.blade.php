@extends('admin.layouts.layout')
@section('admin_page_title')
Create Category
@endsection
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Create Category</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())

                <div class="alert alert-danger d-flex align-items-center">

                    <ul>

                        @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{route('store.cat')}}" method="POST">
                    @csrf
                    <label for="category_name" class="fw-bold mb-2">Provide a Name for Your Category</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Computer">
                    <button type="submit" class="btn btn-primary w-100 mt-2" onclick="return confirm('Are you sure you want to add this category?')">Add Category</button>
                    <a href="{{ route('category.manage') }}" class="btn btn-secondary w-100 mt-2">Back to Manage Categories</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
