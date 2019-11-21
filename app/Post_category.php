<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_category extends Model
{
    protected $table = 'post_categories';

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Post_category::class, 'parent_id');
    }

    public function parent(){
   	return $this->belongsTo(Post_category::class, 'parent_id');
   }

    //Pivot post categories
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post__category__relations')->withTimestamps();
    }



}