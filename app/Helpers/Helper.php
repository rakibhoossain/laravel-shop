<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Category;
use App\Brand;
use App\Cart;
use Auth;
class Helper
{
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source https://gravatar.com/site/implement/images/php/
	 */
	public static function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'https://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}

	//frontend cat supply
    public static function productCategoryList()
    {
        return Category::orderBy('id', 'desc')->get();
    
    }

    //frontend brands supply
    public static function productBrandList()
    {
        return Brand::orderBy('id', 'desc')->get();
    
    }

    //frontend cart count
    public static function cartCount()
    {
    	if(Auth::check()) return Cart::where('user_id', auth()->user()->id)->sum('quantity');
    	else return 0;
    
    }

}