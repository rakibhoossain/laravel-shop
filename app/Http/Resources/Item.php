<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Item extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'title'=> $this->title,
            'slug' => $this->slug,

            'offer_price' => $this->offer_price.Helper::base_currency(),
            'price' =>  $this->price.Helper::base_currency(),           

            'category' => $this->category->name,
            'brand' =>  $this->brand->name,

            'image' =>  ($this->images)? asset('images/product/'.$this->images[0]->image) : '',

            'view' =>  route('shop.single', $this->slug),
            'cart' =>  route('cart.add', $this->slug),

        ];
    }
}
