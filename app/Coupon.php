<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
    	if ($this->type == 'fixed') {
    		return $this->value;
    	}elseif ($this->type == 'percent') {
    		return number_format((float)(($this->value / 100) * $total), 2, '.', '');
    	}else{
    		return 0.0;
    	}
    }

    public function orders()
    {
      return $this->hasMany(Order_Coupon::class);
    }
}