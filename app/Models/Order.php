<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'amount',
        'first_name',
        'last_name',
        'email',
        'street_address',
        'status',
        'country_id',
        'city',
        'state',
        'zip_code',
        'phone',
        'order_notes'
    ];

    const ORDER_PLACED = 'order_placed';
    const PACKING = 'packing';
    const COMPLETED = 'completed';
    const CANCELLED = 'delivered';
    const DELIVERED = 'delivered';


    public CONST LABELS = [
        self::ORDER_PLACED => ['label' => 'Order Initiated', 'badge' => 'badge-warning'],
        self::PACKING => ['label' => 'Order is in progress', 'badge' => 'badge-primary'],
        self::COMPLETED => ['label' => 'Order has been Completed', 'badge' => 'badge-success'],
        self::DELIVERED => ['label' => 'Order has been delivered', 'badge' => 'badge-info'],
        self::CANCELLED => ['label' => 'Order has been cancelled', 'badge' => 'badge-danger'],
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_number = 'OR-' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            while (static::where('order_number', $order->order_number)->exists()) {
                $order->order_number = 'OR-' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            }
        });
    }

}
