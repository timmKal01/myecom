<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'stores' => Store::count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.admin', compact('stats', 'recentOrders'));
    }

    public function setting()
    {
        return view('admin.setting');
    }

    public function manage_user()
    {
        $users = User::latest()->paginate(15);

        return view('admin.manage.user', compact('users'));
    }

    public function manage_store()
    {
        $stores = Store::with('user')->withCount('products')->latest()->paginate(15);

        return view('admin.manage.store', compact('stores'));
    }

    public function cart_history()
    {
        return view('admin.cart.history');
    }

    public function order_history()
    {
        $orders = Order::with(['user', 'items'])->latest()->paginate(15);

        return view('admin.order.history', compact('orders'));
    }
}
