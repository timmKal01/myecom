<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'category'])->published();

        if ($request->filled('q')) {
            $search = $request->string('q');
            $query->where('product_name', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        $sort = $request->string('sort', 'newest');
        match ((string) $sort) {
            'price_low' => $query->orderBy('regular_price', 'asc'),
            'price_high' => $query->orderBy('regular_price', 'desc'),
            'name' => $query->orderBy('product_name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::withCount(['products' => fn ($q) => $q->published()])
            ->whereHas('products', fn ($q) => $q->published())
            ->orderBy('category_name')
            ->get();

        $activeCategory = $request->filled('category')
            ? $categories->firstWhere('id', $request->integer('category'))
            : null;

        return view('storefront.products.index', compact('products', 'categories', 'activeCategory'));
    }

    public function show(string $slug)
    {
        $product = Product::with(['images', 'category', 'subcategory', 'store'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::with(['images'])
            ->published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('storefront.products.show', compact('product', 'relatedProducts'));
    }
}
