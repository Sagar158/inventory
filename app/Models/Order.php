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
    const CANCELLED = 'cancelled';
    const DELIVERED = 'delivered';
    const RETURNED = 'returned';

    public const STATUS = [
        self::ORDER_PLACED =>  'Order Initiated',
        self::PACKING => 'InProgress',
        self::COMPLETED =>   'Completed',
        self::CANCELLED =>  'Cancelled',
        self::DELIVERED =>  'Delivered',
        self::RETURNED =>  'Returned',
    ];

    public CONST LABELS = [
        self::ORDER_PLACED => ['label' => 'Order Initiated', 'badge' => 'badge-warning'],
        self::PACKING => ['label' => 'Order is in progress', 'badge' => 'badge-primary'],
        self::COMPLETED => ['label' => 'Order has been Completed', 'badge' => 'badge-success'],
        self::DELIVERED => ['label' => 'Order has been delivered', 'badge' => 'badge-info'],
        self::CANCELLED => ['label' => 'Order has been cancelled', 'badge' => 'badge-danger'],
        self::RETURNED => ['label' => 'Order has been returned', 'badge' => 'badge-danger'],
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

    public function country()
    {
        return $this->hasOne(Countries::class,'id','country_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'order_id','id');
    }

    public function assignedTo()
    {
        return $this->hasOne(User::class,'id','assigned_to');
    }


}
