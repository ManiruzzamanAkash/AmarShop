<?php

use Illuminate\Support\Facades\Mail;



/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/

// Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Auth::routes();


/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/
Route::get('/', 'PageController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/product/{slug}', 'ProductController@show')->name('product.show');

Route::get('/request-products', 'ProductController@request_products')->name('product.request_products');
Route::get('/request-product/{slug}', 'ProductController@request_products_show')->name('product.request_products.show');

Route::get('/ad-product', 'ProductController@create')->name('product.create');
Route::post('/ad-product', 'ProductController@store')->name('product.create');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/{id}', 'CartController@create')->name('cart.create');
Route::post('/cart/update/{id}', 'CartController@update')->name('cart.update');
Route::post('/cart/delete/{id}', 'CartController@destroy')->name('cart.destroy');




Route::get('/request-product', 'ProductController@request')->name('product.request');
Route::post('/request-product', 'ProductController@request_store')->name('product.request');

Route::get('/product/search/all/', 'PageController@searchProduct')->name('product.search');

Route::get('/divisions', 'PageController@divisions')->name('divisions');
Route::get('/division/{division_slug}/products', 'PageController@division_product')->name('product.division.index');

Route::get('/categories', 'PageController@categories')->name('categories');
Route::get('/category/{category_slug}/products', 'PageController@category_product')->name('product.category.index');

Route::get('/brands', 'PageController@brands')->name('brands');
Route::get('/brand/{brand_slug}/products', 'PageController@brand_product')->name('product.brand.index');

Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
Route::post('/wishlist', 'WishlistController@store')->name('wishlist.store');

Route::get('/notification', 'NotificationController@index')->name('notification');
Route::get('/notification/show/{id}', 'NotificationController@show')->name('notification.show');
Route::post('/notification/delete/{id}', 'NotificationController@destroy')->name('notification.delete');


/*
|--------------------------------------------------------------------------
| Order | Shipping Routes
|--------------------------------------------------------------------------
*/
Route::get('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('/order/store', 'OrderController@store')->name('order.store');






/*
|--------------------------------------------------------------------------
| Email Routes
|--------------------------------------------------------------------------
*/
Route::get('mail/queue', function() {
	$data = ['name' => 'Maniruzzaman'];

	Mail::later(5, 'emails.queued_email', $data, function($message)
	{
		$message->to('abulkalam.skg@gmail.com', 'Abul Kalam')->subject('Testing Queued Email from Amar Shop');
	});

	return 'Email will be send in 5 seconds sir..!';

});




/*
|--------------------------------------------------------------------------
| Company Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'company'], function() {
	Route::get('/{username}', "CompanyController@show")->name('company.show');
	Route::get('/company/welcome', "CompanyController@welcome")->name('company.welcome');
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user'], function() {

	//User Pages
	Route::get('/{username}', "UserController@show")->name('user.show');
	Route::get('/{username}/edit', "UserController@edit")->name('user.edit');

	Route::post('/{username}/edit', "UserController@update")->name('user.update');

	Route::post('/{id}/change-profile-picture', "UserController@changeProfilePicture")->name('user.change_profile_picture');

	Route::post('/change-profile-picture', 'UserController@uploadProfilePicture')->name('user.upload_profile_picture');
	
	Route::post('/trust/change', 'UserController@changeTrustStatus')->name('user.trust.change');




});

/*
|--------------------------------------------------------------------------
| Authenticated User Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'dashboard'], function() {

	Route::get('/', "UserController@dashboard")->name('user.dashboard');

	Route::get('/change-shipping-address', "UserController@changeShippingAddress")->name('user.change_shipping_address');
	Route::post('/change-shipping-address', "UserController@changeShippingAddressStore")->name('user.change_shipping_address');

	Route::get('/update-profile', "UserController@updateProfile")->name('user.update_profile');
	Route::post('/update-profile/store', "UserController@updateProfileStore")->name('user.update_profile.store');

	Route::get('/manage-orders', "UserController@manageOrders")->name('user.manage_orders');
	
});



Route::get('/verification', 'VerificationController@verification')->name('verification');
Route::get('/verification/{token}', 'VerificationController@verificationToken')->name('verification.token');

Route::post('/verification', 'VerificationController@sendVerification')->name('verification.send');

Route::get('/search', 'PageController@search')->name('search');
Route::get('/api/search/{search}', 'PageController@apiSearch')->name('api.search');





/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	//Password resets routes

	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::post('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


	//Admin Pages
	Route::get('/', "AdminController@index")->name('admin.dashboard');
	Route::get('/manage-products', "AdminController@index")->name('admin.manage_products');

	//Manage Orders
	Route::get('/orders', 'OrderController@index')->name('admin.orders');


	//Category Routes
	Route::get('/category', "CategoryController@index")->name('admin.category.index');
	Route::get('/category/create', "CategoryController@create")->name('admin.category.create');
	Route::post('/category/create', "CategoryController@store")->name('admin.category.store');
	Route::get('/category/{id}/edit', "CategoryController@edit")->name('admin.category.edit');
	Route::post('/category/{id}/update', "CategoryController@update")->name('admin.category.update');
	Route::delete('/category/{id}', "CategoryController@destroy")->name('admin.category.delete');

	//Brand Routes
	Route::get('/brand', "BrandController@index")->name('admin.brand.index');
	Route::get('/brand/create', "BrandController@create")->name('admin.brand.create');
	Route::post('/brand/create', "BrandController@store")->name('admin.brand.store');
	Route::get('/brand/{id}/edit', "BrandController@edit")->name('admin.brand.edit');
	Route::post('/brand/{id}/update', "BrandController@update")->name('admin.brand.update');
	Route::delete('/brand/{id}', "BrandController@destroy")->name('admin.brand.delete');


	//Product Routes
	Route::group(['prefix' => '/product'], function() {
		Route::get('/', "AdminProductController@products_admin")->name('admin.product.index');

		Route::get('/request', "AdminProductController@admin_request")->name('admin.product.request_products');

		Route::post('/change-status/{id}/{post}', "AdminProductController@changeProductStatus")->name('admin.product.change');


		Route::get('/create', "AdminProductController@create")->name('admin.product.create');
		Route::get('/{id}/show', "AdminProductController@show")->name('admin.product.show');

		Route::get('/{id}/show', "AdminProductController@show")->name('admin.product.show');

		Route::get('/featured', "FeaturedController@index")->name('admin.product.featured');
		Route::post('/makeFeatured', "FeaturedController@store")->name('admin.product.makeFeatured');
		Route::post('/removeFeatured/{id}', "FeaturedController@destroy")->name('admin.product.removeFeatured');

		Route::post('/create', "AdminProductController@store")->name('admin.product.store');
		Route::get('/{id}/edit', "AdminProductController@edit")->name('admin.product.edit');
		Route::post('/{id}/update', "AdminProductController@update")->name('admin.product.update');
		Route::post('/{id}/delete', "AdminProductController@destroy")->name('admin.product.delete');
	});


	//Order Routes
	Route::group(['prefix' => '/order'], function() {
		
		Route::get('/{id}/show', "AdminOrderController@show")->name('admin.order.show');
		Route::post('/{id}', "AdminOrderController@is_paid")->name('admin.order.is_paid');

		Route::get('/', "AdminOrderController@order_incomplete")->name('admin.order');
		Route::get('/complete', "AdminOrderController@order_complete")->name('admin.order.complete');

		Route::post('/{id}/deliver', "AdminOrderController@deliver")->name('admin.order.deliver');

		Route::post('/{id}/delete', "AdminOrderController@destroy")->name('admin.order.delete');
	});

	//User Routes
	Route::group(['prefix' => '/user'], function() {
		Route::get('/', "AdminUserController@index")->name('admin.user');
		Route::get('/create', "AdminUserController@index")->name('admin.user.create');
		Route::post('/ban/{id}', "AdminUserController@ban")->name('admin.user.ban');
		Route::post('/{id}/make-admin', "AdminUserController@make_admin")->name('admin.user.make_admin');
		Route::post('/{id}/update-trust-point', "AdminUserController@update_trust_point")->name('admin.user.update_trust_point');
	});


	//District Routes
	Route::get('/district', "DistrictController@index")->name('admin.district.index');
	Route::get('/district/create', "DistrictController@create")->name('admin.district.create');
	Route::get('/district/id/show', "DistrictController@show")->name('admin.district.show');
	Route::post('/district/create', "DistrictController@store")->name('admin.district.store');
	Route::get('/district/{id}/edit', "DistrictController@edit")->name('admin.district.edit');
	Route::post('/district/{id}/update', "DistrictController@update")->name('admin.district.update');
	Route::post('/district/{id}/delete', "DistrictController@destroy")->name('admin.district.delete');

	//Division Routes
	Route::get('/division', "DivisionController@index")->name('admin.division.index');
	Route::get('/division/create', "DivisionController@create")->name('admin.division.create');
	Route::get('/division/id/show', "DivisionController@show")->name('admin.division.show');
	Route::post('/division/create', "DivisionController@store")->name('admin.division.store');
	Route::get('/division/{id}/edit', "DivisionController@edit")->name('admin.division.edit');
	Route::post('/division/{id}/update', "DivisionController@update")->name('admin.division.update');
	Route::post('/division/{id}/delete', "DivisionController@destroy")->name('admin.division.delete');

});














/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api'], function() {

	
	Route::get('/get_districts/{division_id}', "ApiDataController@get_districts")->name('api.get_districts');
	
	Route::get('/get_upazillas/{district_id}', "ApiDataController@get_upazillas")->name('api.get_upazillas');


});