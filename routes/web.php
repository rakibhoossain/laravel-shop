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
	});

});






Route::get('uploadfile','HomeController@uploadFile');
Route::post('uploadfile','HomeController@uploadFilePost');

// Auth::routes();