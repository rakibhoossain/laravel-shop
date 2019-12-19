<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Comment extends Model
{
    protected $table = 'product__comments';

    protected $fillable = [
        'user_id', 'phone', 'name', 'email', 'website', 'product_id', 'parent_id', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }    

    public function replies()
    {
        return $this->hasMany(Product_Comment::class, 'parent_id')->where('status', '1');
    }
}
