<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Considered goods for everyday life — electronics, fashion, and home, chosen for how they hold up.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @include('partials.theme-init')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-canvas text-ink" x-data="{ mobileMenuOpen: false }">

    <div class="bg-ink-solid text-white text-center text-xs py-2 px-4">
        Free shipping on orders over $75 — arrives in 3–5 business days.
    </div>

    <header class="sticky top-0 z-40 bg-canvas/90 backdrop-blur border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-6">
                <button
                    class="lg:hidden p-2 -ml-2 text-ink"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    aria-label="Toggle menu"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                    </svg>
                </button>

                <a href="{{ route('storefront.home') }}" class="font-display text-2xl md:text-3xl font-semibold tracking-wide shrink-0">
                    Northgate <span class="text-accent">&amp;</span> Co.
                </a>

                <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('storefront.products.index') }}" class="hover:text-accent transition-colors duration-200">Shop All</a>
                    @foreach (\App\Models\Category::orderBy('category_name')->get() as $navCategory)
                        <a href="{{ route('storefront.products.index', ['category' => $navCategory->id]) }}" class="hover:text-accent transition-colors duration-200">
                            {{ $navCategory->category_name }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-4 shrink-0">
                    @include('partials.theme-toggle', ['class' => 'text-ink hover:text-accent'])

                    <form action="{{ route('storefront.products.index') }}" method="GET" class="hidden md:flex items-center relative">
                        <input
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search products…"
                            class="w-48 lg:w-64 rounded-full border border-line bg-surface pl-4 pr-9 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                        >
                        <button type="submit" class="absolute right-3 text-ink-muted" aria-label="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M18 10.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                            </svg>
                        </button>
                    </form>

                    <a href="{{ route('storefront.favorites.index') }}" class="relative p-2 text-ink hover:text-accent transition-colors duration-200" aria-label="Favourites">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        @auth
                            @if (\App\Models\Favorite::where('user_id', auth()->id())->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-accent text-white text-[10px] font-semibold w-4.5 h-4.5 min-w-[18px] rounded-full flex items-center justify-center px-1">
                                    {{ \App\Models\Favorite::where('user_id', auth()->id())->count() }}
                                </span>
                            @endif
                        @endauth
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="p-2 text-ink hover:text-accent transition-colors duration-200" aria-label="Account">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="p-2 text-ink hover:text-accent transition-colors duration-200" aria-label="Log in">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    @endauth

                    <a href="{{ route('storefront.cart.index') }}" class="relative p-2 text-ink hover:text-accent transition-colors duration-200" aria-label="Cart, {{ \App\Support\Cart::count() }} items">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.885-4.788 2.244-7.394a1.09 1.09 0 0 0-1.089-1.226H5.25M7.5 14.25 5.106 5.272M6.75 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @if (\App\Support\Cart::count() > 0)
                            <span class="absolute -top-1 -right-1 bg-accent text-white text-[10px] font-semibold w-4.5 h-4.5 min-w-[18px] rounded-full flex items-center justify-center px-1">
                                {{ \App\Support\Cart::count() }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>

            <nav
                x-show="mobileMenuOpen"
                x-cloak
                x-transition
                class="lg:hidden pb-4 flex flex-col gap-3 text-sm font-medium border-t border-line pt-4"
            >
                <a href="{{ route('storefront.products.index') }}" class="hover:text-accent transition-colors duration-200">Shop All</a>
                @foreach (\App\Models\Category::orderBy('category_name')->get() as $navCategory)
                    <a href="{{ route('storefront.products.index', ['category' => $navCategory->id]) }}" class="hover:text-accent transition-colors duration-200">
                        {{ $navCategory->category_name }}
                    </a>
                @endforeach
            </nav>
        </div>
    </header>

    @if (session('success'))
        <div class="bg-accent/10 border-b border-accent/30 text-accent-dark text-sm text-center py-2.5 px-4" role="status">
            {{ session('success') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-ink-solid text-white/80 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="lg:col-span-2">
                <p class="font-display text-2xl text-white font-semibold tracking-wide mb-3">Northgate &amp; Co.</p>
                <p class="text-sm text-white/60 max-w-sm leading-relaxed">
                    Considered goods for everyday life — electronics, fashion, and home,
                    chosen for how they hold up, not just how they photograph.
                </p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-white/50 mb-4">Shop</p>
                <ul class="space-y-2 text-sm">
                    @foreach (\App\Models\Category::orderBy('category_name')->get() as $footerCategory)
                        <li>
                            <a href="{{ route('storefront.products.index', ['category' => $footerCategory->id]) }}" class="hover:text-white transition-colors duration-200">
                                {{ $footerCategory->category_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-white/50 mb-4">Help</p>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('storefront.cart.index') }}" class="hover:text-white transition-colors duration-200">Your Cart</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors duration-200">Order History</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors duration-200">Sign In</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-6 text-center text-xs text-white/40">
            &copy; {{ date('Y') }} Timothy Kalungu. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
