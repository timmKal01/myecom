<x-guest-layout>
    <h1 class="font-display text-4xl font-bold mb-2 bg-gradient-to-r from-[#14b8a6] to-[#2563eb] bg-clip-text text-transparent">Confirm Password</h1>
    <div class="mb-8 text-sm text-[#5b6866]">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
