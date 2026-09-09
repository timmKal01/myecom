@php
    $roleHome = match (auth()->user()?->role) {
        0 => 'admin',
        1 => 'vendor',
        default => 'dashboard',
    };
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $header ?? 'Account' }} — {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('partials.theme-init')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased bg-canvas">
        <header class="sticky top-0 z-30 bg-canvas/90 backdrop-blur border-b border-line">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="{{ route('storefront.home') }}" class="font-display text-xl font-semibold tracking-wide">
                    Northgate <span class="text-accent">&amp;</span> Co.
                </a>
                <div class="flex items-center gap-4 text-sm">
                    @include('partials.theme-toggle')

                    <a href="{{ route($roleHome) }}" class="text-ink-muted hover:text-accent transition-colors duration-200">
                        Back to Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-ink-muted hover:text-accent transition-colors duration-200">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @if (isset($header))
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
                <h1 class="font-display text-3xl font-semibold">{{ $header }}</h1>
            </div>
        @endif

        <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            {{ $slot }}
        </main>
    </body>
</html>
