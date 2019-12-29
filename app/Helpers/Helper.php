<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Category;
use App\Tag;
use App\Post_category;
use App\Brand;
use App\Cart;
use App\Order;
use App\Shipping;
use App\Currency;
use App\Post;
use App\Product;
use App\Product_review;
use App\Widget;
use App\Address;
use App\User;
use App\City;
use App\Message;
use App\Comment;
use Auth;
use Session;
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




    //frontend brands supply
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }    

    //frontend brands supply
    public static function productBrandList($option='all')
    {
        if ($option=='all') {
           return Brand::orderBy('id', 'desc')->get();
        }
        return Brand::has('products')->orderBy('id', 'desc')->get();
    }

	//frontend cat supply
    public static function productCategoryList($option='all')
    {
        if ($option=='all') {
           return Category::orderBy('id', 'desc')->get();
        }
        return Category::has('products')->orderBy('id', 'desc')->get();
    }

    public static function postCategoryList($option='all')
    {   
        if ($option=='all') {
           return Post_category::orderBy('id', 'desc')->get(); 
        }
        return Post_category::has('posts')->orderBy('id', 'desc')->get();
    }

    public static function postTagList($option='all')
    {
        if ($option=='all') {
            return Tag::orderBy('id', 'desc')->get();
        }
        return Tag::has('posts')->orderBy('id', 'desc')->get();

    }

    public static function postCategory($post)
    {
        $cat = [];
        foreach($post->categories as $k => $category):
            $cat[$k] = $category->id;
        endforeach;
        return $cat;
    }

    public static function postTags($post)
    {
        $tag = [];
        foreach($post->tags as $k => $tg):
            $tag[$k] = $tg->id;
        endforeach;

        return $tag;
    }

    public static function recentPost()
    {
        return Post::orderBy('id', 'desc')->limit(3)->get();
    }

    public static function recentProduct($count = 4)
    {
        return Product::latest()->orderBy('id', 'desc')->limit($count)->get();
    }
    public static function inspireProduct($count = 8)
    {
        $products = Product::query();
        $products->join('carts', 'products.id', '=', 'carts.product_id')->orderBy('carts.quantity', 'desc')->select('products.*');
        return $products->limit($count)->get(); 
    }    

    public static function maxPrice()
    {
        return ceil(Product::max('offer_price'));
    
    }
    public static function minPrice()
    {
        return floor(Product::min('offer_price'));
    
    }

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

    //Admin order total price
    public static function orderPrice($id, $user_id)
    {
        $order_price = (float)Cart::where('user_id', $user_id)->where('order_id', $id)->sum('price');
        if ($order_price) {
            return number_format((float)($order_price), 2, '.', '');
        }else return 0;
    }

    //Admin order total price with shipping
    public static function grandPrice($id, $user_id)
    {
        $order = Order::find($id);
        if ($order) {
            $shipping_price = (float)$order->shipping->price; 
            $order_price = self::orderPrice($id, $user_id);
            return number_format((float)($order_price + $shipping_price), 2, '.', '');
        }else return 0;
    }

    //Admin home data
    public static function orderByMonth()
    {   
        $year_data = Order::whereYear('created_at', \Carbon\Carbon::now()->year)->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('status','completed')->get();
        $price = 0;
        foreach ($year_data as $data) {
            $price += $data->cart->sum('price');
            // $price += (float)Cart::where('order_id', $data->id)->sum('price');
        }
        return number_format((float)($price), 2, '.', '');
    }

    public static function orderByYear()
    {   
        $month_data = Order::whereYear('created_at', \Carbon\Carbon::now()->year)->where('status','completed')->get();
        $price = 0;
        foreach ($month_data as $data) {
            $price += $data->cart->sum('price');
        }
        return number_format((float)($price), 2, '.', '');
    }

    public static function pendingComments()
    {   
        return Comment::where('status', '0')->count();
    }

    public static function shopUsers()
    {   
        return User::where('is_admin', '<>', '1')->count();
    }

    //frontend shipping
    public static function shiping()
    {
        return Shipping::orderBy('id', 'desc')->get();
    
    }    

    public static function cities()
    {
        return City::orderBy('name')->get();
    
    }

    //product review
    public static function reviewStar($product_id, $star = 0)
    {
        return (int)Product_review::where('product_id', $product_id)->where('status', '1')->where('rating', (float)$star)->count('rating');
    
    }
    //product review
    public static function reviewOveralStar($product_id, $option = 'avg')
    {
        if ($option == 'count') return Product_review::where('status', '1')->where('product_id', $product_id)->count('rating');
        return number_format((float)(Product_review::where('status', '1')->where('product_id', $product_id)->avg('rating')), 2, '.', '');
    }
    //user rating
    public static function reviewStar_fa($id)
    {
        $review = Product_review::find($id);
        $rating_count = (int)$review->rating;

        $rating = '';
        if ($rating_count) {
            $i=0;
            for (; $i < $rating_count; $i++) { 
                $rating .= '<i class="fa fa-star"></i>';
            }
            for ($j=5; $j > $i; $j--) { 
                $rating .= '<i class="fa fa-star-o"></i>';
            }
        }
        return $rating;
    }

    //frontend shipping
    public static function base_currency_data()
    {
        return ['symbol' => env('CURRENCY', '$'), 'code' => env('CURRENCY_CODE', 'USD')];   
    }

    public static function base_currency()
    {
        return env('CURRENCY', '$');   
    }    

    public static function currency()
    {
        if(Session::has('shop_currency')) {
            $data = Currency::find(Session::get('shop_currency'));
            if ($data) {
                return $data->symbol;
            }else{
                return self::base_currency();
            }
        }
        if( self::setting()->has('shop_currency') && !empty(setting('shop_currency')) ){
            $data = Currency::find(setting('shop_currency'));
            if ($data) {
                return $data->symbol;
            }else{
                return self::base_currency();
            }
        }
        return self::base_currency();  
    }

    public static function currency_amount($amount)
    {
        if(Session::has('shop_currency')) {
            $data = Currency::find(Session::get('shop_currency'));
            if ($data) {
                return number_format((float)($amount * $data->exchange_rate), 2, '.', '');
            }else{
                return number_format((float)($amount), 2, '.', '');
            }
        }
        if( self::setting()->has('shop_currency') && !empty(setting('shop_currency')) ){
            $data = Currency::find(setting('shop_currency'));
            if($data){
                return number_format((float)($amount * $data->exchange_rate), 2, '.', '');
            }else{
                return number_format((float)($amount), 2, '.', ''); 
            }
        }

        return number_format((float)($amount), 2, '.', '');
    }

    public static function base_amount($amount)
    {
        if(Session::has('shop_currency')) {
            $data = Currency::find(Session::get('shop_currency'));
            if ($data) {
                return number_format((float)($amount / $data->exchange_rate), 2, '.', '');
            }else{
                return number_format((float)($amount), 2, '.', '');
            }
        }
        if( self::setting()->has('shop_currency') && !empty(setting('shop_currency')) ){
            $data = Currency::find(setting('shop_currency'));
            if($data){
                return number_format((float)($amount / $data->exchange_rate), 2, '.', '');
            }else{
                return number_format((float)($amount), 2, '.', ''); 
            }
        }

        return number_format((float)($amount), 2, '.', '');
    }


    public static function currencies()
    {
        return Currency::orderBy('id', 'desc')->get();
        
    }    

    // get settings
    public static function setting()
    {
        return setting()->all(true);
        
    }

    //widget areas
    public static function widget_areas()
    {
        $widget = array();
        $widget['feature_1']='Feature 1';
        $widget['feature_2']='Feature 2';
        $widget['feature_3']='Feature 3';
        $widget['feature_4']='Feature 4';

        $widget['footer_1']='Footer 1';
        $widget['footer_2']='Footer 2';
        $widget['footer_3']='Footer 3';
        $widget['footer_4']='Footer 4';
        $widget['footer_5']='Footer 5';
        return $widget;
    
    }

    //getting widget
    public static function get_widget($position = '')
    {
        if ($position == 'footer') {
            return Widget::where('position', 'like', 'footer'.'%')->orderBy('position', 'asc')->get();
        }

        if ($position == 'feature') {
            return Widget::where('position', 'like', 'feature'.'%')->orderBy('position', 'asc')->get();
        }
        
        return Widget::orderBy('position', 'desc')->get();
    
    }

    //slug generate
    public static function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }    


    //order address by db
    public static function user_address($key, $user_id) {
        $user = User::find($user_id);
        if($user->address){
            $address = array();
            $address['first_name'] = $user->address->first_name;
            $address['last_name'] = $user->address->last_name;
            $address['address'] = $user->address->address;
            $address['city_id'] = $user->address->city->id;
            $address['country'] = $user->address->country;
            $address['post_code'] = $user->address->post_code;
            $address['phone_number'] = $user->address->phone_number;

            return (array_key_exists($key, $address))? $address[$key] : '';
        }
        return '';
    }

}