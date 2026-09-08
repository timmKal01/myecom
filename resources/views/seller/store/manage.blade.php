@extends('seller.layouts.layout')
@section('seller_title_page')
Manage Store
@endsection

@section('seller_layout')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Manage All Stores</h5>
                <a href="{{ route('vendor.store') }}" class="btn btn-primary">Add Store</a>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Store Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->store_name }}</td>
                                <td>{{ $store->slug }}</td>
                                <td>{{ $store->description }}</td>
                                <td>
                                    <a href="{{ route('edit.store', $store->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                    
                                    <form action="{{ route('delete.store', $store->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this store?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($stores->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">No stores found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
