<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'deliv_id',
        'order_id',
        'customer_id',
        'customer_name',
        'customer_phone',
        'address',
        'ship_date',
        'token',
        'status',
        'customer_ship_date',
        'customer_note',
        'confirmed_at',
        'wa_sent',
        'wa_message'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'ship_date' => 'date',
        'customer_ship_date' => 'date'
    ];

    public function confirmation()
    {
        return $this->hasOne(DeliveryConfirmation::class);
    }
}