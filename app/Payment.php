<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';

    protected $fillable = [
        'user_id', 'order_id', 'payment_method', 'status', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
