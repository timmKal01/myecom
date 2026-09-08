<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()
            ->with('product.images', 'product.category')
            ->latest()
            ->get()
            ->pluck('product')
            ->filter();

        return view('storefront.favorites.index', ['products' => $favorites]);
    }

    public function toggle(Product $product)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Removed from favourites.';
        } else {
            Favorite::create(['user_id' => Auth::id(), 'product_id' => $product->id]);
            $message = 'Added to favourites.';
        }

        return back()->with('success', $message);
    }
}
