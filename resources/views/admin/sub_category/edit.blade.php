@extends('admin.layouts.layout')
@section('admin_page_title')
Edit SubCategory
@endsection
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit SubCategory</h5>
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
                <form action="{{ route('update.subcat', $subcategory_info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="subcategory_name" class="fw-bold mb-2">Provide a Name for Your SubCategory</label>
                    <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory_info->subcategory_name }}">
                    <button type="submit" class="btn btn-primary w-100 mt-2" onclick="return confirm('Are you sure you want to update this subcategory?')">Update Sub Category</button>
                    <a href="{{ route('subcategory.manage') }}" class="btn btn-secondary w-100 mt-2" onclick="return confirm('Are you sure you want to go back to manage subcategories?')">Back to Manage SubCategories</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
