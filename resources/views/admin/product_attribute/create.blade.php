<x-dashboard-layout role="admin" active="attribute" title="Add Attribute">
    <div class="max-w-xl">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-xl font-semibold mb-2">New Default Attribute</h2>
            <p class="text-sm text-ink-muted mb-6">Reusable attribute values (e.g. colors, sizes) vendors can reference when listing products.</p>

            <form action="{{ route('attribute.create') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="attribute_value" class="block text-sm font-medium text-ink mb-1.5">Attribute Value</label>
                    <input type="text" name="attribute_value" id="attribute_value" value="{{ old('attribute_value') }}"
                        placeholder="Red"
                        class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                        Add Attribute
                    </button>
                    <a href="{{ route('productattribute.manage') }}" class="text-sm font-medium text-ink-muted hover:text-accent transition-colors duration-200">
                        View all attributes
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
