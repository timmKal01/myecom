<x-guest-layout>
    <div class="auth-enter auth-enter-2">
        <h1 class="font-display text-3xl font-bold text-white mb-2">Welcome Back!</h1>
        <p class="text-sm text-white/50 mb-8">Sign in to continue to Northgate &amp; Co.</p>
    </div>

    <x-auth-session-status class="mb-4 auth-enter auth-enter-2" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4 auth-enter auth-enter-3">
        @csrf

        <div>
            <label for="email" class="block text-xs font-medium text-white/60 mb-1.5 uppercase tracking-wide">Email Address</label>
            <input
                id="email" type="email" name="email" value="{{ old('email') }}"
                required autofocus autocomplete="username" placeholder="you@example.com"
                class="w-full rounded-full bg-white/5 border border-white/10 py-3 px-5 text-sm text-white placeholder-white/25 focus:outline-none focus:ring-2 focus:ring-[#F0479E]/50 focus:border-[#F0479E]/50 transition-colors duration-200"
            >
            @error('email') <p class="text-xs text-red-400 mt-1.5 px-1">{{ $message }}</p> @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="block text-xs font-medium text-white/60 mb-1.5 uppercase tracking-wide">Password</label>
            <div class="relative">
                <input
                    id="password" :type="show ? 'text' : 'password'" name="password"
                    required autocomplete="current-password" placeholder="••••••••"
                    class="w-full rounded-full bg-white/5 border border-white/10 py-3 pl-5 pr-12 text-sm text-white placeholder-white/25 focus:outline-none focus:ring-2 focus:ring-[#F0479E]/50 focus:border-[#F0479E]/50 transition-colors duration-200"
                >
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/35 hover:text-white/70 transition-colors duration-200" aria-label="Toggle password visibility">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="text-xs text-red-400 mt-1.5 px-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between text-sm pt-1">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer select-none text-white/50">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/20 bg-white/5 text-[#F0479E] focus:ring-[#F0479E]/50">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-white/50 hover:text-white transition-colors duration-200">
                    Forgot Password?
                </a>
            @endif
        </div>

        <button
            type="submit"
            class="w-full rounded-full bg-gradient-to-r from-[#FF7A45] via-[#F0479E] to-[#8B5CF6] text-white font-semibold py-3.5 mt-2 hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-[#F0479E]/20"
        >
            Log In
        </button>
    </form>

    <div class="flex items-center gap-3 my-6 auth-enter auth-enter-3">
        <div class="flex-1 h-px bg-white/10"></div>
        <span class="text-xs text-white/30 uppercase tracking-wider">Or</span>
        <div class="flex-1 h-px bg-white/10"></div>
    </div>

    <div class="auth-enter auth-enter-4">
        @include('auth.partials.social-buttons')
    </div>

    <p class="text-sm text-white/50 text-center mt-8 auth-enter auth-enter-4">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-white font-medium hover:text-[#F0479E] transition-colors duration-200">
            Sign Up
        </a>
    </p>
</x-guest-layout>
