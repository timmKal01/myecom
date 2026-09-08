<x-admin-layout active="subcategory" title="Edit Subcategory">
    <div class="max-w-xl">
        <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 sm:p-8">
            <h2 class="text-lg font-semibold mb-6">Edit Subcategory</h2>

            <form action="{{ route('update.subcat', $subcategory_info->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="subcategory_name" class="block text-sm font-medium mb-1.5">Subcategory Name</label>
                    <input type="text" name="subcategory_name" id="subcategory_name"
                        value="{{ old('subcategory_name', $subcategory_info->subcategory_name) }}"
                        class="w-full rounded-lg border border-admin-border bg-admin-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-admin-accent/30 focus:border-admin-accent">
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium mb-1.5">Parent Category</label>
                    <select name="category_id" id="category_id"
                        class="w-full rounded-lg border border-admin-border bg-admin-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-admin-accent/30 focus:border-admin-accent">
                        @foreach (\App\Models\Category::orderBy('category_name')->get() as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $subcategory_info->category_id) == $category->id)>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-admin-accent text-white text-sm font-medium px-6 py-2.5 hover:bg-admin-accent-dark transition-colors duration-200">
                        Save Changes
                    </button>
                    <a href="{{ route('subcategory.manage') }}" class="text-sm font-medium text-admin-ink-muted hover:text-admin-accent transition-colors duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
