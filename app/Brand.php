<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   public function products()
   {
       return $this->hasMany(Product::class);
   }
}
