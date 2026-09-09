@php
    $icons = [
        'home' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75',
        'tag' => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.169.659 1.591l9.581 9.581c.699.699 1.831.699 2.53 0l4.318-4.318a1.79 1.79 0 000-2.53L10.909 3.659A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z',
        'sliders' => 'M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0 1.5 1.5 0 013 0zM3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0 1.5 1.5 0 013 0zM3.75 12H13.5',
        'percent' => 'M21 12a9 9 0 11-18 0 9 9 0 0118 0zM8.25 15.75l7.5-7.5M9 9h.008v.008H9V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM15 15h.008v.008H15V15zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        'box' => 'M20.25 7.5l-8.25 4.5L3.75 7.5M20.25 7.5l-8.25-4.5L3.75 7.5M20.25 7.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9M3.75 7.5v9l8.25 4.5',
        'star' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 21.539a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
        'receipt' => 'M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM14.25 12h.008v.008h-.008V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        'cart' => 'M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.885-4.788 2.244-7.394a1.09 1.09 0 0 0-1.089-1.226H5.25M7.5 14.25 5.106 5.272M6.75 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z',
        'users' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
        'building' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21',
        'cog' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.71 6.71 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281zM15 12a3 3 0 11-6 0 3 3 0 016 0z',
        'search' => 'm21 21-4.35-4.35M18 10.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} — {{ config('app.name') }} Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @include('partials.theme-init')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-admin-canvas text-admin-ink" x-data="{ sidebarOpen: false }">

    <div class="lg:hidden sticky top-0 z-40 flex items-center justify-between h-16 px-4 bg-admin-surface border-b border-admin-border">
        <button class="p-2 -ml-2 text-admin-ink" @click="sidebarOpen = true" aria-label="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>
        <span class="font-semibold tracking-tight">{{ $title }}</span>
        <div class="w-8 h-8 rounded-full bg-admin-accent text-white flex items-center justify-center text-xs font-semibold">
            {{ $initials }}
        </div>
    </div>

    <div class="lg:flex">
        <div
            x-show="sidebarOpen"
            x-cloak
            class="fixed inset-0 z-40 bg-admin-ink/40 lg:hidden"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <aside
            class="fixed lg:sticky top-0 left-0 z-50 lg:z-0 h-screen w-72 bg-admin-surface border-r border-admin-border flex flex-col shrink-0 transition-transform duration-200 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex items-center justify-between px-5 h-16 border-b border-admin-border shrink-0">
                <a href="{{ route('admin') }}" class="flex items-center gap-2.5 min-w-0">
                    <span class="w-8 h-8 rounded-lg bg-admin-accent text-white flex items-center justify-center text-sm font-bold shrink-0">N</span>
                    <span class="font-semibold tracking-tight truncate">Northgate & Co.</span>
                </a>
                <button class="lg:hidden p-1 text-admin-ink-muted" @click="sidebarOpen = false" aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('product.manage') }}" method="GET" class="px-4 pt-4 shrink-0">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-admin-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons['search'] }}" />
                    </svg>
                    <input
                        type="search" name="q" value="{{ request('q') }}"
                        placeholder="Search products…"
                        class="w-full rounded-lg border border-admin-border bg-admin-canvas pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-admin-accent/30 focus:border-admin-accent"
                    >
                </div>
            </form>

            <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-5">
                @foreach ($navGroups as $group)
                    <div>
                        @if ($group['label'])
                            <p class="px-3 mb-1.5 text-xs font-semibold uppercase tracking-wider text-admin-ink-muted">{{ $group['label'] }}</p>
                        @endif
                        <div class="space-y-0.5">
                            @foreach ($group['items'] as $item)
                                @php $isActive = $active === $item['key']; @endphp
                                <a
                                    href="{{ route($item['route']) }}"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150 {{ $isActive ? 'bg-admin-accent-soft text-admin-accent' : 'text-admin-ink-muted hover:bg-admin-canvas hover:text-admin-ink' }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$item['icon']] ?? $icons['home'] }}" />
                                    </svg>
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>

            <div class="px-4 pb-4 shrink-0">
                <a
                    href="{{ route('admin.setting') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150 {{ $active === 'settings' ? 'bg-admin-accent-soft text-admin-accent' : 'text-admin-ink-muted hover:bg-admin-canvas hover:text-admin-ink' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons['cog'] }}" />
                    </svg>
                    Settings
                </a>
            </div>

            <div class="px-4 py-4 border-t border-admin-border shrink-0">
                <div class="flex items-center gap-3 px-1 mb-3">
                    <div class="w-9 h-9 rounded-full bg-admin-accent text-white flex items-center justify-center text-sm font-semibold shrink-0">
                        {{ $initials }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium truncate">{{ Auth::user()?->name }}</p>
                        <p class="text-xs text-admin-ink-muted">Administrator</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('storefront.home') }}" class="text-center rounded-lg border border-admin-border text-xs font-medium py-2 text-admin-ink-muted hover:bg-admin-canvas transition-colors duration-150">
                        Storefront
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center rounded-lg border border-admin-border text-xs font-medium py-2 text-admin-ink-muted hover:bg-admin-canvas transition-colors duration-150">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 min-w-0">
            <div class="hidden lg:flex items-center justify-between h-16 px-8 border-b border-admin-border bg-admin-surface sticky top-0 z-30">
                <h1 class="text-xl font-semibold tracking-tight">{{ $title }}</h1>
                <div class="flex items-center gap-4">
                    <p class="text-sm text-admin-ink-muted">{{ now()->format('l, F j, Y') }}</p>
                    @include('partials.theme-toggle', ['class' => 'text-admin-ink-muted hover:text-admin-ink'])
                </div>
            </div>

            @if (session('success'))
                <div class="bg-admin-positive-soft border-b border-admin-positive/20 text-admin-positive text-sm text-center py-2.5 px-4 font-medium" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-admin-negative-soft border-b border-admin-negative/20 text-admin-negative text-sm py-3 px-8">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <main class="px-4 sm:px-6 lg:px-8 py-8 max-w-7xl">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
