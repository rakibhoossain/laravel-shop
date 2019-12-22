<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Product extends JsonResource
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
            'image'=> "<img class='tiny-img' src='".asset('images/product/small/'.$this->images[0]->image)."' alt='".$this->title."'/>",
            'title' => $this->title,
            'price' => $this->price.Helper::base_currency(),
            'offer_price' => $this->offer_price.Helper::base_currency(),
            'quantity' => $this->quantity,
            'action' => "<a class='btn btn-primary' href=".route('admin.product.edit', $this->id ).">Edit</a> <a class='btn btn-danger' href='".route('admin.product.destroy',$this->id)."'>Delete</a>",
        ];


    }
}