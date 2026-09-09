<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=cormorant-garamond:500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased">
        <div class="min-h-screen grid lg:grid-cols-2 bg-canvas">
            {{-- Brand panel --}}
            <div class="hidden lg:flex relative overflow-hidden items-center justify-center p-12 auth-panel-bg bg-gradient-to-br from-[#EFDFE0] via-[#E3CACB] to-[#D9B8BC]">
                <div class="absolute w-64 h-64 rounded-full bg-white/20 blur-3xl -top-10 -left-10 auth-float-a"></div>
                <div class="absolute w-72 h-72 rounded-full bg-white/15 blur-3xl bottom-0 right-0 auth-float-b"></div>

                <div class="relative max-w-sm text-center auth-enter auth-enter-1">
                    <a href="{{ route('storefront.home') }}" class="font-display text-3xl font-semibold tracking-wide text-[#3E2224] inline-block mb-8">
                        Northgate <span class="text-[#8a4a4f]">&amp;</span> Co.
                    </a>
                    <p class="font-display italic text-2xl text-[#5A3A3E]/80 leading-snug">
                        &ldquo;Considered goods, chosen well — made to last, not just to look good.&rdquo;
                    </p>
                </div>
            </div>

            {{-- Form panel --}}
            <div class="flex flex-col items-center justify-center px-6 py-12 sm:px-12">
                <div class="w-full max-w-sm">
                    <a href="{{ route('storefront.home') }}" class="lg:hidden font-display text-2xl font-semibold tracking-wide mb-10 inline-block auth-enter auth-enter-1">
                        Northgate <span class="text-accent">&amp;</span> Co.
                    </a>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
