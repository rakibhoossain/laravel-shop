<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'post_id', 'parent_id', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function post()
    {
        return $this->belongsTo(Post::class);
    }    

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', '1');
    }
}
