<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class Order extends JsonResource
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
            'order_number' => $this->order_number,
            'status' => ucfirst($this->status),
            'payment_status' => ucfirst($this->payment->status),
            'payment_method' => ucfirst($this->payment->payment_method),
            'name' => $this->user->name,
            'order_count' => Helper::orderCount($this->id, $this->user->id),
            'grand_price' => Helper::grandPrice($this->id, $this->user->id).Helper::base_currency(),
            'action' => "<a class='btn btn-primary' href=".route('admin.product.order.show', $this->id ).">View</a>",
        ];
    }
}