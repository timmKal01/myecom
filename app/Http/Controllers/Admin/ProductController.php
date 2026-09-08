<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'store', 'seller', 'images'])->latest()->paginate(15);

        return view('admin.product.manage', compact('products'));
    }

    public function review_manage()
    {
        return view('admin.product.manage_product_review');
    }
}
