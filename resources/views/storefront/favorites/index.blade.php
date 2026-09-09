@extends('storefront.layouts.app')

@section('title', 'Your Favourites — Northgate & Co.')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <h1 class="font-display text-4xl font-semibold">Your Favourites</h1>
            <p class="text-sm text-ink-muted">{{ $products->count() }} {{ Str::plural('item', $products->count()) }}</p>
        </div>

        @if ($products->isEmpty())
            <div class="text-center py-24 border border-dashed border-line rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                <p class="font-display text-2xl mb-2">Nothing saved yet</p>
                <p class="text-ink-muted mb-6">Tap the heart on any product to save it here.</p>
                <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-ink-solid text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300">
                    Browse products
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-6 gap-y-10">
                @foreach ($products as $product)
                    @include('storefront.partials.product-card', ['product' => $product, 'favoritedIds' => $products->pluck('id')->all()])
                @endforeach
            </div>
        @endif
    </div>
@endsection
