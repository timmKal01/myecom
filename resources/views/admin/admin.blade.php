<x-dashboard-layout role="admin" active="dashboard" title="Dashboard">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach ([
            ['label' => 'Products', 'value' => $stats['products'], 'route' => 'product.manage'],
            ['label' => 'Orders', 'value' => $stats['orders'], 'route' => 'admin.order.history'],
            ['label' => 'Users', 'value' => $stats['users'], 'route' => 'admin.manage.user'],
            ['label' => 'Stores', 'value' => $stats['stores'], 'route' => 'admin.manage.store'],
        ] as $card)
            <a href="{{ route($card['route']) }}" class="bg-surface border border-line rounded-xl p-5 shadow-sm hover:border-accent/50 transition-colors duration-200">
                <p class="text-xs uppercase tracking-wide text-ink-muted mb-2">{{ $card['label'] }}</p>
                <p class="font-display text-3xl font-semibold">{{ $card['value'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-line flex items-center justify-between">
            <h2 class="font-display text-lg font-semibold">Recent Orders</h2>
            <a href="{{ route('admin.order.history') }}" class="text-sm font-medium text-accent hover:underline">View all</a>
        </div>

        @if ($recentOrders->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No orders have come in yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Order</th>
                            <th class="px-6 py-3 font-medium">Customer</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Placed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $order->user?->name ?? $order->shipping_name }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-accent/10 text-accent-dark text-xs font-medium px-2.5 py-1 capitalize">{{ $order->status }}</span>
                                </td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-dashboard-layout>
