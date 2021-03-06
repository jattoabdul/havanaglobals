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

	//Customers
	Route::get('/admin/customers', 'userController@index')->name('manage_customers');
	Route::post('/admin/user/promote', 'userController@makeAdmin')->name('make_admin');
	Route::post('/admin/user/demote', 'userController@makeCustomer')->name('make_customer');
	Route::post('/admin/user/login-faker', 'userController@loginAs')->name('login_as');

	//Orders
	Route::get('/admin/orders', 'orderController@index')->name('manage_orders');
	Route::get('/admin/order/view/{id}', 'orderController@view')->name('view_order');
	Route::get('/admin/order/{id}/status/update/{status}', 'orderController@updateStatus')->name('order_status_update');

	//Content Management
	Route::get('/admin/content', 'contentController@index')->name('manage_content');
	Route::get('/admin/content/edit/{id}', 'contentController@edit')->name('edit_content');
	Route::post('/admin/content/update', 'contentController@update')->name('update_content');
});

Route::get('/home', function() { return redirect('/'); });
Route::get('/', 'havanaController@home')->name('home');
Route::get('/contact', 'havanaController@contactUs')->name('contact');
Route::get('/about', 'havanaController@aboutUs')->name('about');
Route::get('/shop', 'searchController@index')->name('shop');

Route::get('/product/{id}/{slug?}', 'havanaController@productShow')->name('product_detail');

Route::get('/404', 'havanaController@notFound')->name('error_404');

Route::post('/cart/add', 'havanaController@cartAdd')->name('cart_add');
Route::get('/cart/show', 'havanaController@cartShow')->name('cart_show');
Route::get('/cart/remove/{row_id}', 'havanaController@cartRemove')->name('cart_remove');
Route::post('/cart/update', 'havanaController@cartUpdate')->name('cart_update');

Route::get('/cart/checkout', 'checkoutController@index')->name('cart_checkout');
Route::post('/address/add', 'checkoutController@addAddress')->name('add_address')->middleware('auth');
Route::post('/add/order', 'checkoutController@addOrder')->name('add_order')->middleware('auth');
Route::get('/invoice/pay/{order_id}', 'checkoutController@payInvoice')->name('pay_invoice')->middleware('auth');


//Wishlist
Route::post('/wishlist/add', 'havanaController@addToWishlist')->name('wish_add');
Route::post('/wishlist/remove', 'havanaController@removeFromWishlist')->name('remove_from_wishlist');

//Payment Route
Route::any('/payment/callback', 'paymentController@paystackCallback')->middleware('auth');
Route::any('/payment/confirmation', 'paymentController@confirm')->name('confirm_order')->middleware('auth');

//Account
Route::get('/account', 'accountController@index')->name('user_account');
Route::get('/account/password/change', 'accountController@editPassword')->name('edit_password');
Route::post('/account/password/update', 'accountController@updatePassword')->name('update_password');
Route::get('/account/addresses', 'accountController@addressBook')->name('show_address');
Route::get('/account/addresses/edit/{id}', 'accountController@editAddress')->name('edit_address');
Route::post('/account/addresses/update/{id}', 'accountController@updateAddress')->name('update_address');
Route::get('/account/orders', 'accountController@showOrders')->name('show_orders');
Route::get('/account/info/edit', 'accountController@editInfo')->name('edit_account');
Route::post('/account/info/save', 'accountController@saveInfo')->name('save_account');
Route::get('/account/wishlist', 'accountController@wishlist')->name('show_wishlist');


Auth::routes();
Route::post('/guest/register', 'Auth\RegisterController@guestRegister')->name('guest_register');
