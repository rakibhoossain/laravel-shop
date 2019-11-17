<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            'author'=> ($this->name)? $this->name : $this->user->name,
            'content' => $this->body,
            'restonse_to' => $this->post->title,
            'date' =>  date_format($this->created_at,"F D, Y").' at '.date_format($this->created_at,"g:i a"),
            'action' => "<a class='btn btn-primary' href=".route('post.single', $this->post->slug)." target='blank'>View post</a> <a class='btn btn-danger' href='".route('admin.comments.destroy',$this->id)."'>Delete</a>",
        ];
    }
}