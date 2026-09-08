@extends('admin.layouts.layout')
@section('admin_page_title')
Edit Attribute
@endsection
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Attribute </h5>
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
                <form action="{{ route('update.attribute', $attri_info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="attribute_value" class="fw-bold mb-2">Provide a Name for Your Attribute</label>
                    <input type="text" class="form-control" name="attribute_value" value="{{ $attri_info->attribute_value }}">
                    <button type="submit" class="btn btn-primary w-100 mt-2" onclick="return confirm('Are you sure you want to update this attribute?')">Update Attribute</button>
                    <a href="{{ route('productattribute.manage') }}" class="btn btn-secondary w-100 mt-2" onclick="return confirm('Are you sure you want to go back to manage attributes?')">Back to Manage Attributes</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
