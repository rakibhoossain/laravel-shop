<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

    protected $table = 'shippings';

    protected $fillable = [
        'type', 'price', 'description'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
