@extends('admin.layouts.layout')
@section('admin_page_title')
Create SubCategory
@endsection
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Create SubCategory</h5>
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
                <form action="{{ route('store.subcat') }}" method="POST">
                    @csrf
                    <label for="subcategory_name" class="fw-bold mb-2">Provide a Name for Your SubCategory</label>
                    <input type="text" class="form-control" name="subcategory_name" placeholder="Computer">
                    
                    <label for="category_id" class="fw-bold mb-2 my-2">Select a Category</label>
                    <select name="category_id" class="form-select mb-2" id="category_id">
                        <option value="" disabled selected>-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary w-100 mt-2">Add SubCategory</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
