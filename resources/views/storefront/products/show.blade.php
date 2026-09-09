@extends('storefront.layouts.app')

@section('title', $product->product_name . ' — Northgate & Co.')
@section('meta_description', Str::limit(strip_tags($product->description), 155))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <nav class="text-xs text-ink-muted mb-8">
            <a href="{{ route('storefront.home') }}" class="hover:text-accent">Home</a>
            <span class="mx-1.5">/</span>
            <a href="{{ route('storefront.products.index', ['category' => $product->category_id]) }}" class="hover:text-accent">
                {{ $product->category->category_name ?? 'Shop' }}
            </a>
            <span class="mx-1.5">/</span>
            <span class="text-ink">{{ $product->product_name }}</span>
        </nav>

        @if ($errors->any())
            <div class="mb-8 border border-red-300 bg-red-50 text-red-700 text-sm rounded-lg px-4 py-3">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Image --}}
            <div class="aspect-square bg-surface border border-line rounded-xl overflow-hidden">
                @if ($product->primary_image)
                    <img
                        src="{{ asset('storage/' . $product->primary_image->img_path) }}"
                        alt="{{ $product->product_name }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center text-ink-muted">No image available</div>
                @endif
            </div>

            {{-- Details --}}
            <div>
                <p class="text-xs uppercase tracking-widest text-ink-muted mb-2">{{ $product->category->category_name ?? '' }}</p>
                <h1 class="font-display text-4xl font-semibold mb-4">{{ $product->product_name }}</h1>

                <div class="flex items-center gap-3 mb-6">
                    <span class="text-2xl font-semibold text-ink">${{ number_format($product->final_price, 2) }}</span>
                    @if ($product->is_on_sale)
                        <span class="text-lg text-ink-muted line-through">${{ number_format($product->regular_price, 2) }}</span>
                        <span class="bg-accent/10 text-accent-dark text-xs font-semibold px-2.5 py-1 rounded-full">
                            Save {{ $product->discount_percent }}%
                        </span>
                    @endif
                </div>

                <p class="text-ink-muted leading-relaxed mb-8">{{ $product->description }}</p>

                <div class="flex items-center gap-2 text-sm mb-8">
                    <span class="w-2 h-2 rounded-full {{ $product->stock_status === 'In Stock' ? 'bg-green-600' : 'bg-red-500' }}"></span>
                    <span class="{{ $product->stock_status === 'In Stock' ? 'text-ink' : 'text-red-600' }}">
                        {{ $product->stock_status }}
                    </span>
                    @if ($product->stock_status === 'In Stock')
                        <span class="text-ink-muted">&middot; {{ $product->stock_quantity }} available</span>
                    @endif
                </div>

                @if ($product->stock_status === 'In Stock')
                    <form action="{{ route('storefront.cart.add', $product) }}" method="POST" class="flex items-center gap-4 mb-8">
                        @csrf
                        <label for="quantity" class="sr-only">Quantity</label>
                        <select
                            id="quantity"
                            name="quantity"
                            class="border border-line rounded-lg py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                        >
                            @for ($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                <option value="{{ $i }}">Qty: {{ $i }}</option>
                            @endfor
                        </select>
                        <button
                            type="submit"
                            class="flex-1 bg-ink-solid text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300"
                        >
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button type="button" disabled class="w-full bg-line text-ink-muted px-8 py-3.5 rounded-full font-medium cursor-not-allowed mb-8">
                        Out of Stock
                    </button>
                @endif

                <dl class="border-t border-line pt-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-ink-muted">SKU</dt>
                        <dd class="text-ink">{{ $product->sku }}</dd>
                    </div>
                    @if ($product->subcategory)
                        <div class="flex justify-between">
                            <dt class="text-ink-muted">Type</dt>
                            <dd class="text-ink">{{ $product->subcategory->subcategory_name }}</dd>
                        </div>
                    @endif
                    @if ($product->store)
                        <div class="flex justify-between">
                            <dt class="text-ink-muted">Sold by</dt>
                            <dd class="text-ink">{{ $product->store->store_name }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        {{-- Related products --}}
        @if ($relatedProducts->isNotEmpty())
            <section class="mt-24">
                <h2 class="font-display text-3xl font-semibold mb-6">You may also like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-10">
                    @foreach ($relatedProducts as $related)
                        @include('storefront.partials.product-card', ['product' => $related])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
