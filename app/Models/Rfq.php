<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    protected $table = 'rfqs';

    protected $fillable = [
        'user_id', 'vendor_id', 'name', 'email', 'phone',
        'company', 'country', 'city',
        'product_category_id', 'target_price', 'delivery_location',
        'additional_requirements', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function products()
    {
        return $this->hasMany(RfqProduct::class);
    }
}
