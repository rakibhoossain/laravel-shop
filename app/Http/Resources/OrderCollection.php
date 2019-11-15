<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'data' => $this->collection,
            'columns' => ['Order', 'Status', 'Payment status', 'Payment method', 'Name', 'Quantity', 'Price'],
        ];




    }
}
