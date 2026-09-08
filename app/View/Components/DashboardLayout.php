<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public array $nav;

    public string $initials;

    public string $roleLabel;

    public string $homeRoute;

    public function __construct(
        public string $role,
        public string $active = '',
        public string $title = '',
    ) {
        $this->nav = $this->buildNav($role);

        $this->roleLabel = match ($role) {
            'seller' => 'Vendor',
            default => 'Customer',
        };

        $this->homeRoute = match ($role) {
            'seller' => 'vendor',
            default => 'dashboard',
        };

        $this->initials = $this->makeInitials(Auth::user()?->name ?? '');
    }

    protected function makeInitials(string $name): string
    {
        $parts = array_values(array_filter(preg_split('/\s+/', trim($name))));

        if (empty($parts)) {
            return '?';
        }

        $first = mb_substr($parts[0], 0, 1);
        $last = count($parts) > 1 ? mb_substr(end($parts), 0, 1) : '';

        return mb_strtoupper($first.$last);
    }

    protected function buildNav(string $role): array
    {
        return match ($role) {
            'seller' => [
                ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'vendor', 'icon' => 'home'],
                ['key' => 'orders', 'label' => 'Order History', 'route' => 'vendor.order.history', 'icon' => 'receipt'],
                ['key' => 'store-create', 'label' => 'Create Store', 'route' => 'vendor.store', 'icon' => 'plus'],
                ['key' => 'store-manage', 'label' => 'Manage Stores', 'route' => 'vendor.store.manage', 'icon' => 'building'],
                ['key' => 'product-create', 'label' => 'Add Product', 'route' => 'vendor.product', 'icon' => 'plus'],
                ['key' => 'product-manage', 'label' => 'Manage Products', 'route' => 'vendor.product.manage', 'icon' => 'box'],
            ],
            default => [
                ['key' => 'dashboard', 'label' => 'Overview', 'route' => 'dashboard', 'icon' => 'home'],
                ['key' => 'orders', 'label' => 'Order History', 'route' => 'customer.history', 'icon' => 'receipt'],
                ['key' => 'payment', 'label' => 'Payment Methods', 'route' => 'customer.payment', 'icon' => 'card'],
                ['key' => 'affiliate', 'label' => 'Affiliate', 'route' => 'customer.affiliate', 'icon' => 'share'],
            ],
        };
    }

    public function render()
    {
        return view('components.dashboard-layout');
    }
}
