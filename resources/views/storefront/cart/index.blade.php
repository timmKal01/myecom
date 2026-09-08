@extends('storefront.layouts.app')

@section('title', 'Your Cart — Northgate & Co.')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-display text-4xl font-semibold mb-10">Your Cart</h1>

        @if ($errors->any())
            <div class="mb-8 border border-red-300 bg-red-50 text-red-700 text-sm rounded-lg px-4 py-3">
                {{ $errors->first() }}
            </div>
        @endif

        @if ($items->isEmpty())
            <div class="text-center py-24 border border-dashed border-line rounded-xl">
                <p class="font-display text-2xl mb-2">Your cart is empty</p>
                <p class="text-ink-muted mb-6">Find something you'll actually use.</p>
                <a href="{{ route('storefront.products.index') }}" class="inline-flex items-center justify-center bg-ink text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300">
                    Continue shopping
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-[1fr_320px] gap-12 items-start">
                <ul class="divide-y divide-line border-t border-b border-line">
                    @foreach ($items as $item)
                        @php $product = $item['product']; $image = $product->primary_image; @endphp
                        <li class="flex gap-5 py-6">
                            <a href="{{ route('storefront.products.show', $product->slug) }}" class="shrink-0 w-24 h-24 bg-surface border border-line rounded-lg overflow-hidden">
                                @if ($image)
                                    <img src="{{ asset('storage/' . $image->img_path) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover">
                                @endif
                            </a>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <a href="{{ route('storefront.products.show', $product->slug) }}" class="font-medium text-ink hover:text-accent transition-colors duration-200">
                                            {{ $product->product_name }}
                                        </a>
                                        <p class="text-sm text-ink-muted mt-1">${{ number_format($product->final_price, 2) }} each</p>
                                    </div>
                                    <p class="font-semibold text-ink whitespace-nowrap">${{ number_format($item['lineTotal'], 2) }}</p>
                                </div>

                                <div class="flex items-center gap-4 mt-4">
                                    <form action="{{ route('storefront.cart.update', $product) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <label for="qty-{{ $product->id }}" class="sr-only">Quantity</label>
                                        <select
                                            id="qty-{{ $product->id }}"
                                            name="quantity"
                                            onchange="this.form.submit()"
                                            class="border border-line rounded-lg py-1.5 pl-3 pr-7 text-sm focus:outline-none focus:ring-2 focus:ring-accent/40 focus:border-accent"
                                        >
                                            @for ($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                                <option value="{{ $i }}" @selected($item['quantity'] === $i)>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                    <form action="{{ route('storefront.cart.remove', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-ink-muted hover:text-red-600 transition-colors duration-200">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="border border-line rounded-xl p-6 sticky top-28">
                    <h2 class="font-display text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-ink-muted">Subtotal</span>
                        <span class="text-ink">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <p class="text-xs text-ink-muted mb-4">Shipping and taxes calculated at checkout.</p>
                    <a href="{{ route('storefront.checkout.index') }}" class="w-full inline-flex items-center justify-center bg-ink text-white px-8 py-3.5 rounded-full font-medium hover:bg-accent transition-colors duration-300">
                        Checkout
                    </a>
                    <a href="{{ route('storefront.products.index') }}" class="w-full inline-flex items-center justify-center mt-3 text-sm text-ink-muted hover:text-ink transition-colors duration-200">
                        Continue shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
