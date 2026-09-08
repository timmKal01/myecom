<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerMainController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $stats = [
            'stores' => Store::where('user_id', $userId)->count(),
            'products' => Product::where('user_id', $userId)->count(),
            'orderItems' => OrderItem::whereHas('product', fn ($q) => $q->where('user_id', $userId))->count(),
        ];

        $recentOrderItems = OrderItem::with(['order.user', 'product'])
            ->whereHas('product', fn ($q) => $q->where('user_id', $userId))
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('stats', 'recentOrderItems'));
    }

    public function orderhistory()
    {
        $orderItems = OrderItem::with(['order.user', 'product'])
            ->whereHas('product', fn ($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->paginate(15);

        return view('seller.orderhistory', compact('orderItems'));
    }
}
