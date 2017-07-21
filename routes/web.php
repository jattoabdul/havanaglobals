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


Route::group(['namespace'=>'Admin', 'middleware'=>['auth', 'admin']], function ()
{
	Route::get('/admin/dashboard', 'dashboardController@index')->name('admin_dashboard');
	Route::get('/admin', function(){
		return redirect()->route('admin_dashboard');
	});

	//Products
	Route::get('/admin/products', 'productController@index')->name('manage_products');
	Route::get('/admin/products/create', 'productController@create')->name('create_products');
	Route::post('/admin/products/save', 'productController@save')->name('save_products');
	Route::post('/admin/products/update', 'productController@update')->name('update_products');
	Route::get('/admin/products/edit/{id}', 'productController@edit')->name('edit_products');
	Route::post('/admin/products/delete', 'productController@delete')->name('delete_products');
	Route::post('/admin/products/image/delete', 'productController@deleteImage')->name('delete_product_image');
	Route::post('/admin/products/multi-image/delete', 'productController@deleteMany')->name('delete_multi_image');

	//Category
	Route::get('/admin/categories', 'categoryController@index')->name('manage_categories');
	Route::post('/admin/categories/save', 'categoryController@save')->name('save_categories');
	Route::post('/admin/categories/delete', 'categoryController@delete')->name('delete_categories');
	Route::get('/admin/categories/edit/{id}', 'categoryController@edit')->name('edit_categories');
	Route::post('/admin/categories/update/{id}', 'categoryController@update')->name('update_categories');
});

Route::get('/home', function() { return redirect('/'); });
Route::get('/', 'havanaController@home')->name('home');

Route::get('/product/{id}/{slug}', 'havanaController@productShow')->name('product_detail');

Route::get('/404', 'havanaController@notFound')->name('error_404');

Route::post('/cart/add', 'havanaController@cartAdd')->name('cart_add');
Route::get('/cart/show', 'havanaController@cartShow')->name('cart_show');
Route::get('/cart/remove/{row_id}', 'havanaController@cartRemove')->name('cart_remove');
Route::post('/cart/update', 'havanaController@cartUpdate')->name('cart_update');


Auth::routes();
