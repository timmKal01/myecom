<x-admin-layout active="products" title="Products">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-admin-ink-muted">
            {{ $products->total() }} {{ Str::plural('product', $products->total()) }}
            @if (request('q'))
                matching "{{ request('q') }}"
                <a href="{{ route('product.manage') }}" class="text-admin-accent hover:underline">clear</a>
            @endif
        </p>
    </div>

    <div class="bg-admin-surface border border-admin-border rounded-2xl overflow-hidden">
        @if ($products->isEmpty())
            <p class="text-sm text-admin-ink-muted text-center py-12">No products found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Brand</th>
                            <th class="px-6 py-3 font-medium">Vendor</th>
                            <th class="px-6 py-3 font-medium">Category</th>
                            <th class="px-6 py-3 font-medium">Price</th>
                            <th class="px-6 py-3 font-medium">Stock</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-admin-border">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($product->primary_image)
                                            <img src="{{ asset('storage/'.$product->primary_image->img_path) }}" alt="" class="w-10 h-10 rounded-lg object-cover border border-admin-border">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-admin-canvas border border-admin-border"></div>
                                        @endif
                                        <span class="font-medium">{{ $product->product_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $product->brand ?? '—' }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $product->seller?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $product->category?->category_name }}</td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($product->final_price, 2) }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $product->stock_quantity }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full text-xs font-medium px-2.5 py-1 capitalize {{ $product->status === 'Published' && $product->visibility ? 'bg-admin-positive-soft text-admin-positive' : 'bg-admin-canvas text-admin-ink-muted' }}">
                                        {{ $product->status === 'Published' && $product->visibility ? 'Published' : 'Hidden' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-admin-border">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
