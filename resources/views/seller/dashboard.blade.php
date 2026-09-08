<x-dashboard-layout role="seller" active="dashboard" title="Dashboard">
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        @foreach ([
            ['label' => 'Stores', 'value' => $stats['stores'], 'route' => 'vendor.store.manage'],
            ['label' => 'Products', 'value' => $stats['products'], 'route' => 'vendor.product.manage'],
            ['label' => 'Order Items', 'value' => $stats['orderItems'], 'route' => 'vendor.order.history'],
        ] as $card)
            <a href="{{ route($card['route']) }}" class="bg-surface border border-line rounded-xl p-5 shadow-sm hover:border-accent/50 transition-colors duration-200">
                <p class="text-xs uppercase tracking-wide text-ink-muted mb-2">{{ $card['label'] }}</p>
                <p class="font-display text-3xl font-semibold">{{ $card['value'] }}</p>
            </a>
        @endforeach
    </div>

    @if ($stats['stores'] === 0)
        <div class="bg-accent/10 border border-accent/30 rounded-xl p-6 mb-8">
            <p class="text-sm text-ink">
                You don't have a store yet — you'll need one before you can list products.
                <a href="{{ route('vendor.store') }}" class="font-medium text-accent hover:underline">Create your store</a>.
            </p>
        </div>
    @endif

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-line flex items-center justify-between">
            <h2 class="font-display text-lg font-semibold">Recent Sales</h2>
            <a href="{{ route('vendor.order.history') }}" class="text-sm font-medium text-accent hover:underline">View all</a>
        </div>

        @if ($recentOrderItems->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No sales yet — once a customer buys one of your products it'll show up here.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Product</th>
                            <th class="px-6 py-3 font-medium">Order</th>
                            <th class="px-6 py-3 font-medium">Qty</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium">Placed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($recentOrderItems as $item)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $item->product_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $item->order->order_number }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 tabular-nums">${{ number_format($item->line_total, 2) }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-dashboard-layout>
