<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    protected $table = 'rfqs';

    protected $fillable = [
        'user_id', 'vendor_id', 'product_id', 'name', 'email', 'phone',
        'company', 'country', 'product_description', 'quantity', 'unit',
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
