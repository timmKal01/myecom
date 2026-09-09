<x-dashboard-layout role="seller" active="store-create" title="Create Store">
    <div class="max-w-xl">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-xl font-semibold mb-6">New Store</h2>

            <form action="{{ route('create.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="store_name" class="block text-sm font-medium text-ink mb-1.5">Store Name</label>
                    <input type="text" name="store_name" id="store_name" value="{{ old('store_name') }}"
                        placeholder="Northgate Electronics"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-ink mb-1.5">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="northgate-electronics"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-ink mb-1.5">Description</label>
                    <textarea name="description" id="description" rows="4"
                        placeholder="Tell shoppers what your store sells…"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink-solid text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                        Create Store
                    </button>
                    <a href="{{ route('vendor.store.manage') }}" class="text-sm font-medium text-ink-muted hover:text-accent transition-colors duration-200">
                        View your stores
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
