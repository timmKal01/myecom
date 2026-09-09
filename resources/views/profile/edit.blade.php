<x-app-layout>
    <x-slot name="header">Profile</x-slot>

    <div class="space-y-6">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            @include('partials.appearance-settings')
        </div>

        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
