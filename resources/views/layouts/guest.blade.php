<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#0a0a0f">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=cormorant-garamond:500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased bg-[#0a0a0f]">
        <div class="min-h-screen grid lg:grid-cols-2">
            {{-- Visual panel --}}
            <div class="hidden lg:flex relative overflow-hidden flex-col justify-between p-12 bg-[#0a0a0f]">
                <div
                    class="absolute inset-0 auth-panel-bg"
                    style="background-image: radial-gradient(circle at 15% 20%, #FF7A45 0%, transparent 42%), radial-gradient(circle at 85% 25%, #F0479E 0%, transparent 45%), radial-gradient(circle at 50% 85%, #8B5CF6 0%, transparent 50%); opacity: 0.55;"
                ></div>
                <div class="absolute inset-0 bg-[#0a0a0f]/55"></div>
                <div class="absolute w-96 h-96 rounded-full bg-[#FF7A45]/20 blur-3xl -top-24 -left-24 auth-float-a"></div>
                <div class="absolute w-96 h-96 rounded-full bg-[#8B5CF6]/20 blur-3xl -bottom-24 -right-24 auth-float-b"></div>

                <a href="{{ route('storefront.home') }}" class="relative font-display text-2xl font-semibold tracking-wide text-white inline-flex items-center gap-2.5 auth-enter auth-enter-1">
                    <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#FF7A45] via-[#F0479E] to-[#8B5CF6] flex items-center justify-center text-sm font-bold shrink-0">N</span>
                    Northgate &amp; Co.
                </a>

                <div class="relative max-w-md auth-enter auth-enter-2">
                    <p class="font-display text-4xl font-semibold leading-tight mb-4">
                        Considered goods,<br>chosen well.
                    </p>
                    <p class="text-white/55 leading-relaxed">
                        Sign in to pick up where you left off — order history, saved favourites, and a faster checkout.
                    </p>
                </div>
            </div>

            {{-- Form panel --}}
            <div class="flex flex-col items-center justify-center px-6 py-12 sm:px-12 bg-[#0f0f16]">
                <div class="w-full max-w-sm">
                    <a href="{{ route('storefront.home') }}" class="lg:hidden font-display text-2xl font-semibold tracking-wide mb-10 inline-flex items-center gap-2.5 auth-enter auth-enter-1">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#FF7A45] via-[#F0479E] to-[#8B5CF6] flex items-center justify-center text-sm font-bold shrink-0">N</span>
                        Northgate &amp; Co.
                    </a>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
