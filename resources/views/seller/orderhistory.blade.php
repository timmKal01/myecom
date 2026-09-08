<x-dashboard-layout role="seller" active="orders" title="Order History">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $orderItems->total() }} {{ Str::plural('item', $orderItems->total()) }} sold</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($orderItems->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No sales yet — once a customer buys one of your products it'll show up here.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Order</th>
                            <th class="px-6 py-3 font-medium">Customer</th>
                            <th class="px-6 py-3 font-medium">Qty</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Placed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($orderItems as $item)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $item->product_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $item->order->order_number }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $item->order->user?->name ?? $item->order->shipping_name }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($item->line_total, 2) }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $item->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $orderItems->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
