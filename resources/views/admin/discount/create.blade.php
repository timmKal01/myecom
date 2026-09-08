<x-admin-layout active="discount" title="Discounts">
    <div class="bg-admin-surface border border-admin-border rounded-2xl p-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 text-admin-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM8.25 15.75l7.5-7.5" />
        </svg>
        <h2 class="text-lg font-semibold mb-2">Discounts are set per-product</h2>
        <p class="text-sm text-admin-ink-muted max-w-md mx-auto">
            There's no separate discount-campaign system — vendors set a <span class="font-medium text-admin-ink">Discounted Price</span> directly on a product when they create or edit it, and the storefront shows it as a sale automatically.
        </p>
        <a href="{{ route('discount.manage') }}" class="inline-flex items-center gap-2 mt-6 rounded-full bg-admin-accent text-white text-sm font-medium px-5 py-2.5 hover:bg-admin-accent-dark transition-colors duration-200">
            View active discounts
        </a>
    </div>
</x-admin-layout>
