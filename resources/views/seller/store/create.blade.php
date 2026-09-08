@extends('seller.layouts.layout')
@section('seller_title_page')
Create New Store
@endsection

@section('seller_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Create Store</h5>
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

                <form action="{{ route('create.store') }}" method="POST">
                    @csrf

                    <label class="fw-bold mb-2">Store Name</label>
                    <input type="text" class="form-control" name="store_name" value="{{ old('store_name') }}" required>

                    <label class="fw-bold mb-2 mt-3">Description</label>
                    <textarea class="form-control" name="description" rows="5" required>{{ old('description') }}</textarea>

                    <label class="fw-bold mb-2 mt-3">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Create Store</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
