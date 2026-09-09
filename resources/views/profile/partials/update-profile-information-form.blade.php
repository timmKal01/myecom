<section>
    <header>
        <h2 class="font-display text-xl font-semibold">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-ink-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-ink mb-1.5">{{ __('Name') }}</label>
            <input
                id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('name') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-ink mb-1.5">{{ __('Email') }}</label>
            <input
                id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                required autocomplete="username"
                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
            >
            @error('email') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-ink-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline hover:text-accent transition-colors duration-200">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-ink-solid text-white text-sm font-medium px-6 py-2.5 hover:bg-accent transition-colors duration-200">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
