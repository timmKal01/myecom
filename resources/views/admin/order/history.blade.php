<x-admin-layout active="orders" title="Orders">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-admin-ink-muted">{{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}</p>
    </div>

    <div class="bg-admin-surface border border-admin-border rounded-2xl overflow-hidden">
        @if ($orders->isEmpty())
            <p class="text-sm text-admin-ink-muted text-center py-12">No orders have been placed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-ink-muted">
                            <th class="px-6 py-3 font-medium">Order</th>
                            <th class="px-6 py-3 font-medium">Customer</th>
                            <th class="px-6 py-3 font-medium">Items</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Placed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-admin-border">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $order->user?->name ?? $order->shipping_name }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $order->items->sum('quantity') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-admin-accent-soft text-admin-accent text-xs font-medium px-2.5 py-1 capitalize">{{ $order->status }}</span>
                                </td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $order->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-admin-border">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
