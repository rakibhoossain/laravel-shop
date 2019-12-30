<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function findById($id)
    {
        return self::find($id);
    }
}
