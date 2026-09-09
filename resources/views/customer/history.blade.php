<x-dashboard-layout role="customer" active="orders" title="Order History">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($orders->isEmpty())
            <div class="text-center py-12">
                <p class="text-sm text-ink-muted mb-4">You haven't placed an order yet.</p>
                <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center rounded-full bg-ink-solid text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Order</th>
                            <th class="px-6 py-3 font-medium">Items</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Placed</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $order->items->sum('quantity') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-accent/10 text-accent-dark text-xs font-medium px-2.5 py-1 capitalize">{{ $order->status }}</span>
                                </td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $order->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('storefront.checkout.confirmation', $order->order_number) }}" class="text-sm font-medium text-accent hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
