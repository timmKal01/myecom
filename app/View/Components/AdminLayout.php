<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public array $navGroups;

    public string $initials;

    public function __construct(
        public string $active = '',
        public string $title = '',
    ) {
        $this->navGroups = [
            [
                'label' => null,
                'items' => [
                    ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'admin', 'icon' => 'home'],
                ],
            ],
            [
                'label' => 'Catalog',
                'items' => [
                    ['key' => 'category', 'label' => 'Categories', 'route' => 'category.manage', 'icon' => 'tag'],
                    ['key' => 'subcategory', 'label' => 'Subcategories', 'route' => 'subcategory.manage', 'icon' => 'tag'],
                    ['key' => 'attribute', 'label' => 'Attributes', 'route' => 'productattribute.manage', 'icon' => 'sliders'],
                    ['key' => 'discount', 'label' => 'Discounts', 'route' => 'discount.manage', 'icon' => 'percent'],
                ],
            ],
            [
                'label' => 'Products',
                'items' => [
                    ['key' => 'products', 'label' => 'Products', 'route' => 'product.manage', 'icon' => 'box'],
                    ['key' => 'reviews', 'label' => 'Reviews', 'route' => 'product.review.manage', 'icon' => 'star'],
                ],
            ],
            [
                'label' => 'Orders',
                'items' => [
                    ['key' => 'orders', 'label' => 'Orders', 'route' => 'admin.order.history', 'icon' => 'receipt'],
                    ['key' => 'carts', 'label' => 'Cart Activity', 'route' => 'admin.cart.history', 'icon' => 'cart'],
                ],
            ],
            [
                'label' => 'People',
                'items' => [
                    ['key' => 'users', 'label' => 'Users', 'route' => 'admin.manage.user', 'icon' => 'users'],
                    ['key' => 'stores', 'label' => 'Stores', 'route' => 'admin.manage.store', 'icon' => 'building'],
                ],
            ],
        ];

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

    public function render()
    {
        return view('components.admin-layout');
    }
}
