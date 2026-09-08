<x-admin-layout active="category" title="Edit Category">
    <div class="max-w-xl">
        <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 sm:p-8">
            <h2 class="text-lg font-semibold mb-6">Edit Category</h2>

            <form action="{{ route('update.cat', $category_info->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="category_name" class="block text-sm font-medium mb-1.5">Category Name</label>
                    <input type="text" name="category_name" id="category_name"
                        value="{{ old('category_name', $category_info->category_name) }}"
                        class="w-full rounded-lg border border-admin-border bg-admin-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-admin-accent/30 focus:border-admin-accent">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-admin-accent text-white text-sm font-medium px-6 py-2.5 hover:bg-admin-accent-dark transition-colors duration-200">
                        Save Changes
                    </button>
                    <a href="{{ route('category.manage') }}" class="text-sm font-medium text-admin-ink-muted hover:text-admin-accent transition-colors duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
