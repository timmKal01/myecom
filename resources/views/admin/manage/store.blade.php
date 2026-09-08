<x-dashboard-layout role="admin" active="stores" title="Stores">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $stores->total() }} {{ Str::plural('store', $stores->total()) }}</p>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($stores->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No vendor has created a store yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Store</th>
                            <th class="px-6 py-3 font-medium">Owner</th>
                            <th class="px-6 py-3 font-medium">Products</th>
                            <th class="px-6 py-3 font-medium">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($stores as $store)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $store->store_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $store->user?->name ?? '—' }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $store->products_count }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $store->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-line">
                {{ $stores->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
