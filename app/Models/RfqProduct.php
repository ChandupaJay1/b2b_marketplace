<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfqProduct extends Model
{
    protected $fillable = [
        'rfq_id', 'product_id', 'product_name', 'quantity', 'unit',
    ];

    public function rfq()
    {
        return $this->belongsTo(Rfq::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
