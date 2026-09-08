<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'store', 'seller', 'images']);

        if ($request->filled('q')) {
            $query->where('product_name', 'like', '%'.$request->string('q').'%');
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        return view('admin.product.manage', compact('products'));
    }

    public function review_manage()
    {
        return view('admin.product.manage_product_review');
    }
}
