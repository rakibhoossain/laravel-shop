<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Category_Relation extends Model
{
    protected $table = 'post__category__relations';

    protected $fillable = [
        'post_id', 'post_categories_id'
    ];

    public function category()
    {
        return $this->belongsTo(Post_category::class, 'post_categories_id');
    }
}
