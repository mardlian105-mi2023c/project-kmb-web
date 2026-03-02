<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryConfirmation extends Model
{
    protected $fillable = [
        'delivery_id',
        'is_ready',
        'selected_date',
        'note',
        'photo'
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}