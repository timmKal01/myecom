<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDiscountController extends Controller
{
    public function index()
    {
        return view('admin.discount.create');
    }

    public function manage()
    {
        $discounted = Product::with(['category', 'store'])
            ->whereNotNull('discounted_price')
            ->whereColumn('discounted_price', '<', 'regular_price')
            ->latest()
            ->paginate(15);

        return view('admin.discount.manage', compact('discounted'));
    }
}
