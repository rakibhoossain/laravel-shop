<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'title' => $this->title,
            'action' => "<a class='btn btn-primary' href=".route('post.single', $this->slug ).">View</a> <a class='btn btn-warning' href=".route('admin.post.edit', $this->id ).">Edit</a> <a class='btn btn-danger' href=".route('admin.post.destroy', $this->id ).">Delete</a>",
        ];


    }
}