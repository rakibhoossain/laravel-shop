<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = ['name','email', 'subject', 'message'];
}
