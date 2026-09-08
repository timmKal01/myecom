<x-admin-layout active="settings" title="Settings">
    <div class="max-w-xl space-y-6">
        <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 sm:p-8">
            <h2 class="text-lg font-semibold mb-6">Store Details</h2>
            <dl class="space-y-4 text-sm">
                <div class="flex justify-between border-b border-admin-border pb-3">
                    <dt class="text-admin-ink-muted">Store Name</dt>
                    <dd class="font-medium">{{ config('app.name') }}</dd>
                </div>
                <div class="flex justify-between border-b border-admin-border pb-3">
                    <dt class="text-admin-ink-muted">Environment</dt>
                    <dd class="font-medium capitalize">{{ config('app.env') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-admin-ink-muted">Signed in as</dt>
                    <dd class="font-medium">{{ auth()->user()->name }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-admin-surface border border-admin-border rounded-2xl p-6 sm:p-8">
            <h2 class="text-lg font-semibold mb-2">Account Settings</h2>
            <p class="text-sm text-admin-ink-muted mb-4">Update your name, email, or password from your account profile.</p>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-full bg-admin-accent text-white text-sm font-medium px-6 py-2.5 hover:bg-admin-accent-dark transition-colors duration-200">
                Go to Profile
            </a>
        </div>
    </div>
</x-admin-layout>
