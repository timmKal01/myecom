<section>
    <header>
        <h2 class="font-display text-xl font-semibold">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-ink-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-ink mb-1.5">{{ __('Current Password') }}</label>
            <input
                id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('current_password', 'updatePassword') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-ink mb-1.5">{{ __('New Password') }}</label>
            <input
                id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('password', 'updatePassword') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-ink mb-1.5">{{ __('Confirm Password') }}</label>
            <input
                id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('password_confirmation', 'updatePassword') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-ink-muted"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
