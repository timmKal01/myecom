<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Support\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private const FREE_SHIPPING_THRESHOLD = 75.0;
    private const FLAT_SHIPPING_FEE = 6.99;

    public function index()
    {
        $items = Cart::items();

        if ($items->isEmpty()) {
            return redirect()->route('storefront.cart.index')
                ->with('success', 'Your cart is empty — add something before checking out.');
        }

        $subtotal = Cart::subtotal();
        $shippingFee = $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0 : self::FLAT_SHIPPING_FEE;
        $total = $subtotal + $shippingFee;

        return view('storefront.checkout.index', compact('items', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request)
    {
        $items = Cart::items();

        if ($items->isEmpty()) {
            return redirect()->route('storefront.cart.index');
        }

        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:30',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:120',
            'notes' => 'nullable|string|max:1000',
        ]);

        $subtotal = Cart::subtotal();
        $shippingFee = $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0 : self::FLAT_SHIPPING_FEE;
        $total = $subtotal + $shippingFee;

        $order = DB::transaction(function () use ($validated, $items, $subtotal, $shippingFee, $total) {
            $order = Order::create([
                'order_number' => 'NG-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
                'user_id' => Auth::id(),
                'status' => 'Pending',
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'total' => $total,
                'payment_method' => 'cod',
                ...$validated,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->product_name,
                    'unit_price' => $item['product']->final_price,
                    'quantity' => $item['quantity'],
                    'line_total' => $item['lineTotal'],
                ]);
            }

            return $order;
        });

        Cart::clear();

        return redirect()->route('storefront.checkout.confirmation', $order->order_number);
    }

    public function confirmation(string $orderNumber)
    {
        $order = Order::with('items')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('storefront.checkout.confirmation', compact('order'));
    }
}
