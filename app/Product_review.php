<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }   
}
