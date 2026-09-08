<x-dashboard-layout role="seller" active="product-create" title="Add Product">
    <div class="max-w-2xl">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-xl font-semibold mb-6">New Product</h2>

            @if ($stores->isEmpty())
                <p class="text-sm text-ink-muted">
                    You need a store before you can list a product.
                    <a href="{{ route('vendor.store') }}" class="text-accent font-medium hover:underline">Create your store</a>.
                </p>
            @else
                <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label for="product_name" class="block text-sm font-medium text-ink mb-1.5">Product Name</label>
                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}"
                            placeholder="Samsung Galaxy S21"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-medium text-ink mb-1.5">Product Images</label>
                        <input type="file" name="images[]" id="images" multiple
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm file:mr-4 file:rounded-full file:border-0 file:bg-ink file:text-white file:text-xs file:font-medium file:px-4 file:py-2 focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-ink mb-1.5">Description</label>
                        <textarea name="description" id="description" rows="4"
                            placeholder="Enter product description here…"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="sku" class="block text-sm font-medium text-ink mb-1.5">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                            placeholder="XLV103"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <livewire:category-subcategory />

                    <div>
                        <label for="store_id" class="block text-sm font-medium text-ink mb-1.5">Store</label>
                        <select name="store_id" id="store_id"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}" @selected(old('store_id') == $store->id)>{{ $store->store_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="regular_price" class="block text-sm font-medium text-ink mb-1.5">Regular Price</label>
                            <input type="number" step="0.01" name="regular_price" id="regular_price" value="{{ old('regular_price') }}"
                                class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                        </div>
                        <div>
                            <label for="discounted_price" class="block text-sm font-medium text-ink mb-1.5">Discounted Price</label>
                            <input type="number" step="0.01" name="discounted_price" id="discounted_price" value="{{ old('discounted_price') }}"
                                class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                        </div>
                        <div>
                            <label for="tax_rate" class="block text-sm font-medium text-ink mb-1.5">Tax Rate (%)</label>
                            <input type="number" step="0.01" name="tax_rate" id="tax_rate" value="{{ old('tax_rate') }}"
                                class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                        </div>
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-ink mb-1.5">Stock Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity') }}"
                                class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                        </div>
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-ink mb-1.5">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            placeholder="samsung-galaxy-s21"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-ink mb-1.5">Meta Title <span class="text-ink-muted font-normal">(optional)</span></label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-ink mb-1.5">Meta Description <span class="text-ink-muted font-normal">(optional)</span></label>
                        <input type="text" name="meta_description" id="meta_description" value="{{ old('meta_description') }}"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" onclick="return confirm('Add this product?')"
                            class="inline-flex items-center justify-center rounded-full bg-ink text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                            Add Product
                        </button>
                        <a href="{{ route('vendor.product.manage') }}" class="text-sm font-medium text-ink-muted hover:text-accent transition-colors duration-200">
                            View your products
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-dashboard-layout>
