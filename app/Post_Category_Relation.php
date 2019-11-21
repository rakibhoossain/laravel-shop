<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Post_Category_Relation extends Pivot
{
    protected $table = 'post__category__relations';
    public $incrementing = true;

    protected $fillable = [
        'post_id', 'post_categories_id'
    ];
}
