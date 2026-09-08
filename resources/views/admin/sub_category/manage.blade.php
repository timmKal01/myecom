<x-dashboard-layout role="admin" active="subcategory" title="Subcategories">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-ink-muted">{{ $subcategories->count() }} {{ Str::plural('subcategory', $subcategories->count()) }}</p>
        <a href="{{ route('subcategory.create') }}" class="inline-flex items-center gap-2 rounded-full bg-ink text-white text-sm font-medium px-5 py-2.5 hover:bg-accent transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Subcategory
        </a>
    </div>

    <div class="bg-surface border border-line rounded-xl shadow-sm overflow-hidden">
        @if ($subcategories->isEmpty())
            <p class="text-sm text-ink-muted text-center py-12">No subcategories yet — add your first one above.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-xs uppercase tracking-wide text-ink-muted">
                            <th class="px-6 py-3 font-medium">Name</th>
                            <th class="px-6 py-3 font-medium">Category</th>
                            <th class="px-6 py-3 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $subcategory->subcategory_name }}</td>
                                <td class="px-6 py-4 text-ink-muted">{{ $subcategory->category?->category_name }}</td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('show.subcat', $subcategory->id) }}" class="text-sm font-medium text-ink hover:text-accent transition-colors duration-200">Edit</a>
                                    <form action="{{ route('delete.subcat', $subcategory->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Delete this subcategory? This cannot be undone.')">
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
