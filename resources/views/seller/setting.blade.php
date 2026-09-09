<x-dashboard-layout role="seller" active="settings" title="Settings">
    <div class="max-w-xl space-y-6">
        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-lg font-semibold mb-6">Account</h2>
            <dl class="space-y-4 text-sm">
                <div class="flex justify-between border-b border-line pb-3">
                    <dt class="text-ink-muted">Name</dt>
                    <dd class="font-medium">{{ auth()->user()->name }}</dd>
                </div>
                <div class="flex justify-between border-b border-line pb-3">
                    <dt class="text-ink-muted">Email</dt>
                    <dd class="font-medium">{{ auth()->user()->email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-ink-muted">Role</dt>
                    <dd class="font-medium">Vendor</dd>
                </div>
            </dl>
        </div>

        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            @include('partials.appearance-settings')
        </div>

        <div class="bg-surface border border-line rounded-xl p-6 sm:p-8 shadow-sm">
            <h2 class="font-display text-lg font-semibold mb-2">Profile &amp; Password</h2>
            <p class="text-sm text-ink-muted mb-4">Update your name, email, or password from your account profile.</p>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-full bg-accent text-white text-sm font-medium px-6 py-2.5 hover:bg-accent-dark transition-colors duration-200">
                Go to Profile
            </a>
        </div>
    </div>
</x-dashboard-layout>
