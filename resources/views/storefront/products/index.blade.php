@extends('storefront.layouts.app')

@section('title', ($activeCategory->category_name ?? 'Shop All') . ' — Northgate & Co.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <nav class="text-xs text-ink-muted mb-4">
            <a href="{{ route('storefront.home') }}" class="hover:text-accent">Home</a>
            <span class="mx-1.5">/</span>
            <span class="text-ink">{{ $activeCategory->category_name ?? 'Shop All' }}</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <h1 class="font-display text-4xl font-semibold">{{ $activeCategory->category_name ?? 'Shop All' }}</h1>
            <p class="text-sm text-ink-muted">{{ $products->total() }} {{ Str::plural('item', $products->total()) }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[220px_1fr] gap-10">
            {{-- Filters --}}
            <aside class="space-y-8">
                <div>
                    <p class="text-xs uppercase tracking-widest text-ink-muted mb-3">Category</p>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a
                                href="{{ route('storefront.products.index', request()->except(['category', 'page'])) }}"
                                class="{{ ! $activeCategory ? 'text-accent font-medium' : 'text-ink hover:text-accent' }} transition-colors duration-200"
                            >
                                All Categories
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a
                                    href="{{ route('storefront.products.index', array_merge(request()->except(['category', 'page']), ['category' => $category->id])) }}"
                                    class="{{ $activeCategory && $activeCategory->id === $category->id ? 'text-accent font-medium' : 'text-ink hover:text-accent' }} transition-colors duration-200"
                                >
                                    {{ $category->category_name }} <span class="text-ink-muted">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
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
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
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
                        <p class="text-ink-muted mb-6">Try a different category or search term.</p>
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
