<x-admin-layout active="attribute" title="Add Attribute">
    <div class="max-w-xl">
        <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 sm:p-8">
            <h2 class="text-lg font-semibold mb-2">New Default Attribute</h2>
            <p class="text-sm text-admin-ink-muted mb-6">Reusable attribute values (e.g. colors, sizes) vendors can reference when listing products.</p>

            <form action="{{ route('attribute.create') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="attribute_value" class="block text-sm font-medium mb-1.5">Attribute Value</label>
                    <input type="text" name="attribute_value" id="attribute_value" value="{{ old('attribute_value') }}"
                        placeholder="Red"
                        class="w-full rounded-lg border border-admin-border bg-admin-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-admin-accent/30 focus:border-admin-accent">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-admin-accent text-white text-sm font-medium px-6 py-2.5 hover:bg-admin-accent-dark transition-colors duration-200">
                        Add Attribute
                    </button>
                    <a href="{{ route('productattribute.manage') }}" class="text-sm font-medium text-admin-ink-muted hover:text-admin-accent transition-colors duration-200">
                        View all attributes
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
