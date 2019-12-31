<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');


//Admin
Route::group(['prefix' => '/admin','middleware' => ['is_admin','verified']], function () {
	
	Route::group(['prefix' => '/'], function () {
		Route::get('/', 'AdminController@index')->name('admin');
		Route::get('/users', 'AdminController@users')->name('admin.user');
		Route::get('/users-list', 'AdminController@usersList')->name('admin.user.list');

		Route::get('/notification/{id}', 'ShopNotificationController@show')->name('admin.notification');
		Route::get('/notification/delete/{id}', 'ShopNotificationController@delete')->name('admin.notification.delete');
		Route::get('/notification/', 'ShopNotificationController@index')->name('admin.notifications');

		Route::group(['prefix' => '/comments'], function () {
			Route::get('/', 'CommentController@index')->name('admin.comments');
			Route::get('/delete/{id}', 'CommentController@destroy')->name('admin.comments.destroy');
			Route::get('/edit/{id}', 'CommentController@edit')->name('admin.comments.edit');
			Route::post('/update/{id}', 'CommentController@update')->name('admin.comments.update');
			Route::get('/list', 'CommentController@commentsList')->name('admin.comments.list');
		});

	});

	Route::group(['prefix' => '/message'], function () {
		Route::get('/Five', 'MessageController@messageFive')->name('messages.five');
		Route::get('/', 'MessageController@index')->name('admin.message.index');
		Route::get('/view/{id}', 'MessageController@show')->name('admin.message.show');
		Route::get('/delete/{id}', 'MessageController@destroy')->name('admin.message.delete');
	});


	Route::group(['prefix' => '/user'], function () {
		Route::get('/view/{id}', 'UserController@show')->name('admin.user.show');
		Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
		Route::post('/update/{id}', 'UserController@update')->name('admin.user.update');
		Route::get('/delete/{id}', 'UserController@destroy')->name('admin.user.destroy');
	});

	Route::group(['prefix' => '/slider'], function () {
		Route::get('/', 'SliderController@index')->name('admin.slider');
		Route::get('/create', 'SliderController@create')->name('admin.slider.create');
		Route::post('/store', 'SliderController@store')->name('admin.slider.store');
		Route::get('/edit/{id}', 'SliderController@edit')->name('admin.slider.edit');
		Route::post('/update/{id}', 'SliderController@update')->name('admin.slider.update');
		Route::post('/delete/{id}', 'SliderController@destroy')->name('admin.slider.destroy');
	});

	Route::group(['prefix' => '/widget'], function () {
		Route::get('/', 'WidgetController@index')->name('admin.widget');
		Route::get('/create', 'WidgetController@create')->name('admin.widget.create');
		Route::post('/store', 'WidgetController@store')->name('admin.widget.store');
		
		Route::get('/edit/{id}', 'WidgetController@edit')->name('admin.widget.edit');
		Route::post('/update/{id}', 'WidgetController@update')->name('admin.widget.update');
		Route::post('/delete/{id}', 'WidgetController@destroy')->name('admin.widget.destroy');
	});


	Route::group(['prefix' => '/post'], function () {
		Route::get('/', 'PostController@index')->name('admin.post');
		Route::get('/create', 'PostController@create')->name('admin.post.create');
		Route::post('/store', 'PostController@store')->name('admin.post.store');
		Route::get('/edit/{id}', 'PostController@edit')->name('admin.post.edit');
		// Route::get('/show/{id}', 'PostController@show')->name('admin.post.show');

		Route::post('/update/{id}', 'PostController@update')->name('admin.post.update');
		Route::get('/delete/{id}', 'PostController@destroy')->name('admin.post.destroy');
		Route::get('/list', 'PostController@postList')->name('admin.post.list');

		Route::group(['prefix' => '/category'], function () {
			Route::get('/', 'PostCategoryController@index')->name('admin.post.category');
			Route::get('/create', 'PostCategoryController@create')->name('admin.post.category.create');
			Route::post('/store', 'PostCategoryController@store')->name('admin.post.category.store');
			
			Route::get('/edit/{id}', 'PostCategoryController@edit')->name('admin.post.category.edit');
			Route::post('/update/{id}', 'PostCategoryController@update')->name('admin.post.category.update');
			Route::post('/delete/{id}', 'PostCategoryController@destroy')->name('admin.post.category.destroy');
		});

		Route::group(['prefix' => '/tag'], function () {
			Route::get('/', 'TagController@index')->name('admin.post.tag');
			Route::get('/create', 'TagController@create')->name('admin.post.tag.create');
			Route::post('/store', 'TagController@store')->name('admin.post.tag.store');
			
			Route::get('/edit/{id}', 'TagController@edit')->name('admin.post.tag.edit');
			Route::post('/update/{id}', 'TagController@update')->name('admin.post.tag.update');
			Route::post('/delete/{id}', 'TagController@destroy')->name('admin.post.tag.destroy');
		});
	});

	Route::group(['prefix' => '/currency'], function () {
		Route::get('/', 'CurrencyController@index')->name('admin.currency');
		Route::get('/create', 'CurrencyController@create')->name('admin.currency.create');
		Route::post('/store', 'CurrencyController@store')->name('admin.currency.store');
		
		Route::get('/edit/{id}', 'CurrencyController@edit')->name('admin.currency.edit');
		Route::post('/update/{id}', 'CurrencyController@update')->name('admin.currency.update');
		Route::post('/delete/{id}', 'CurrencyController@destroy')->name('admin.currency.destroy');
	});
	Route::group(['prefix' => '/shipping'], function () {
		Route::get('/', 'ShippingController@index')->name('admin.shipping');
		Route::get('/create', 'ShippingController@create')->name('admin.shipping.create');
		Route::post('/store', 'ShippingController@store')->name('admin.shipping.store');
		
		Route::get('/edit/{id}', 'ShippingController@edit')->name('admin.shipping.edit');
		Route::post('/update/{id}', 'ShippingController@update')->name('admin.shipping.update');
		Route::post('/delete/{id}', 'ShippingController@destroy')->name('admin.shipping.destroy');
	});


	Route::group(['prefix' => '/product'], function () {

		Route::get('/', 'ProductController@index')->name('admin.product');
		Route::get('/create', 'ProductController@create')->name('admin.product.create');
		Route::post('/store', 'ProductController@store')->name('admin.product.store');
		Route::get('/edit/{id}', 'ProductController@edit')->name('admin.product.edit');
		Route::post('/update/{id}', 'ProductController@update')->name('admin.product.update');
		Route::get('/delete/{id}', 'ProductController@destroy')->name('admin.product.destroy');

		Route::get('/list', 'ProductController@productList')->name('admin.product.list');

		Route::group(['prefix' => '/category'], function () {
			Route::get('/', 'CategoryController@index')->name('admin.product.category');
			Route::get('/create', 'CategoryController@create')->name('admin.product.category.create');
			Route::post('/store', 'CategoryController@store')->name('admin.product.category.store');
			
			Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.product.category.edit');
			Route::post('/update/{id}', 'CategoryController@update')->name('admin.product.category.update');
			Route::post('/delete/{id}', 'CategoryController@destroy')->name('admin.product.category.destroy');
		});

		Route::group(['prefix' => '/order'], function () {
			Route::get('/', 'OrderController@index')->name('admin.product.order');
			Route::get('/show/{id}', 'OrderController@show')->name('admin.product.order.show');
			Route::get('/edit/{id}', 'OrderController@edit')->name('admin.product.order.edit');
			Route::post('/update/{id}', 'OrderController@update')->name('admin.product.order.update');
			Route::get('/destroy/{id}', 'OrderController@destroy')->name('admin.product.order.destroy');

			Route::get('/list', 'OrderController@ordersList')->name('admin.product.order.list');
			Route::get('/pdf/{id}', 'OrderController@pdf')->name('admin.product.order.pdf');

			Route::get('/income', 'OrderController@incomeChart')->name('admin.product.order.income');

		});

		Route::group(['prefix' => '/brand'], function () {
			Route::get('/', 'BrandController@index')->name('admin.product.brand');
			Route::get('/create', 'BrandController@create')->name('admin.product.brand.create');
			Route::post('/store', 'BrandController@store')->name('admin.product.brand.store');
			
			Route::get('/edit/{id}', 'BrandController@edit')->name('admin.product.brand.edit');

			Route::post('/update/{id}', 'BrandController@update')->name('admin.product.brand.update');

			Route::post('/delete/{id}', 'BrandController@destroy')->name('admin.product.brand.destroy');
		});



		Route::group(['prefix' => '/comments'], function () {
			Route::get('/', 'ProductCommentController@index')->name('admin.product.comments');
			Route::get('/delete/{id}', 'ProductCommentController@destroy')->name('admin.product.comments.destroy');
			Route::get('/edit/{id}', 'ProductCommentController@edit')->name('admin.product.comments.edit');
			Route::post('/update/{id}', 'ProductCommentController@update')->name('admin.product.comments.update');

			Route::get('/list', 'ProductCommentController@commentsList')->name('admin.product.comments.list');
		});

		Route::group(['prefix' => '/reviews'], function () {
			Route::get('/', 'ProductReviewController@index')->name('admin.product.reviews');
			Route::get('/delete/{id}', 'ProductReviewController@destroy')->name('admin.product.reviews.destroy');
			Route::get('/edit/{id}', 'ProductReviewController@edit')->name('admin.product.reviews.edit');
			Route::post('/update/{id}', 'ProductReviewController@update')->name('admin.product.reviews.update');

			Route::get('/list', 'ProductReviewController@commentsList')->name('admin.product.reviews.list');
		});







	});

});

Route::group(['prefix' => '/shop'], function () {
	Route::get('/', 'ShopController@index')->name('shop');
	Route::get('/single/{slug}', 'ShopController@show')->name('shop.single');

	Route::match(['get', 'post'], '/filter', 'ShopController@filter')->name('shop.filter');

	Route::get('/list', 'ShopController@itemList')->name('shop.product.list');
	
	Route::get('/category/{slug}', 'ShopController@categoryProduct')->name('shop.category');
	Route::get('/brand/{slug}', 'ShopController@brandProduct')->name('shop.brand');

	Route::get('/currency/{id}', 'ShopController@shopCurrency')->name('shop.currency');


	Route::get('/track/', 'OrderController@ordersTrackIndex')->name('shop.track');
	Route::post('/track/order', 'OrderController@ordersTrack')->name('shop.track.order');

	Route::get('/search', 'ShopController@search')->name('shop.search');

	Route::group(['prefix' => '/cart', 'middleware' => ['auth','verified']], function () {
		Route::get('/', 'CartController@index')->name('cart')->middleware('cart_empty');
		Route::get('/product/{slug}', 'CartController@addTo')->name('cart.add');
		Route::post('/product', 'CartController@singleToAdd')->name('cart.singleToAdd');

		Route::get('/product', 'CartController@index')->middleware('cart_empty'); // handling only
		
		Route::get('/product/delete/{id}', 'CartController@addToDelete')->name('cart.delete');
		Route::post('/product/update/', 'CartController@addToUpdate')->name('cart.update');

		Route::get('/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('cart_empty');
		Route::post('/order', 'OrderController@store')->name('cart.order');
	});

	Route::group(['prefix' => '/account', 'middleware' => ['auth','verified']], function () {
		Route::get('/', 'AccountController@index')->name('account');
		Route::get('/order', 'AccountController@order')->name('account.order');
		Route::get('/order/view/{id}', 'AccountController@orderView')->name('account.order.view');
	});

	Route::post('/comment', 'ProductCommentController@store')->name('product.comments.store');
	Route::post('/review', 'ProductReviewController@store')->name('product.review.store');

	Route::post('/subscribe', 'ShopController@storeEmail')->name('shop.subscribe');
	Route::post('/coupon', 'ShopController@couponApply')->name('shop.coupon');
});


Route::group(['prefix' => '/post'], function () {
	Route::get('/', 'BlogController@index')->name('post');
	Route::get('/category/{slug}', 'BlogController@categoryPost')->name('post.category');
	Route::get('/tag/{slug}', 'BlogController@tagPost')->name('post.tag');
	Route::get('/user/{id}', 'BlogController@userPost')->name('post.user');

	Route::get('/single/{slug}', 'BlogController@show')->name('post.single');
	Route::get('/search', 'BlogController@search')->name('post.search');

	Route::post('/comment', 'CommentController@store')->name('comments.store');
	
	// Route::get('/single/{slug}', 'ShopController@show')->name('shop.single');
	
	// Route::get('/category/{slug}', 'ShopController@categoryProduct')->name('shop.category');

	// Route::get('/search', 'ShopController@search')->name('shop.search');

});


Route::group(['prefix' => '/contact'], function () {
	Route::get('/', 'HomeController@contact')->name('contact');
	Route::post('/message', 'MessageController@store')->name('contact.store');
});




// Route::group(['prefix' => '/post'], function () {

// });

// Route::group(['prefix' => '/page'], function () {

// });


Route::get('uploadfile','HomeController@uploadFile');
Route::post('uploadfile','HomeController@uploadFilePost');