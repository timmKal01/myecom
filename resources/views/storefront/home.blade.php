@extends('storefront.layouts.app')

@section('title', 'Northgate & Co. — Considered goods for everyday life')

@section('content')

    {{-- Hero --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-20 grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-accent font-medium mb-4">New season, considered goods</p>
            <h1 class="font-display text-5xl md:text-6xl font-semibold leading-[1.05] mb-6">
                Made to last, <br class="hidden md:block">not just to look good.
            </h1>
            <p class="text-ink-muted text-lg max-w-md mb-8 leading-relaxed">
                Electronics, fashion, and home goods chosen for how they hold up —
                curated by a small team of people who use them daily.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-ink text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300">
                    Shop the collection
                </a>
                <a href="#featured" class="inline-flex items-center justify-center border border-line px-8 py-3.5 rounded-full font-medium hover:border-ink transition-colors duration-300">
                    See what's new
                </a>
            </div>
        </div>
        <div class="relative aspect-[4/3] rounded-2xl overflow-hidden border border-line bg-gradient-to-br from-[#EFDFE0] to-[#D9B8BC] flex items-center justify-center">
            <p class="font-display italic text-2xl text-[#5A3A3E]/70 px-10 text-center">
                &ldquo;Northgate &amp; Co. — considered goods, chosen well.&rdquo;
            </p>
        </div>
    </section>

    {{-- Category strip --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="flex items-baseline justify-between mb-6">
            <h2 class="font-display text-3xl font-semibold">Shop by category</h2>
            <a href="{{ route('storefront.products.index') }}" class="text-sm font-medium text-accent hover:text-accent-dark transition-colors duration-200">View all &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($categories as $category)
                <a
                    href="{{ route('storefront.products.index', ['category' => $category->id]) }}"
                    class="group border border-line rounded-xl p-6 text-center bg-surface hover:border-accent hover:shadow-md transition-all duration-300"
                >
                    <p class="font-medium text-ink group-hover:text-accent transition-colors duration-200">{{ $category->category_name }}</p>
                    <p class="text-xs text-ink-muted mt-1">{{ $category->products_count }} items</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured products --}}
    <section id="featured" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="flex items-baseline justify-between mb-6">
            <h2 class="font-display text-3xl font-semibold">Newly arrived</h2>
            <a href="{{ route('storefront.products.index') }}" class="text-sm font-medium text-accent hover:text-accent-dark transition-colors duration-200">Shop all &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
            @foreach ($featuredProducts as $product)
                @include('storefront.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    {{-- On sale --}}
    @if ($saleProducts->isNotEmpty())
        <section class="bg-ink text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between mb-8">
                    <h2 class="font-display text-3xl font-semibold">Currently on sale</h2>
                    <p class="text-sm text-white/50">While stock lasts</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-10">
                    @foreach ($saleProducts as $product)
                        <div class="[&_p]:text-white/60 [&_h3]:text-white [&_span]:text-white [&_.bg-surface]:bg-white/5 [&_.border-line]:border-white/15">
                            @include('storefront.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Trust strip --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
        <div>
            <p class="font-display text-xl font-semibold mb-1">Free shipping</p>
            <p class="text-sm text-ink-muted">On every order over $75</p>
        </div>
        <div>
            <p class="font-display text-xl font-semibold mb-1">Considered returns</p>
            <p class="text-sm text-ink-muted">30 days, no questions asked</p>
        </div>
        <div>
            <p class="font-display text-xl font-semibold mb-1">Real people</p>
            <p class="text-sm text-ink-muted">A small team behind every order</p>
        </div>
    </section>

@endsection
