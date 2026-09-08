<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($request->filled('min_price')) {
            $query->where('regular_price', '>=', $request->float('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('regular_price', '<=', $request->float('max_price'));
        }

        if ($request->filled('brand')) {
            $query->whereIn('brand', (array) $request->input('brand'));
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

        // Brand list scoped to the current category/search (but not the brand filter
        // itself), so checking a box never removes the box you just checked.
        $brandQuery = Product::published();
        if ($request->filled('category')) {
            $brandQuery->where('category_id', $request->integer('category'));
        }
        if ($request->filled('q')) {
            $brandQuery->where('product_name', 'like', '%'.$request->string('q').'%');
        }
        $brands = $brandQuery->whereNotNull('brand')
            ->selectRaw('brand, COUNT(*) as products_count')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();

        // Catalog-wide bounds so the price slider's range stays stable as filters change.
        $priceBounds = [
            'min' => (int) floor(Product::published()->min('regular_price') ?? 0),
            'max' => (int) ceil(Product::published()->max('regular_price') ?? 0),
        ];

        $favoritedIds = Auth::check()
            ? Auth::user()->favorites()->pluck('product_id')->all()
            : [];

        return view('storefront.products.index', compact(
            'products',
            'categories',
            'activeCategory',
            'brands',
            'priceBounds',
            'favoritedIds',
        ));
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

        $favoritedIds = Auth::check()
            ? Auth::user()->favorites()->pluck('product_id')->all()
            : [];

        return view('storefront.products.show', compact('product', 'relatedProducts', 'favoritedIds'));
    }
}
