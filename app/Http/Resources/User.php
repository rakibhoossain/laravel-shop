<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => date_format($this->created_at,"F D, Y").' at '.date_format($this->created_at,"g:i a"),
            'admin_status' => $this->is_admin,
            'action' => "<a class='btn btn-primary' href=".route('admin.user.show', $this->id ).">View</a>",
        ];
    }
}