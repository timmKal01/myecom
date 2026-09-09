<x-dashboard-layout role="seller" active="product-manage" title="Your Products">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $products->count() }} {{ Str::plural('product', $products->count()) }}</p>
        <a href="{{ route('vendor.product') }}" class="inline-flex items-center gap-2 rounded-full bg-ink-solid text-white text-sm font-medium px-5 py-2.5 hover:bg-accent transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Product
        </a>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($products->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">You haven't listed a product yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Brand</th>
                            <th class="px-6 py-3 font-medium">Category</th>
                            <th class="px-6 py-3 font-medium">Store</th>
                            <th class="px-6 py-3 font-medium">Price</th>
                            <th class="px-6 py-3 font-medium">Stock</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($product->primary_image)
                                            <img src="{{ asset('storage/'.$product->primary_image->img_path) }}" alt="" class="w-10 h-10 rounded-lg object-cover border border-line">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-canvas border border-line"></div>
                                        @endif
                                        <span class="font-medium">{{ $product->product_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-ink-muted">{{ $product->brand ?? '—' }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $product->category?->category_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $product->store?->store_name }}</td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($product->final_price, 2) }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $product->stock_quantity }}</td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('vendor.product.edit', $product->id) }}" class="text-sm font-medium text-ink hover:text-accent transition-colors duration-200">Edit</a>
                                    <form action="{{ route('vendor.product.delete', $product->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Delete this product? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700 transition-colors duration-200">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-dashboard-layout>
