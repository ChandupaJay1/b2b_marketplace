<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_category_id', 'company_name', 'slug', 'description',
        'logo', 'banner', 'website', 'email', 'phone', 'address', 'city',
        'state', 'country', 'postal_code', 'established_year', 'employees_count',
        'annual_revenue', 'certifications', 'status', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(VendorCategory::class, 'vendor_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function rfqs()
    {
        return $this->hasMany(Rfq::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner ? asset('storage/' . $this->banner) : null;
    }
}
