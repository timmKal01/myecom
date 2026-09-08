<x-dashboard-layout role="admin" active="products" title="Products">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $products->total() }} {{ Str::plural('product', $products->total()) }} across all vendors</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($products->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No products have been listed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Vendor</th>
                            <th class="px-6 py-3 font-medium">Category</th>
                            <th class="px-6 py-3 font-medium">Price</th>
                            <th class="px-6 py-3 font-medium">Stock</th>
                            <th class="px-6 py-3 font-medium">Status</th>
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
                                <td class="px-6 py-4 text-ink-muted">{{ $product->seller?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $product->category?->category_name }}</td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($product->final_price, 2) }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $product->stock_quantity }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full text-xs font-medium px-2.5 py-1 capitalize {{ $product->status === 'Published' ? 'bg-accent/10 text-accent-dark' : 'bg-line/60 text-ink-muted' }}">
                                        {{ $product->status ?? 'Draft' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
