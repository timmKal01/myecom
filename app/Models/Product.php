<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'sku',
        'brand',
        'user_id',
        'category_id',
        'subcategory_id',
        'store_id',
        'regular_price',
        'discounted_price',
        'tax_rate',
        'stock_quantity',
        'stock_status',       
        'slug',
        'visibility',
        'meta_title',
        'meta_description',
        'status',
        
        
    ];

    /** Products that are actually meant to be visible in the storefront. */
    public function scopePublished($query)
    {
        return $query->where('status', 'Published')->where('visibility', 1);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function seller(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /** The price to actually charge — the discounted price when it's set and lower. */
    public function getFinalPriceAttribute(): float
    {
        if ($this->discounted_price !== null && $this->discounted_price < $this->regular_price) {
            return (float) $this->discounted_price;
        }

        return (float) $this->regular_price;
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->discounted_price !== null && $this->discounted_price < $this->regular_price;
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if (! $this->is_on_sale) {
            return null;
        }

        return (int) round((1 - ($this->discounted_price / $this->regular_price)) * 100);
    }

    /** The primary image, falling back to the first image if none is flagged. */
    public function getPrimaryImageAttribute(): ?ProductImage
    {
        return $this->images->firstWhere('is_primary', true) ?? $this->images->first();
    }
}