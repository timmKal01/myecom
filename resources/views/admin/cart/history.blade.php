<x-dashboard-layout role="admin" active="carts" title="Cart Activity">
    <div class="bg-surface border border-line rounded-xl shadow-sm p-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-4 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.885-4.788 2.244-7.394a1.09 1.09 0 0 0-1.089-1.226H5.25M7.5 14.25 5.106 5.272M6.75 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
        <h2 class="font-display text-lg font-semibold mb-2">Carts aren't persisted</h2>
        <p class="text-sm text-ink-muted max-w-md mx-auto">
            Shopping carts live in the visitor's session only and are cleared once they check out or their session ends — there's no cart table to report on. Once an order is placed, it shows up in
            <a href="{{ route('admin.order.history') }}" class="text-accent font-medium hover:underline">Order History</a>.
        </p>
    </div>
</x-dashboard-layout>
