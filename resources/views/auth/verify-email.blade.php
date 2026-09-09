<x-guest-layout>
    <h1 class="font-display text-4xl font-bold mb-2 bg-gradient-to-r from-[#14b8a6] to-[#2563eb] bg-clip-text text-transparent">Verify Your Email</h1>
    <div class="mb-6 text-sm text-[#5b6866]">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-[#0f766e]">
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

            <button type="submit" class="text-sm text-[#5b6866] hover:text-[#1a2332] transition-colors duration-200 whitespace-nowrap">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
