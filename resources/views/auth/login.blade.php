<x-guest-layout>
    <div class="auth-enter auth-enter-2">
        <h1 class="font-display text-3xl font-semibold mb-2">Welcome back</h1>
        <p class="text-sm text-ink-muted mb-8">Sign in to continue to your account.</p>
    </div>

    <x-auth-session-status class="mb-4 auth-enter auth-enter-2" :status="session('status')" />

    <div class="auth-enter auth-enter-2">
        @include('auth.partials.social-buttons')
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5 auth-enter auth-enter-3">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-ink mb-1.5">Email</label>
            <input
                id="email" type="email" name="email" value="{{ old('email') }}"
                required autofocus autocomplete="username"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('email') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-ink">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-accent hover:text-accent-dark transition-colors duration-200">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input
                id="password" type="password" name="password"
                required autocomplete="current-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('password') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <label for="remember_me" class="flex items-center gap-2 cursor-pointer select-none">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-line text-accent focus:ring-accent/40">
            <span class="text-sm text-ink-muted">Remember me</span>
        </label>

        <button
            type="submit"
            class="w-full bg-ink text-white py-3 rounded-full font-medium hover:bg-accent transition-colors duration-300"
        >
            Log in
        </button>
    </form>

    <p class="text-sm text-ink-muted text-center mt-8 auth-enter auth-enter-4">
        New to Northgate &amp; Co.?
        <a href="{{ route('register') }}" class="text-accent font-medium hover:text-accent-dark transition-colors duration-200">
            Create an account
        </a>
    </p>
</x-guest-layout>
