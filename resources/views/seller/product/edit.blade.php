<x-dashboard-layout role="seller" active="product-manage" title="Edit Product">
    <div class="max-w-2xl">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-xl font-semibold mb-6">Edit Product</h2>

            <form method="POST" action="{{ route('vendor.product.update', $product->id) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="product_name" class="block text-sm font-medium text-ink mb-1.5">Product Name</label>
                    <input type="text" name="product_name" id="product_name"
                        value="{{ old('product_name', $product->product_name) }}"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-ink mb-1.5">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="sku" class="block text-sm font-medium text-ink mb-1.5">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div>
                    <label for="brand" class="block text-sm font-medium text-ink mb-1.5">Brand <span class="text-ink-muted font-normal">(optional)</span></label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-ink mb-1.5">Category</label>
                        <select name="category_id" id="category_id"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="subcategory_id" class="block text-sm font-medium text-ink mb-1.5">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" @selected($product->subcategory_id == $subcategory->id)>{{ $subcategory->subcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="store_id" class="block text-sm font-medium text-ink mb-1.5">Store</label>
                    <select name="store_id" id="store_id"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" @selected($product->store_id == $store->id)>{{ $store->store_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="regular_price" class="block text-sm font-medium text-ink mb-1.5">Regular Price</label>
                        <input type="number" step="0.01" name="regular_price" id="regular_price"
                            value="{{ old('regular_price', $product->regular_price) }}"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>
                    <div>
                        <label for="discounted_price" class="block text-sm font-medium text-ink mb-1.5">Discounted Price</label>
                        <input type="number" step="0.01" name="discounted_price" id="discounted_price"
                            value="{{ old('discounted_price', $product->discounted_price) }}"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>
                </div>

                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-ink mb-1.5">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity"
                        value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                @if ($product->images->count())
                    <div>
                        <p class="block text-sm font-medium text-ink mb-1.5">Current Images</p>
                        <div class="flex gap-2 flex-wrap">
                            @foreach ($product->images as $img)
                                <img src="{{ asset('storage/'.$img->img_path) }}" class="w-20 h-20 object-cover rounded-lg border border-line">
                            @endforeach
                        </div>
                    </div>
                @endif

                <div>
                    <label for="images" class="block text-sm font-medium text-ink mb-1.5">Add New Images</label>
                    <input type="file" name="images[]" id="images" multiple
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm file:mr-4 file:rounded-full file:border-0 file:bg-ink-solid file:text-white file:text-xs file:font-medium file:px-4 file:py-2 focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-ink mb-1.5">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink-solid text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                        Update Product
                    </button>
                    <a href="{{ route('vendor.product.manage') }}" class="text-sm font-medium text-ink-muted hover:text-accent transition-colors duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
