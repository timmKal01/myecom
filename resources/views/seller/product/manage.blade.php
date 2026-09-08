@extends('seller.layouts.layout')

@section('seller_title_page')
Manage Products
@endsection

@section('seller_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Manage all Products</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Store</th>
                            <th>Regular Price</th>
                            <th>Discount Price</th>
                            <th>Tax</th>
                            <th>Stock Quantity</th>
                            <th>Images</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ $product->subcategory->subcategory_name }}</td>
                            <td>{{ $product->store->store_name }}</td>
                            <td>{{ $product->regular_price }}</td>
                            <td>{{ $product->discounted_price }}</td>
                            <td>{{ $product->tax_rate }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td><img src="{{ asset($product->image) }}" alt="Product Image" width="50"></td>
                            <td>{{ $product->slug }}</td>
                            
                            <td><a href="{{ route('vendor.product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{route ('vendor.product.delete', $product->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" value="Delete" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                            

                        </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
