<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#ffffff">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=cormorant-garamond:500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#1a2332] antialiased bg-white">
        <div class="min-h-screen grid lg:grid-cols-2 overflow-hidden">
            {{-- Form panel --}}
            <div class="flex flex-col items-center justify-center px-6 py-12 sm:px-12 relative z-10">
                <div class="w-full max-w-sm">
                    <a href="{{ route('storefront.home') }}" class="lg:hidden font-display text-2xl font-semibold tracking-wide mb-10 inline-block text-[#0f766e] auth-enter auth-enter-1">
                        Northgate &amp; Co.
                    </a>

                    {{ $slot }}
                </div>
            </div>

            {{-- Blob panel --}}
            <div class="hidden lg:block relative overflow-hidden bg-[#f4fbfa]">
                <div class="absolute -right-40 -top-24 -bottom-24 w-[46rem] rounded-full bg-gradient-to-br from-[#14b8a6] via-[#0ea5a4] to-[#2563eb] auth-blob-pulse"></div>
                <div class="absolute -right-56 top-1/4 w-[30rem] h-[30rem] rounded-full bg-gradient-to-br from-[#5eead4]/40 to-[#3b82f6]/40 blur-2xl auth-float-a"></div>

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
                        <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-white text-[#0f766e] px-6 py-2.5 rounded-full font-medium text-sm hover:bg-white/90 transition-colors duration-300">
                            Shop now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
