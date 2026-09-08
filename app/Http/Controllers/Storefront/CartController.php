<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::items();
        $subtotal = Cart::subtotal();

        return view('storefront.cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        if ($product->stock_status !== 'In Stock') {
            return back()->withErrors(['cart' => 'That item is currently unavailable.']);
        }

        Cart::add($product->id, $request->integer('quantity', 1));

        return back()->with('success', "{$product->product_name} added to your cart.");
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        Cart::update($product->id, $request->integer('quantity'));

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        Cart::remove($product->id);

        return back()->with('success', 'Item removed from your cart.');
    }
}
