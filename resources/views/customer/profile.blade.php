<x-dashboard-layout role="customer" active="dashboard" title="Overview">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <div class="bg-surface border border-line rounded-xl p-5 shadow-sm">
            <p class="text-xs uppercase tracking-wide text-ink-muted mb-2">Name</p>
            <p class="font-display text-xl font-semibold">{{ auth()->user()->name }}</p>
        </div>
        <a href="{{ route('customer.history') }}" class="bg-surface border border-line rounded-xl p-5 shadow-sm hover:border-accent/50 transition-colors duration-200">
            <p class="text-xs uppercase tracking-wide text-ink-muted mb-2">Orders Placed</p>
            <p class="font-display text-3xl font-semibold">{{ $orderCount }}</p>
        </a>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-line flex items-center justify-between">
            <h2 class="font-display text-lg font-semibold">Recent Orders</h2>
            <a href="{{ route('customer.history') }}" class="text-sm font-medium text-accent hover:underline">View all</a>
        </div>

        @if ($recentOrders->isEmpty())
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
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $order->items->sum('quantity') }}</td>
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
