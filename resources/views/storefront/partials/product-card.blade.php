@php
    $image = $product->primary_image;
@endphp

<a href="{{ route('storefront.products.show', $product->slug) }}" class="group block">
    <div class="relative aspect-square bg-surface border border-line rounded-lg overflow-hidden mb-3">
        @if ($image)
            <img
                src="{{ asset('storage/' . $image->img_path) }}"
                alt="{{ $product->product_name }}"
                loading="lazy"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
            >
        @else
            <div class="w-full h-full flex items-center justify-center text-ink-muted text-sm">No image</div>
        @endif

        @if ($product->is_on_sale)
            <span class="absolute top-3 left-3 bg-accent text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                -{{ $product->discount_percent }}%
            </span>
        @endif

        @if ($product->stock_status !== 'In Stock')
            <span class="absolute top-3 right-3 bg-ink/80 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                {{ $product->stock_status }}
            </span>
        @endif
    </div>

    <p class="text-[11px] uppercase tracking-wider text-ink-muted mb-1">{{ $product->category->category_name ?? '' }}</p>
    <h3 class="font-medium text-ink leading-snug mb-1 group-hover:text-accent transition-colors duration-200">
        {{ $product->product_name }}
    </h3>
    <div class="flex items-center gap-2">
        <span class="font-semibold text-ink">${{ number_format($product->final_price, 2) }}</span>
        @if ($product->is_on_sale)
            <span class="text-sm text-ink-muted line-through">${{ number_format($product->regular_price, 2) }}</span>
        @endif
    </div>
</a>
