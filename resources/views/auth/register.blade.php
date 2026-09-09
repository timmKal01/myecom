<x-guest-layout>
    <div class="auth-enter auth-enter-2">
        <h1 class="font-display text-3xl font-semibold mb-2">Create your account</h1>
        <p class="text-sm text-ink-muted mb-8">Join Northgate &amp; Co. for a faster checkout and order tracking.</p>
    </div>

    <div class="auth-enter auth-enter-2">
        @include('auth.partials.social-buttons')
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5 auth-enter auth-enter-3">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-ink mb-1.5">Full name</label>
            <input
                id="name" type="text" name="name" value="{{ old('name') }}"
                required autofocus autocomplete="name"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('name') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-ink mb-1.5">Email</label>
            <input
                id="email" type="email" name="email" value="{{ old('email') }}"
                required autocomplete="username"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('email') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-ink mb-1.5">Password</label>
            <input
                id="password" type="password" name="password"
                required autocomplete="new-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('password') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-ink mb-1.5">Confirm password</label>
            <input
                id="password_confirmation" type="password" name="password_confirmation"
                required autocomplete="new-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('password_confirmation') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-ink text-white py-3 rounded-full font-medium hover:bg-accent transition-colors duration-300"
        >
            Create account
        </button>
    </form>

    <p class="text-sm text-ink-muted text-center mt-8 auth-enter auth-enter-4">
        Already have an account?
        <a href="{{ route('login') }}" class="text-accent font-medium hover:text-accent-dark transition-colors duration-200">
            Log in
        </a>
    </p>
</x-guest-layout>
