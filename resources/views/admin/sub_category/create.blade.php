<x-dashboard-layout role="admin" active="subcategory" title="Add Subcategory">
    <div class="max-w-xl">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-xl font-semibold mb-6">New Subcategory</h2>

            @if ($categories->isEmpty())
                <p class="text-sm text-ink-muted">
                    You need at least one category before you can add a subcategory.
                    <a href="{{ route('category.create') }}" class="text-accent font-medium hover:underline">Add a category</a>.
                </p>
            @else
                <form action="{{ route('store.subcat') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="subcategory_name" class="block text-sm font-medium text-ink mb-1.5">Subcategory Name</label>
                        <input type="text" name="subcategory_name" id="subcategory_name" value="{{ old('subcategory_name') }}"
                            placeholder="Laptops"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-ink mb-1.5">Parent Category</label>
                        <select name="category_id" id="category_id"
                            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                            Add Subcategory
                        </button>
                        <a href="{{ route('subcategory.manage') }}" class="text-sm font-medium text-ink-muted hover:text-accent transition-colors duration-200">
                            View all subcategories
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-dashboard-layout>
