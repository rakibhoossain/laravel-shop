<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function parent(){
   	return $this->belongsTo(Category::class, 'parent_id');
   }

   public function products()
   {
       return $this->hasMany(Product::class);
   }
}
