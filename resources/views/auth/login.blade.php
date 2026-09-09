<x-guest-layout>
    <div class="auth-enter auth-enter-2">
        <h1 class="font-display text-4xl font-bold mb-8 bg-gradient-to-r from-accent to-accent-dark bg-clip-text text-transparent">
            Log in
        </h1>
    </div>

    <x-auth-session-status class="mb-4 auth-enter auth-enter-2" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5 auth-enter auth-enter-3">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-ink mb-1.5">Email address</label>
            <input
                id="email" type="email" name="email" value="{{ old('email') }}"
                required autofocus autocomplete="username" placeholder="abc@xyz.com"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm text-ink bg-surface placeholder-ink-muted/50 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-colors duration-200"
            >
            @error('email') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-ink mb-1.5">Password</label>
            <div class="relative" x-data="{ show: false }">
                <input
                    id="password" :type="show ? 'text' : 'password'" name="password"
                    required autocomplete="current-password" placeholder="••••••••••"
                    class="w-full border border-line rounded-lg py-2.5 px-4 pr-11 text-sm text-ink bg-surface placeholder-ink-muted/50 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent transition-colors duration-200"
                >
                <button type="button" @click="show = !show" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-ink-muted hover:text-ink transition-colors duration-200" aria-label="Toggle password visibility">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-line text-accent focus:ring-accent/30">
                <span class="font-medium text-ink">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-medium text-ink hover:text-accent-dark transition-colors duration-200">
                    Forgot Password ?
                </a>
            @endif
        </div>

        <button
            type="submit"
            class="w-full rounded-full bg-gradient-to-r from-accent to-accent-dark text-white font-semibold py-3 hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-accent/20"
        >
            Log in
        </button>
    </form>

    <div class="auth-enter auth-enter-4">
        <p class="text-center text-sm font-medium text-ink mt-8 mb-4">Or connect with</p>
        @include('auth.partials.social-buttons')

        <p class="text-sm text-center text-ink-muted mt-8">
            Don't have an account ?
            <a href="{{ route('register') }}" class="font-semibold text-ink hover:text-accent-dark transition-colors duration-200">
                Sign up
            </a>
        </p>
    </div>
</x-guest-layout>
