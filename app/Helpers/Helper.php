<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Category;
use App\Post_category;
use App\Brand;
use App\Cart;
use App\Order;
use App\Shipping;
use App\Post;
use App\Product;
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

    public static function postCategoryList()
    {
        return Post_category::orderBy('id', 'desc')->get();
    
    }

    public static function postCategory($post)
    {
        $cat = [];
        foreach($post->categories as $k => $category):
            $cat[$k] = $category->id;
        endforeach;

        return $cat;
    }

    public static function recentPost()
    {
        return Post::orderBy('id', 'desc')->limit(3)->get();
    }

    public static function recentProduct()
    {
        return Product::orderBy('id', 'desc')->limit(4)->get();
    }
    public static function inspireProduct()
    {
        return Product::orderBy('id', 'desc')->limit(8)->get();
    }    

    // public static function postCommentTotal($post)
    // {
    //     return Post_category::orderBy('id', 'desc')->get();
    
    // }
    public static function maxPrice()
    {
        return ceil(Product::max('offer_price'));
    
    }
    public static function minPrice()
    {
        return floor(Product::min('offer_price'));
    
    }

    //frontend brands supply
    public static function productBrandList()
    {
        return Brand::orderBy('id', 'desc')->get();
    
    }


    // static $user_id = auth()->user()->id;

    //frontend cart count
    public static function cartCount( $user_id ='' )
    {   
    	if(Auth::check()) {
            if ($user_id == '') $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('quantity');
        }else return 0;
    }

    //frontend cart count
    public static function orderCount($id, $user_id='' )
    {
        if(Auth::check()) {
          if ($user_id == '') $user_id = auth()->user()->id;  
          return Cart::where('user_id', $user_id)->where('order_id', $id)->sum('quantity');   
        }else return 0;
    	
    
    }

    //frontend order price
    public static function orderPrice($id, $user_id='' )
    {
        
    	if(Auth::check()){
            if ($user_id == '') $user_id = auth()->user()->id;
            $order_price = (float)Cart::where('user_id', $user_id)->where('order_id', $id)->sum('price');
            if ($order_price) {
                return number_format((float)($order_price), 2, '.', '');
            }else return 0;
        }else return 0;
    }

    //frontend grand price
    public static function grandPrice($id, $user_id='' )
    {
        if(Auth::check()){
            if ($user_id == '') $user_id = auth()->user()->id;
            $order = Order::find($id)->first();
            if ($order) {
                $shipping_price = (float)$order->shipping->price; 
                $order_price = self::orderPrice($id, $user_id);
                return number_format((float)($order_price + $shipping_price), 2, '.', '');
            }else return 0;
        }else return 0;
    }

    //frontend shipping
    public static function shiping()
    {
        return Shipping::orderBy('id', 'desc')->get();
    
    }

    //frontend shipping
    public static function currency()
    {
        return '€';
    
    }

}