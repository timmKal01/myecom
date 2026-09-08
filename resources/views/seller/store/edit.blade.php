@extends('seller.layouts.layout')
@section('seller_page_title')
Edit Store
@endsection

@section('seller_layout')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Edit Store</h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
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

                <form action="{{ route('update.store', $store_info->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="fw-bold mb-2">Store Name</label>
                    <input type="text" class="form-control" name="store_name" value="{{ old('store_name', $store_info->store_name) }}" required>

                    <label class="fw-bold mb-2 mt-3">Description</label>
                    <textarea class="form-control" name="description" rows="5" required>{{ old('description', $store_info->description) }}</textarea>

                    <label class="fw-bold mb-2 mt-3">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $store_info->slug) }}" required>

                    <button type="submit" class="btn btn-primary w-100 mt-3" onclick="return confirm('Are you sure you want to update this store?')">Update Store</button>
                    <a href="{{ route('vendor.store.manage') }}" class="btn btn-secondary w-100 mt-2" onclick="return confirm('Are you sure you want to go back to manage stores?')">Back to Manage Stores</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
