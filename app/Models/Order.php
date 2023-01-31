<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $timestamps = true;
    

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        // 'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
        'order_date'
    ];
}
