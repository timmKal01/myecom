<div class="space-y-5">
    <div>
        <label for="category_id" class="block text-sm font-medium text-ink mb-1.5">Category</label>
        <select id="category_id" name="category_id" wire:model.live="selectedCategory"
            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="subcategory_id" class="block text-sm font-medium text-ink mb-1.5">Subcategory</label>
        <select id="subcategory_id" name="subcategory_id"
            class="w-full rounded-lg border border-line bg-surface px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent">
            <option value="">Select a subcategory</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
            @endforeach
        </select>
    </div>
</div>
