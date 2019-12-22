<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
