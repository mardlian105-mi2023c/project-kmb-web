<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    protected $fillable = [
        'delivery_id',
        'item_code',
        'item_name',
        'qty',
        'unit',
        'remark'
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}