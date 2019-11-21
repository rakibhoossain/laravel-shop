<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Post_Category_Relation extends Pivot
{
    protected $table = 'post__category__relations';
    public $incrementing = true;

    protected $fillable = [
        'post_id', 'post_categories_id'
    ];

    // public function category()
    // {
    //     return $this->belongsTo(Post_category::class, 'post_categories_id');
    // }

    // public function post()
    // {
    //     return $this->belongsTo(Post::class, 'post_id');
    // }
}
