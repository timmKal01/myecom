<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * A session-based cart — works for guests and logged-in users alike, with
 * no separate cart table. Keys are product IDs, values are quantities.
 */
class Cart
{
    private const SESSION_KEY = 'cart';

    public static function raw(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public static function add(int $productId, int $quantity = 1): void
    {
        $cart = self::raw();
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        session([self::SESSION_KEY => $cart]);
    }

    public static function update(int $productId, int $quantity): void
    {
        $cart = self::raw();

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        session([self::SESSION_KEY => $cart]);
    }

    public static function remove(int $productId): void
    {
        $cart = self::raw();
        unset($cart[$productId]);
        session([self::SESSION_KEY => $cart]);
    }

    public static function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * @return Collection<int, array{product: Product, quantity: int, lineTotal: float}>
     */
    public static function items(): Collection
    {
        $cart = self::raw();

        if (empty($cart)) {
            return collect();
        }

        $products = Product::with('images')->whereIn('id', array_keys($cart))->get()->keyBy('id');

        return collect($cart)
            ->map(function ($quantity, $productId) use ($products) {
                $product = $products->get($productId);

                if (! $product) {
                    return null;
                }

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'lineTotal' => $product->final_price * $quantity,
                ];
            })
            ->filter()
            ->values();
    }

    public static function count(): int
    {
        return array_sum(self::raw());
    }

    public static function subtotal(): float
    {
        return (float) self::items()->sum('lineTotal');
    }
}
