@extends('seller.layouts.layout')

@section('seller_page_title', 'Edit Product')

@section('seller_layout')
<div class="row">
<div class="col-12">
<div class="card shadow-sm">

<div class="card-header">
    <h5 class="mb-0">Edit Product</h5>
</div>

<div class="card-body">

{{-- Errors --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Success --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="POST"
      action="{{ route('vendor.product.update', $product->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- Product Name --}}
<div class="mb-3">
    <label class="fw-bold">Product Name</label>
    <input type="text"
           name="product_name"
           class="form-control"
           value="{{ old('product_name', $product->product_name) }}"
           required>
</div>

{{-- Description --}}
<div class="mb-3">
    <label class="fw-bold">Description</label>
    <textarea name="description"
              class="form-control"
              rows="4"
              required>{{ old('description', $product->description) }}</textarea>
</div>

{{-- SKU --}}
<div class="mb-3">
    <label class="fw-bold">SKU</label>
    <input type="text"
           name="sku"
           class="form-control"
           value="{{ old('sku', $product->sku) }}"
           required>
</div>

{{-- Category --}}
<div class="mb-3">
    <label class="fw-bold">Category</label>
    <select name="category_id" class="form-select" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Subcategory --}}
<div class="mb-3">
    <label class="fw-bold">Subcategory</label>
    <select name="subcategory_id" class="form-select" required>
        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}"
                {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                {{ $subcategory->subcategory_name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Store --}}
<div class="mb-3">
    <label class="fw-bold">Store</label>
    <select name="store_id" class="form-select" required>
        @foreach($stores as $store)
            <option value="{{ $store->id }}"
                {{ $product->store_id == $store->id ? 'selected' : '' }}>
                {{ $store->store_name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Pricing --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="fw-bold">Regular Price</label>
        <input type="number" step="0.01" name="regular_price"
               class="form-control"
               value="{{ $product->regular_price }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="fw-bold">Discounted Price</label>
        <input type="number" step="0.01" name="discounted_price"
               class="form-control"
               value="{{ $product->discounted_price }}">
    </div>
</div>

{{-- Stock --}}
<div class="mb-3">
    <label class="fw-bold">Stock Quantity</label>
    <input type="number"
           name="stock_quantity"
           class="form-control"
           value="{{ $product->stock_quantity }}"
           required>
</div>

{{-- Existing Images --}}
@if($product->images->count())
<div class="mb-3">
    <label class="fw-bold">Current Images</label>
    <div class="d-flex gap-2 flex-wrap">
        @foreach($product->images as $img)
            <img src="{{ asset('storage/'.$img->img_path) }}"
                 class="border rounded"
                 width="100">
        @endforeach
    </div>
</div>
@endif

{{-- Upload New Images --}}
<div class="mb-3">
    <label class="fw-bold">Add New Images</label>
    <input type="file" name="images[]" class="form-control" multiple>
</div>

{{-- Slug --}}
<div class="mb-3">
    <label class="fw-bold">Slug</label>
    <input type="text"
           name="slug"
           class="form-control"
           value="{{ $product->slug }}"
           required>
</div>

<button class="btn btn-primary w-100 mt-3">
    Update Product
</button>

<a href="{{ route('vendor.product.manage') }}"
   class="btn btn-secondary w-100 mt-2">
    Back to Products
</a>

</form>

</div>
</div>
</div>
</div>
@endsection
