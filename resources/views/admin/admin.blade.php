@php
    $icons = [
        'box' => 'M20.25 7.5l-8.25 4.5L3.75 7.5M20.25 7.5l-8.25-4.5L3.75 7.5M20.25 7.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9M3.75 7.5v9l8.25 4.5',
        'receipt' => 'M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM14.25 12h.008v.008h-.008V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        'users' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
        'building' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21',
    ];

    $kpiCards = [
        ['key' => 'products', 'label' => 'Products', 'icon' => 'box', 'route' => 'product.manage'],
        ['key' => 'orders', 'label' => 'Orders', 'icon' => 'receipt', 'route' => 'admin.order.history'],
        ['key' => 'customers', 'label' => 'Customers', 'icon' => 'users', 'route' => 'admin.manage.user'],
        ['key' => 'stores', 'label' => 'Stores', 'icon' => 'building', 'route' => 'admin.manage.store'],
    ];

    // Revenue sparkline
    $sparkW = 560; $sparkH = 100;
    $maxRevenue = max(1, collect($revenueSeries)->max('total'));
    $n = max(1, count($revenueSeries) - 1);
    $sparkPoints = collect($revenueSeries)->values()->map(function ($d, $i) use ($sparkW, $sparkH, $maxRevenue, $n) {
        $x = round(($i / $n) * $sparkW, 1);
        $y = round($sparkH - ($d['total'] / $maxRevenue) * ($sparkH - 8) - 4, 1);
        return "$x,$y";
    })->join(' ');
    $sparkFill = "0,$sparkH $sparkPoints $sparkW,$sparkH";

    // Weekday bar chart
    $maxWeekday = max(1, collect($ordersByWeekday)->max('count'));
    $peakDay = collect($ordersByWeekday)->sortByDesc('count')->first()['label'] ?? null;

    // Catalog health gauge
    $gaugeR = 52; $gaugeCirc = 2 * M_PI * $gaugeR;
    $gaugeOffset = $gaugeCirc * (1 - $catalogRate / 100);
@endphp
<x-admin-layout active="dashboard" title="Dashboard">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach ($kpiCards as $card)
            @php $k = $kpis[$card['key']]; @endphp
            <a href="{{ route($card['route']) }}" class="bg-admin-surface border border-admin-border rounded-2xl p-5 hover:border-admin-accent/40 transition-colors duration-150">
                <div class="flex items-center justify-between mb-4">
                    <span class="w-9 h-9 rounded-lg bg-admin-accent-soft text-admin-accent flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$card['icon']] }}" />
                        </svg>
                    </span>
                    @if ($k['delta'] !== null)
                        <span class="inline-flex items-center gap-0.5 text-xs font-semibold rounded-full px-2 py-0.5 {{ $k['delta'] >= 0 ? 'bg-admin-positive-soft text-admin-positive' : 'bg-admin-negative-soft text-admin-negative' }}">
                            {{ $k['delta'] >= 0 ? '+' : '' }}{{ $k['delta'] }}%
                        </span>
                    @elseif ($k['current'] > 0)
                        <span class="inline-flex items-center gap-0.5 text-xs font-semibold rounded-full px-2 py-0.5 bg-admin-accent-soft text-admin-accent">
                            New
                        </span>
                    @endif
                </div>
                <p class="text-sm text-admin-ink-muted mb-1">{{ $card['label'] }}</p>
                <p class="text-2xl font-semibold tracking-tight">{{ number_format($k['total']) }}</p>
                <p class="text-xs text-admin-ink-muted mt-1">{{ $k['current'] }} in last 30 days</p>
            </a>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-admin-surface border border-admin-border rounded-2xl p-6">
                <div class="flex items-start justify-between mb-1">
                    <div>
                        <p class="text-sm text-admin-ink-muted mb-1">Revenue</p>
                        <p class="text-3xl font-semibold tracking-tight">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                    <p class="text-xs text-admin-ink-muted pt-1">Last 30 days</p>
                </div>

                <svg viewBox="0 0 {{ $sparkW }} {{ $sparkH }}" class="w-full h-24 mt-4" preserveAspectRatio="none">
                    <polygon points="{{ $sparkFill }}" fill="rgb(59 91 255 / 0.08)" />
                    <polyline points="{{ $sparkPoints }}" fill="none" stroke="#3b5bff" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" />
                </svg>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4 pt-4 border-t border-admin-border">
                    <div>
                        <p class="text-xs text-admin-ink-muted mb-0.5">Orders</p>
                        <p class="text-sm font-semibold">{{ $kpis['orders']['total'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-admin-ink-muted mb-0.5">Avg. Order Value</p>
                        <p class="text-sm font-semibold">${{ number_format($avgOrderValue, 2) }}</p>
                    </div>
                    @foreach ($revenueByCategory->take(1) as $top)
                        <div>
                            <p class="text-xs text-admin-ink-muted mb-0.5">Top Category</p>
                            <p class="text-sm font-semibold">{{ $top->name }}</p>
                        </div>
                    @endforeach
                </div>

                @if ($revenueByCategory->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-admin-border space-y-2">
                        @php $catMax = max(1, $revenueByCategory->max('revenue')); @endphp
                        @foreach ($revenueByCategory as $cat)
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-admin-ink-muted w-28 shrink-0 truncate">{{ $cat->name }}</span>
                                <div class="flex-1 h-2 rounded-full bg-admin-canvas overflow-hidden">
                                    <div class="h-full rounded-full bg-admin-accent" style="width: {{ round($cat->revenue / $catMax * 100) }}%"></div>
                                </div>
                                <span class="text-xs font-medium w-16 text-right shrink-0">${{ number_format($cat->revenue, 0) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-admin-surface border border-admin-border rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-admin-border">
                    <h2 class="font-semibold">Best Selling Products</h2>
                </div>
                @if ($bestSellers->isEmpty())
                    <p class="text-sm text-admin-ink-muted text-center py-12">No sales yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-ink-muted">
                                    <th class="px-6 py-3 font-medium">Product</th>
                                    <th class="px-6 py-3 font-medium">Category</th>
                                    <th class="px-6 py-3 font-medium">Sold</th>
                                    <th class="px-6 py-3 font-medium">Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-admin-border">
                                @foreach ($bestSellers as $row)
                                    <tr>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                @if ($row->product?->primary_image)
                                                    <img src="{{ asset('storage/'.$row->product->primary_image->img_path) }}" alt="" class="w-9 h-9 rounded-lg object-cover border border-admin-border">
                                                @else
                                                    <div class="w-9 h-9 rounded-lg bg-admin-canvas border border-admin-border"></div>
                                                @endif
                                                <span class="font-medium">{{ $row->product?->product_name ?? 'Deleted product' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-admin-ink-muted">{{ $row->product?->category?->category_name }}</td>
                                        <td class="px-6 py-3 tabular-nums">{{ $row->sold }} sold</td>
                                        <td class="px-6 py-3 tabular-nums font-medium">${{ number_format($row->revenue, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-admin-surface border border-admin-border rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-sm">Orders by Day</h2>
                    @if ($kpis['orders']['total'] > 0)
                        <span class="text-xs text-admin-ink-muted">Peak: {{ $peakDay }}</span>
                    @endif
                </div>
                <div class="flex items-end justify-between gap-2 h-28">
                    @foreach ($ordersByWeekday as $day)
                        <div class="flex-1 flex flex-col items-center gap-2">
                            <div class="w-full rounded-t-md {{ $day['count'] === $maxWeekday && $day['count'] > 0 ? 'bg-admin-accent' : 'bg-admin-canvas' }}"
                                 style="height: {{ max(4, round($day['count'] / $maxWeekday * 96)) }}px"></div>
                            <span class="text-[11px] text-admin-ink-muted">{{ $day['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 text-center">
                <h2 class="font-semibold text-sm mb-4 text-left">Catalog Published Rate</h2>
                <svg viewBox="0 0 120 120" class="w-32 h-32 mx-auto -rotate-90">
                    <circle cx="60" cy="60" r="{{ $gaugeR }}" fill="none" stroke="#e5e7eb" stroke-width="10" />
                    <circle cx="60" cy="60" r="{{ $gaugeR }}" fill="none" stroke="#3b5bff" stroke-width="10"
                            stroke-linecap="round"
                            stroke-dasharray="{{ $gaugeCirc }}"
                            stroke-dashoffset="{{ $gaugeOffset }}" />
                </svg>
                <p class="text-2xl font-semibold -mt-20 mb-16">{{ $catalogRate }}%</p>
                <p class="text-xs text-admin-ink-muted">{{ $publishedProducts }} of {{ $totalProducts }} products published &amp; visible</p>
            </div>

            <div class="bg-admin-surface border border-admin-border rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-admin-border flex items-center justify-between">
                    <h2 class="font-semibold text-sm">Recent Orders</h2>
                    <a href="{{ route('admin.order.history') }}" class="text-xs font-medium text-admin-accent hover:underline">View all</a>
                </div>
                @if ($recentOrders->isEmpty())
                    <p class="text-sm text-admin-ink-muted text-center py-10">No orders yet.</p>
                @else
                    <ul class="divide-y divide-admin-border">
                        @foreach ($recentOrders as $order)
                            <li class="px-6 py-3 flex items-center justify-between text-sm">
                                <div class="min-w-0">
                                    <p class="font-medium truncate">{{ $order->user?->name ?? $order->shipping_name }}</p>
                                    <p class="text-xs text-admin-ink-muted">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="font-semibold tabular-nums shrink-0 ml-3">${{ number_format($order->total, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
