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

    public function terms(){
   		return $this->hasMany(Post_Category_Relation::class);
   }

   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
