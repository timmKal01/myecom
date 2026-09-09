@extends('storefront.layouts.app')

@section('title', ($activeCategory->category_name ?? 'Shop All') . ' — Northgate & Co.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <nav class="text-xs text-ink-muted mb-4">
            <a href="{{ route('storefront.home') }}" class="hover:text-accent">Home</a>
            <span class="mx-1.5">/</span>
            <span class="text-ink">{{ $activeCategory->category_name ?? 'Shop All' }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <h1 class="font-display text-4xl font-semibold">{{ $activeCategory->category_name ?? 'Shop All' }}</h1>
            <p class="text-sm text-ink-muted">{{ $products->total() }} {{ Str::plural('item', $products->total()) }}</p>
        </div>

        {{-- Category pills --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-8 -mx-1 px-1">
            <a
                href="{{ route('storefront.products.index', request()->except(['category', 'page'])) }}"
                class="shrink-0 text-sm font-medium px-4 py-2 rounded-full border transition-colors duration-200 {{ ! $activeCategory ? 'bg-ink-solid text-white border-ink-solid' : 'border-line text-ink hover:border-ink' }}"
            >
                All Categories
            </a>
            @foreach ($categories as $category)
                <a
                    href="{{ route('storefront.products.index', array_merge(request()->except(['category', 'page']), ['category' => $category->id])) }}"
                    class="shrink-0 text-sm font-medium px-4 py-2 rounded-full border transition-colors duration-200 {{ $activeCategory && $activeCategory->id === $category->id ? 'bg-ink-solid text-white border-ink-solid' : 'border-line text-ink hover:border-ink' }}"
                >
                    {{ $category->category_name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-10">
            {{-- Filters --}}
            <aside>
                <form
                    action="{{ route('storefront.products.index') }}"
                    method="GET"
                    x-data="{
                        boundMin: {{ $priceBounds['min'] }},
                        boundMax: {{ max($priceBounds['max'], $priceBounds['min'] + 1) }},
                        min: {{ (int) request('min_price', $priceBounds['min']) }},
                        max: {{ (int) request('max_price', $priceBounds['max']) }},
                    }"
                    class="space-y-8"
                >
                    @foreach (request()->except(['min_price', 'max_price', 'brand', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-xs uppercase tracking-widest text-ink-muted">Price Range</p>
                            @if (request()->hasAny(['min_price', 'max_price']))
                                <a href="{{ route('storefront.products.index', request()->except(['min_price', 'max_price', 'page'])) }}" class="text-xs text-accent hover:underline">Reset</a>
                            @endif
                        </div>

                        <div class="flex items-center justify-between text-sm font-medium mb-3">
                            <span>$<span x-text="min"></span></span>
                            <span>$<span x-text="max"></span></span>
                        </div>

                        <div class="relative h-1 mb-1">
                            <div class="absolute inset-0 rounded-full bg-line"></div>
                            <div
                                class="absolute h-1 rounded-full bg-accent"
                                :style="`left: ${(min - boundMin) / (boundMax - boundMin) * 100}%; right: ${100 - (max - boundMin) / (boundMax - boundMin) * 100}%`"
                            ></div>
                            <input
                                type="range" :min="boundMin" :max="boundMax" x-model.number="min"
                                @input="if (min > max) min = max" @change="$el.closest('form').submit()"
                                class="range-thumb absolute inset-0 w-full h-1 pointer-events-none"
                            >
                            <input
                                type="range" :min="boundMin" :max="boundMax" x-model.number="max"
                                @input="if (max < min) max = min" @change="$el.closest('form').submit()"
                                class="range-thumb absolute inset-0 w-full h-1 pointer-events-none"
                            >
                        </div>
                        <input type="hidden" name="min_price" :value="min">
                        <input type="hidden" name="max_price" :value="max">
                    </div>

                    @if ($brands->isNotEmpty())
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-xs uppercase tracking-widest text-ink-muted">Brand</p>
                                @if (request('brand'))
                                    <a href="{{ route('storefront.products.index', request()->except(['brand', 'page'])) }}" class="text-xs text-accent hover:underline">Reset</a>
                                @endif
                            </div>
                            <ul class="space-y-2.5">
                                @foreach ($brands as $brand)
                                    <li class="flex items-center gap-2.5">
                                        <input
                                            type="checkbox" name="brand[]" id="brand-{{ Str::slug($brand->brand) }}" value="{{ $brand->brand }}"
                                            onchange="this.form.submit()"
                                            @checked(in_array($brand->brand, (array) request('brand', [])))
                                            class="rounded border-line text-accent focus:ring-accent/40"
                                        >
                                        <label for="brand-{{ Str::slug($brand->brand) }}" class="text-sm text-ink cursor-pointer">
                                            {{ $brand->brand }} <span class="text-ink-muted">({{ $brand->products_count }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <noscript><button type="submit" class="text-sm font-medium text-accent">Apply filters</button></noscript>
                </form>
            </aside>

            {{-- Grid --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-ink-muted hidden sm:block">
                        @if (request('q'))
                            Results for &ldquo;{{ request('q') }}&rdquo;
                        @endif
                    </p>
                    <form action="{{ route('storefront.products.index') }}" method="GET" class="flex items-center gap-2 ml-auto">
                        @foreach (request()->except(['sort', 'page']) as $key => $value)
                            @if (is_array($value))
                                @foreach ($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <label for="sort" class="text-xs text-ink-muted">Sort by</label>
                        <select
                            id="sort"
                            name="sort"
                            onchange="this.form.submit()"
                            class="text-sm border border-line rounded-lg py-2 pl-3 pr-8 bg-surface focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                        >
                            <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest</option>
                            <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                            <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                            <option value="name" @selected(request('sort') === 'name')>Name A–Z</option>
                        </select>
                    </form>
                </div>

                @if ($products->isEmpty())
                    <div class="text-center py-24 border border-dashed border-line rounded-xl">
                        <p class="font-display text-2xl mb-2">Nothing here yet</p>
                        <p class="text-ink-muted mb-6">Try a different category, brand, or price range.</p>
                        <a href="{{ route('storefront.products.index') }}" class="text-accent font-medium hover:text-accent-dark">Clear filters</a>
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-6 gap-y-10">
                        @foreach ($products as $product)
                            @include('storefront.partials.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
