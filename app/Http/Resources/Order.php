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
            'status' => $this->status,
            'payment_status' => $this->payment->status,
            'payment_method' => $this->payment->payment_method,
            'name' => $this->user->name,
            'order_count' => Helper::orderCount($this->id, $this->user->id),
            'grand_price' => Helper::grandPrice($this->id, $this->user->id),
        ];
    }
}



// {"id":28,"order_number":"ORD-5DCE63724EC0C","user_id":1,"status":"pending","payment_id":28,"shipping_id":2,"first_name":"Rakib","last_name":"Hossain","address":"Ullapara","city":"Sirajganj","country":"1","post_code":"6730","phone_number":"01776217594","notes":null,"created_at":"2019-11-15 08:36:02","updated_at":"2019-11-15 08:36:02"}



// Order   Status  Payment status  Payment method  Name    Quantity    Price


//           <td>{{$order->order_number}}</td>

//           <td>{{$order->status}}</td>
//           <td>{{$order->payment->status}}</td>
//           <td>{{$order->payment->payment_method}}</td>

//           <td>{{$order->user->name}}</td>
          
//           <td>{{Helper::orderCount($order->id, $order->user->id)}}</td>
//           <td>{{Helper::grandPrice($order->id, $order->user->id)}}</td>