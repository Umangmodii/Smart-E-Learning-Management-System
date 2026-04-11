<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_id',
        'transaction_id',
        'amount',
        'status',
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
