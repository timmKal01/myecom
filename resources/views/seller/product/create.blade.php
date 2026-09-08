@extends('seller.layouts.layout')

@section('seller_title_page')
    Add Product  
@endsection

@section('seller_layout')
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Product</h5>
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
                <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="product_name" class="fw-bold mb-2">Provide a Name for Your Product</label>
                    <input type="text" class="form-control mb-2" name="product_name" placeholder="Samsung Galaxy S21">

                    <label for="images" class="fw-bold mb-2">Upload Your Product Images</label>
                    <input type="file" class="form-control mb-2" name="images[]" multiple>

                    <label for="description" class="fw-bold mb-2">Product Description</label>
                    <textarea class="form-control mb-2"  name="description" id="description" cols="30" rows="10" placeholder="Enter product description here..."></textarea>

                    <label for="sku" class="fw-bold mb-2">SKU</label>
                    <input type="text" class="form-control mb-2" name="sku" placeholder="XLV103">

                    <livewire:category-subcategory/>

                    <label for="store_id" class="fw-bold mb-2">Select A Store For This Product</label>
                    <select name="store_id" id="store_id" class="form-control mb-2">
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                        @endforeach
                    </select> 

                    <label for="regular_price" class="fw-bold mb-2">Product Regular Price</label>
                    <input type="number" class="form-control mb-2" name="regular_price">

                    <label for="discounted_price" class="fw-bold mb-2">Product Discounted Price (if any)</label>
                    <input type="number" class="form-control mb-2" name="discounted_price">

                    <label for="tax_rate" class="fw-bold mb-2">Tax</label>
                    <input type="number" class="form-control mb-2" name="tax_rate">

                    <label for="stock_quantity" class="fw-bold mb-2">Stock Quantity</label>
                    <input type="number" class="form-control mb-2" name="stock_quantity">

                    <label for="slug" class="fw-bold mb-2">Slug</label>
                    <input type="text" class="form-control mb-2" name="slug">

                    <label for="meta_title" class="fw-bold mb-2">Meta Title</label>
                    <input type="text" class="form-control mb-2" name="meta_title">

                    <label for="meta_description" class="fw-bold mb-2">Meta Description</label>
                    <input type="text" class="form-control mb-2" name="meta_description">

                    <button type="submit" class="btn btn-primary w-100 mt-2" onclick="return confirm('Are you sure you want to add this product?')">Add Product</button>
                    <a href="{{ route('product.manage') }}" class="btn btn-secondary w-100 mt-2">Back to Manage Products</a>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection 