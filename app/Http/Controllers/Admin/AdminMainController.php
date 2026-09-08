<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminMainController extends Controller
{
    public function index()
    {
        $kpis = [
            'products' => $this->kpi(Product::class),
            'orders' => $this->kpi(Order::class),
            'customers' => $this->kpi(User::class, fn ($q) => $q->where('role', 2)),
            'stores' => $this->kpi(Store::class),
        ];

        $revenueSeries = $this->dailyRevenueSeries(30);
        $totalRevenue = Order::sum('total');
        $avgOrderValue = Order::avg('total') ?? 0;

        $revenueByCategory = OrderItem::query()
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->selectRaw('categories.category_name as name, SUM(order_items.line_total) as revenue')
            ->groupBy('categories.category_name')
            ->orderByDesc('revenue')
            ->take(5)
            ->get();

        $ordersByWeekday = $this->ordersByWeekday();

        $totalProducts = Product::count();
        $publishedProducts = Product::published()->count();
        $catalogRate = $totalProducts > 0 ? (int) round($publishedProducts / $totalProducts * 100) : 0;

        $bestSellers = OrderItem::query()
            ->selectRaw('product_id, SUM(quantity) as sold, SUM(line_total) as revenue')
            ->groupBy('product_id')
            ->orderByDesc('sold')
            ->take(5)
            ->with('product.category', 'product.images')
            ->get();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.admin', compact(
            'kpis',
            'revenueSeries',
            'totalRevenue',
            'avgOrderValue',
            'revenueByCategory',
            'ordersByWeekday',
            'catalogRate',
            'publishedProducts',
            'totalProducts',
            'bestSellers',
            'recentOrders',
        ));
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

    /**
     * Count of records created in the last N days vs the N days before that —
     * used to render an honest "new this period" trend badge.
     */
    private function kpi(string $modelClass, ?\Closure $scope = null): array
    {
        $now = now();
        $periodStart = $now->copy()->subDays(30);
        $priorStart = $now->copy()->subDays(60);

        $base = fn () => $scope ? $scope($modelClass::query()) : $modelClass::query();

        $total = $base()->count();
        $current = $base()->where('created_at', '>=', $periodStart)->count();
        $prior = $base()->where('created_at', '>=', $priorStart)->where('created_at', '<', $periodStart)->count();

        $delta = $prior > 0 ? (int) round((($current - $prior) / $prior) * 100) : null;

        return [
            'total' => $total,
            'current' => $current,
            'delta' => $delta,
        ];
    }

    /** Zero-filled daily revenue totals for the last N days, oldest first. */
    private function dailyRevenueSeries(int $days): array
    {
        $start = now()->copy()->subDays($days - 1)->startOfDay();

        $rows = Order::where('created_at', '>=', $start)
            ->get(['total', 'created_at'])
            ->groupBy(fn ($order) => $order->created_at->toDateString());

        $series = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $start->copy()->addDays($i);
            $key = $date->toDateString();
            $series[] = [
                'date' => $date,
                'total' => $rows->has($key) ? (float) $rows[$key]->sum('total') : 0.0,
            ];
        }

        return $series;
    }

    /** Order counts bucketed by weekday, Sunday first. */
    private function ordersByWeekday(): array
    {
        $counts = array_fill(0, 7, 0);

        Order::pluck('created_at')->each(function (Carbon $createdAt) use (&$counts) {
            $counts[$createdAt->dayOfWeek]++;
        });

        $labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        return collect($labels)->map(fn ($label, $i) => ['label' => $label, 'count' => $counts[$i]])->all();
    }
}
