<x-dashboard-layout role="admin" active="discount" title="Active Discounts">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $discounted->total() }} {{ Str::plural('product', $discounted->total()) }} currently on sale</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($discounted->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No product currently has a discounted price set below its regular price.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Category</th>
                            <th class="px-6 py-3 font-medium">Regular</th>
                            <th class="px-6 py-3 font-medium">Discounted</th>
                            <th class="px-6 py-3 font-medium">Off</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($discounted as $product)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $product->product_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $product->category?->category_name }}</td>
                                <td class="px-6 py-4 tabular-nums text-ink-muted line-through">${{ number_format($product->regular_price, 2) }}</td>
                                <td class="px-6 py-4 tabular-nums font-medium">${{ number_format($product->discounted_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-accent/10 text-accent-dark text-xs font-medium px-2.5 py-1">
                                        {{ $product->discount_percent }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $discounted->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
