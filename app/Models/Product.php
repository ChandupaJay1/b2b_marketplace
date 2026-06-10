<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'product_category_id', 'product_subcategory_id',
        'name', 'slug', 'short_description', 'description', 'sku',
        'price', 'min_order_quantity', 'unit', 'origin_country',
        'main_image', 'is_active', 'is_featured', 'views',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'price'       => 'decimal:2',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    // Multiple vendors relationship (Many-to-Many)
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'product_vendor')
            ->withPivot('price', 'min_order_quantity', 'sku', 'is_primary', 'is_active')
            ->withTimestamps();
    }

    // Get primary vendor for this product
    public function primaryVendor()
    {
        return $this->belongsToMany(Vendor::class, 'product_vendor')
            ->wherePivot('is_primary', true)
            ->withPivot('price', 'min_order_quantity', 'sku', 'is_active')
            ->withTimestamps()
            ->first();
    }

    // Get active vendors for this product
    public function activeVendors()
    {
        return $this->belongsToMany(Vendor::class, 'product_vendor')
            ->wherePivot('is_active', true)
            ->withPivot('price', 'min_order_quantity', 'sku', 'is_primary')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function rfqs()
    {
        return $this->hasMany(Rfq::class);
    }

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/' . $this->main_image) : asset('images/default-product.png');
    }
}
