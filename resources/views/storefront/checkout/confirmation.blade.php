@extends('storefront.layouts.app')

@section('title', 'Order Confirmed — Northgate & Co.')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <div class="w-16 h-16 rounded-full bg-accent/10 text-accent flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
        <h1 class="font-display text-4xl font-semibold mb-3">Thank you, {{ explode(' ', $order->shipping_name)[0] }}.</h1>
        <p class="text-ink-muted mb-1">Your order has been placed.</p>
        <p class="text-sm text-ink-muted mb-10">Order number <span class="font-medium text-ink">{{ $order->order_number }}</span></p>

        <div class="border border-line rounded-xl p-6 text-left mb-10">
            <ul class="divide-y divide-line mb-4">
                @foreach ($order->items as $item)
                    <li class="flex items-center justify-between py-3 text-sm">
                        <span class="text-ink">{{ $item->product_name }} <span class="text-ink-muted">&times; {{ $item->quantity }}</span></span>
                        <span class="font-medium text-ink">${{ number_format($item->line_total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="border-t border-line pt-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-ink-muted">Subtotal</span>
                    <span class="text-ink">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-ink-muted">Shipping</span>
                    <span class="text-ink">{{ $order->shipping_fee > 0 ? '$' . number_format($order->shipping_fee, 2) : 'Free' }}</span>
                </div>
                <div class="flex justify-between font-semibold text-base pt-2 border-t border-line">
                    <span>Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
            <div class="border-t border-line mt-4 pt-4 text-sm text-ink-muted">
                <p>Shipping to {{ $order->shipping_name }}, {{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
                <p class="mt-1">Payment: Cash on Delivery</p>
            </div>
        </div>

        <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-ink text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300">
            Continue shopping
        </a>
    </div>
@endsection
