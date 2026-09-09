<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('partials.theme-init')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased bg-surface">
        <div class="min-h-screen grid lg:grid-cols-2 overflow-hidden">
            {{-- Form panel --}}
            <div class="flex flex-col items-center justify-center px-6 py-12 sm:px-12 relative z-10">
                <div class="w-full max-w-sm">
                    <div class="flex items-center justify-between mb-10 lg:hidden">
                        <a href="{{ route('storefront.home') }}" class="font-display text-2xl font-semibold tracking-wide text-accent auth-enter auth-enter-1">
                            Northgate &amp; Co.
                        </a>
                        @include('partials.theme-toggle')
                    </div>

                    <div class="hidden lg:flex justify-end mb-6">
                        @include('partials.theme-toggle')
                    </div>

                    {{ $slot }}
                </div>
            </div>

            {{-- Blob panel --}}
            <div class="hidden lg:block relative overflow-hidden bg-canvas">
                <div class="absolute -right-40 -top-24 -bottom-24 w-[46rem] rounded-full bg-gradient-to-br from-accent to-accent-dark auth-blob-pulse"></div>
                <div class="absolute -right-56 top-1/4 w-[30rem] h-[30rem] rounded-full bg-gradient-to-br from-accent/40 to-accent-dark/40 blur-2xl auth-float-a"></div>

                <div class="relative h-full flex flex-col justify-center px-16 xl:px-24">
                    <div class="max-w-sm auth-enter auth-enter-2">
                        <a href="{{ route('storefront.home') }}" class="font-display text-2xl font-semibold tracking-wide text-white inline-block mb-8">
                            Northgate &amp; Co.
                        </a>
                        <p class="font-display text-4xl font-semibold text-white leading-tight mb-4">
                            Considered goods, chosen well.
                        </p>
                        <p class="text-white/80 leading-relaxed mb-8">
                            Electronics, fashion, and home goods chosen for how they hold up —
                            sign in for order tracking, saved favourites, and a faster checkout.
                        </p>
                        <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-white text-accent-dark px-6 py-2.5 rounded-full font-medium text-sm hover:bg-white/90 transition-colors duration-300">
                            Shop now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
