<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'body'
    ];

    public function comments()
    {
         return $this->hasMany(Comment::class)->whereNull('parent_id')->where('status', '1');
    }    

    public function allComments()
    {
         return $this->hasMany(Comment::class)->where('status', '1');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Pivot post categories
    public function categories()
    {
        return $this->belongsToMany(Post_category::class, 'post__category__relations')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post')->withTimestamps();
    }




}
