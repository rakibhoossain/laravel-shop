<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function images(){
   	return $this->hasMany(ProductImage::class);
   }

   public function category(){
   	return $this->belongsTo(Category::class, 'category_id');
   }

   public function brand(){
   	return $this->belongsTo(Brand::class, 'brand_id');
   }

  public function carts(){
    return $this->hasMany(Cart::class)->whereNotNull('order_id');
  }

    public function comments()
    {
      return $this->hasMany(Product_Comment::class)->whereNull('parent_id')->where('status', '1');
    }    

    public function allComments()
    {
         return $this->hasMany(Product_Comment::class)->where('status', '1');
    }

    public function reviews()
    {
         return $this->hasMany(Product_review::class)->where('status', '1');
    }

}
