@php
    $image = $product->primary_image;
    $isFavorited = in_array($product->id, $favoritedIds ?? [], true);
    $isNew = ! $product->is_on_sale && $product->created_at->gt(now()->subDays(14));
@endphp

<div class="group relative">
    <form action="{{ route('storefront.favorites.toggle', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
        @csrf
        <button
            type="submit"
            aria-label="{{ $isFavorited ? 'Remove from favourites' : 'Add to favourites' }}"
            class="w-8 h-8 rounded-full bg-surface/90 backdrop-blur flex items-center justify-center shadow-sm hover:scale-105 transition-transform duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 {{ $isFavorited ? 'text-accent' : 'text-ink-muted' }}" viewBox="0 0 24 24" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
    </form>

    <a href="{{ route('storefront.products.show', $product->slug) }}" class="block">
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
            @elseif ($isNew)
                <span class="absolute top-3 left-3 bg-ink text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                    New
                </span>
            @endif

            @if ($product->stock_status !== 'In Stock')
                <span class="absolute bottom-3 right-3 bg-ink/80 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                    {{ $product->stock_status }}
                </span>
            @endif
        </div>

        <p class="text-[11px] uppercase tracking-wider text-ink-muted mb-1">
            {{ $product->brand ?? ($product->category->category_name ?? '') }}
        </p>
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
</div>
