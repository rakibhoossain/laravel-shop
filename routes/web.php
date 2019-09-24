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
Route::group(['prefix' => '/admin'], function () {
	
	Route::group(['prefix' => '/'], function () {
		Route::get('/', 'AdminController@index')->name('admin');
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



	});

});

Route::group(['prefix' => '/shop'], function () {
	Route::get('/', 'ShopController@index')->name('shop');
	Route::get('/single/{slug}', 'ShopController@show')->name('shop.single');


	Route::get('/search', 'ShopController@search')->name('shop.search');
});




Route::get('uploadfile','HomeController@uploadFile');
Route::post('uploadfile','HomeController@uploadFilePost');

