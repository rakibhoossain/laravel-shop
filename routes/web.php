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


Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');


//Admin
Route::group(['prefix' => '/admin','middleware' => ['is_admin']], function () {
	
	Route::group(['prefix' => '/'], function () {
		Route::get('/', 'AdminController@index')->name('admin');
		Route::get('/notification/{id}', 'ShopNotificationController@show')->name('admin.notification');
		Route::get('/notification/delete/{id}', 'ShopNotificationController@delete')->name('admin.notification.delete');
		Route::get('/notification/', 'ShopNotificationController@index')->name('admin.notifications');
	});

	Route::group(['prefix' => '/product'], function () {

		Route::get('/', 'ProductController@index')->name('admin.product');
		Route::get('/create', 'ProductController@create')->name('admin.product.create');
		Route::post('/store', 'ProductController@store')->name('admin.product.store');
		Route::get('/edit/{id}', 'ProductController@edit')->name('admin.product.edit');
		Route::post('/update/{id}', 'ProductController@update')->name('admin.product.update');
		Route::post('/delete/{id}', 'ProductController@destroy')->name('admin.product.destroy');

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
			Route::get('/destroy/{id}', 'OrderController@destroy')->name('admin.product.order.destroy');

			Route::get('/users-list', 'OrderController@ordersList')->name('admin.product.order.list'); 

		});

		Route::group(['prefix' => '/brand'], function () {
			Route::get('/', 'BrandController@index')->name('admin.product.brand');
			Route::get('/create', 'BrandController@create')->name('admin.product.brand.create');
			Route::post('/store', 'BrandController@store')->name('admin.product.brand.store');
			
			Route::get('/edit/{id}', 'BrandController@edit')->name('admin.product.brand.edit');

			Route::post('/update/{id}', 'BrandController@update')->name('admin.product.brand.update');

			Route::post('/delete/{id}', 'BrandController@destroy')->name('admin.product.brand.destroy');
		});



	});

});

Route::group(['prefix' => '/shop'], function () {
	Route::get('/', 'ShopController@index')->name('shop');
	Route::get('/single/{slug}', 'ShopController@show')->name('shop.single');
	
	Route::get('/category/{slug}', 'ShopController@categoryProduct')->name('shop.category');
	Route::get('/brand/{slug}', 'ShopController@brandProduct')->name('shop.brand');

	Route::get('/search', 'ShopController@search')->name('shop.search');

	Route::group(['prefix' => '/cart', 'middleware' => ['auth']], function () {
		Route::get('/', 'CartController@index')->name('cart')->middleware('cart_empty');
		Route::get('/product/{slug}', 'CartController@addTo')->name('cart.add');
		Route::post('/product', 'CartController@singleToAdd')->name('cart.singleToAdd');

		Route::get('/product', 'CartController@index')->middleware('cart_empty'); // handling only
		
		Route::get('/product/delete/{id}', 'CartController@addToDelete')->name('cart.delete');
		Route::post('/product/update/', 'CartController@addToUpdate')->name('cart.update');

		Route::get('/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('cart_empty');
		Route::post('/order', 'OrderController@store')->name('cart.order');
	});

	Route::group(['prefix' => '/account', 'middleware' => ['auth']], function () {
		Route::get('/', 'AccountController@index')->name('account');
		Route::get('/order', 'AccountController@order')->name('account.order');
		Route::get('/order/view/{id}', 'AccountController@orderView')->name('account.order.view');
		Route::get('/order/edit/{id}', 'AccountController@orderEdit')->name('account.order.edit');
	});


});


// Route::group(['prefix' => '/post'], function () {

// });

// Route::group(['prefix' => '/page'], function () {

// });


Route::get('uploadfile','HomeController@uploadFile');
Route::post('uploadfile','HomeController@uploadFilePost');

