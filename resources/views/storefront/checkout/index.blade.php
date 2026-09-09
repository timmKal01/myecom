@extends('storefront.layouts.app')

@section('title', 'Checkout — Northgate & Co.')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-display text-4xl font-semibold mb-10">Checkout</h1>

        <div class="grid lg:grid-cols-[1fr_360px] gap-12 items-start">
            <form action="{{ route('storefront.checkout.store') }}" method="POST" class="space-y-8">
                @csrf

                <div>
                    <h2 class="font-display text-xl font-semibold mb-4">Shipping details</h2>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label for="shipping_name" class="block text-sm font-medium text-ink mb-1.5">Full name</label>
                            <input
                                type="text" id="shipping_name" name="shipping_name"
                                value="{{ old('shipping_name', auth()->user()->name) }}"
                                required
                                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                            >
                            @error('shipping_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="shipping_phone" class="block text-sm font-medium text-ink mb-1.5">Phone number</label>
                            <input
                                type="tel" id="shipping_phone" name="shipping_phone"
                                value="{{ old('shipping_phone') }}"
                                required
                                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                            >
                            @error('shipping_phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-ink mb-1.5">City</label>
                            <input
                                type="text" id="shipping_city" name="shipping_city"
                                value="{{ old('shipping_city') }}"
                                required
                                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                            >
                            @error('shipping_city') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="shipping_address" class="block text-sm font-medium text-ink mb-1.5">Street address</label>
                            <textarea
                                id="shipping_address" name="shipping_address" rows="2"
                                required
                                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                            >{{ old('shipping_address') }}</textarea>
                            @error('shipping_address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-ink mb-1.5">Delivery notes <span class="text-ink-muted font-normal">(optional)</span></label>
                            <textarea
                                id="notes" name="notes" rows="2"
                                class="w-full border border-line rounded-lg py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                            >{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="font-display text-xl font-semibold mb-4">Payment</h2>
                    <div class="border border-line rounded-lg p-4 flex items-center gap-3 bg-surface">
                        <span class="w-4 h-4 rounded-full border-2 border-accent flex items-center justify-center">
                            <span class="w-2 h-2 rounded-full bg-accent"></span>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-ink">Cash on Delivery</p>
                            <p class="text-xs text-ink-muted">Pay in cash when your order arrives.</p>
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-ink-solid text-white px-8 py-4 rounded-full font-medium hover:bg-accent transition-colors duration-300"
                >
                    Place Order
                </button>
            </form>

            <div class="border border-line rounded-xl p-6 sticky top-28">
                <h2 class="font-display text-xl font-semibold mb-4">Order Summary</h2>
                <ul class="divide-y divide-line mb-4">
                    @foreach ($items as $item)
                        <li class="flex items-center gap-3 py-3">
                            @php $image = $item['product']->primary_image; @endphp
                            <div class="w-12 h-12 shrink-0 bg-white border border-line rounded-md overflow-hidden">
                                @if ($image)
                                    <img src="{{ asset('storage/' . $image->img_path) }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-ink truncate">{{ $item['product']->product_name }}</p>
                                <p class="text-xs text-ink-muted">Qty {{ $item['quantity'] }}</p>
                            </div>
                            <p class="text-sm font-medium text-ink whitespace-nowrap">${{ number_format($item['lineTotal'], 2) }}</p>
                        </li>
                    @endforeach
                </ul>
                <div class="border-t border-line pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-ink-muted">Subtotal</span>
                        <span class="text-ink">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-ink-muted">Shipping</span>
                        <span class="text-ink">{{ $shippingFee > 0 ? '$' . number_format($shippingFee, 2) : 'Free' }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-base pt-2 border-t border-line">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
