<x-guest-layout>
    <h1 class="font-display text-3xl font-bold text-white mb-2">Verify Your Email</h1>
    <div class="mb-6 text-sm text-white/50">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-emerald-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
            @csrf
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-white/50 hover:text-white transition-colors duration-200 whitespace-nowrap">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
