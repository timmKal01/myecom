<section class="space-y-4">
    <header>
        <h2 class="font-display text-xl font-semibold">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-ink-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center rounded-full bg-red-600 text-white text-sm font-medium px-6 py-2.5 hover:bg-red-700 transition-colors duration-200"
    >{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="font-display text-lg font-semibold text-ink">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-ink-muted">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                    class="w-3/4 border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent transition-colors duration-200"
                >
                @error('password', 'userDeletion') <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center justify-center rounded-full border border-line text-ink text-sm font-medium px-6 py-2.5 hover:border-ink transition-colors duration-200">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 text-white text-sm font-medium px-6 py-2.5 hover:bg-red-700 transition-colors duration-200">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
