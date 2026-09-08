<x-dashboard-layout role="seller" active="store-manage" title="Your Stores">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $stores->count() }} {{ Str::plural('store', $stores->count()) }}</p>
        <a href="{{ route('vendor.store') }}" class="inline-flex items-center gap-2 rounded-full bg-ink text-white text-sm font-medium px-5 py-2.5 hover:bg-accent transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create Store
        </a>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($stores->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">You haven't created a store yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Name</th>
                            <th class="px-6 py-3 font-medium">Slug</th>
                            <th class="px-6 py-3 font-medium">Products</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($stores as $store)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $store->store_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $store->slug }}</td>
                                <td class="px-6 py-4 tabular-nums">{{ $store->products()->count() }}</td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('edit.store', $store->id) }}" class="text-sm font-medium text-ink hover:text-accent transition-colors duration-200">Edit</a>
                                    <form action="{{ route('delete.store', $store->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Delete this store? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700 transition-colors duration-200">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-dashboard-layout>
