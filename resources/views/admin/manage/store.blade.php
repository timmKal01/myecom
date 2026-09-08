<x-admin-layout active="stores" title="Stores">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-admin-ink-muted">{{ $stores->total() }} {{ Str::plural('store', $stores->total()) }}</p>
    </div>

    <div class="bg-admin-surface border border-admin-border rounded-2xl overflow-hidden">
        @if ($stores->isEmpty())
            <p class="text-sm text-admin-ink-muted text-center py-12">No vendor has created a store yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-ink-muted">
                            <th class="px-6 py-3 font-medium">Store</th>
                            <th class="px-6 py-3 font-medium">Owner</th>
                            <th class="px-6 py-3 font-medium">Products</th>
                            <th class="px-6 py-3 font-medium">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-admin-border">
                        @foreach ($stores as $store)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $store->store_name }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $store->user?->name ?? '—' }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $store->products_count }}</td>
                                <td class="px-6 py-4 text-admin-ink-muted">{{ $store->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-admin-border">
                {{ $stores->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
