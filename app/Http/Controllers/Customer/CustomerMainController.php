<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerMainController extends Controller
{
    public function index()
    {
        $recentOrders = Order::with('items')->where('user_id', Auth::id())->latest()->take(5)->get();
        $orderCount = Order::where('user_id', Auth::id())->count();

        return view('customer.profile', compact('recentOrders', 'orderCount'));
    }

    public function history()
    {
        $orders = Order::with('items')->where('user_id', Auth::id())->latest()->paginate(15);

        return view('customer.history', compact('orders'));
    }

    public function payment()
    {
        return view('customer.payment');
    }

    public function affiliate()
    {
        return view('customer.affiliate');
    }

    public function setting()
    {
        return view('customer.setting');
    }
}
