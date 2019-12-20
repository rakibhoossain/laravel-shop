<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
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
        $status = '';
        if($this->status == '1'){
            $status = 'Aproved';
        }elseif ($this->status == '0') {
            $status = 'Pending';
        }else{
            $status = 'Spam';
        }

        $rating = '';
        if ($this->rating) {
            $i=0;
            for (; $i < (int)$this->rating; $i++) { 
                $rating .= '<i class="fa fa-star"></i>';
            }
            for ($j=5; $j > $i; $j--) { 
                $rating .= '<i class="far fa-star"></i>';
            }
        }


        if($this::getTable() == 'comments'){
            return [
                'author'=> ($this->name)? $this->name : $this->user->name,
                'content' => Str::words(strip_tags($this->body),5),
                'restonse_to' => $this->post->title,
                'status' => $status,
                'date' =>  date_format($this->created_at,"F D, Y").' at '.date_format($this->created_at,"g:i a"),
                'action' => "<a class='btn btn-warning' href=".route('admin.comments.edit', $this->id).">Edit</a> <a class='btn btn-primary' href=".route('post.single', $this->post->slug)." target='blank'>View post</a> <a class='btn btn-danger' href='".route('admin.comments.destroy',$this->id)."'>Delete</a>",
            ];
        }

        if($this::getTable() == 'product__comments'){
            return [
                'author'=> ($this->name)? $this->name : $this->user->name,
                'content' => Str::words(strip_tags($this->body),5),
                'restonse_to' => $this->product->title,
                'status' => $status,
                'date' =>  date_format($this->created_at,"F D, Y").' at '.date_format($this->created_at,"g:i a"),
                'action' => "<a class='btn btn-warning' href=".route('admin.product.comments.edit', $this->id).">Edit</a> <a class='btn btn-primary' href=".route('shop.single', $this->product->slug)." target='blank'>View product</a> <a class='btn btn-danger' href='".route('admin.product.comments.destroy',$this->id)."'>Delete</a>",
            ];
        }

        if($this::getTable() == 'product_reviews'){
            return [
                'author'=> ($this->name)? $this->name : $this->user->name,
                'content' => Str::words(strip_tags($this->body),5),
                'restonse_to' => $this->product->title,
                'status' => $status,
                'rating' => $rating,
                'date' =>  date_format($this->created_at,"F D, Y").' at '.date_format($this->created_at,"g:i a"),
                'action' => "<a class='btn btn-warning' href=".route('admin.product.reviews.edit', $this->id).">Edit</a> <a class='btn btn-primary' href=".route('shop.single', $this->product->slug)." target='blank'>View product</a> <a class='btn btn-danger' href='".route('admin.product.reviews.destroy',$this->id)."'>Delete</a>",
            ];
        }
    }
}