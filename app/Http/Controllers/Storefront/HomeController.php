<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['products' => fn ($q) => $q->published()])
            ->whereHas('products', fn ($q) => $q->published())
            ->orderBy('category_name')
            ->get();

        $featuredProducts = Product::with(['images', 'category'])
            ->published()
            ->latest()
            ->take(8)
            ->get();

        $saleProducts = Product::with(['images', 'category'])
            ->published()
            ->whereNotNull('discounted_price')
            ->whereColumn('discounted_price', '<', 'regular_price')
            ->take(4)
            ->get();

        return view('storefront.home', compact('categories', 'featuredProducts', 'saleProducts'));
    }
}
