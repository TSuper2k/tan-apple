<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/admin', 'App\Http\Controllers\AdminLoginController@loginAdmin');
// Route::post('/admin', 'App\Http\Controllers\AdminLoginController@postLoginAdmin');

Route::get('/home', function () {
	return view('home');
});

//Admin
Route::prefix('admin')->group(function () {
	//Home
	Route::prefix('home')->group(function () {
		Route::get('/', [
			'as' => 'home.index',
			'uses' => 'App\Http\Controllers\AdminHomeController@index',
		]);
	});

	//Category
	Route::prefix('categories')->group(function () {
		Route::get('/', [
			'as' => 'categories.index',
			'uses' => 'App\Http\Controllers\AdminCategoryController@index',
			'middleware' => 'can:category-list'
		]);
		Route::get('/create', [
			'as' => 'categories.create',
			'uses' => 'App\Http\Controllers\AdminCategoryController@create',
			'middleware' => 'can:category-add'
		]);
		Route::post('/store', [
			'as' => 'categories.store',
			'uses' => 'App\Http\Controllers\AdminCategoryController@store'
		]);

		Route::get('/edit/{id}', [
			'as' => 'categories.edit',
			'uses' => 'App\Http\Controllers\AdminCategoryController@edit',
			'middleware' => 'can:category-edit'
		]);

		Route::post('/update/{id}', [
			'as' => 'categories.update',
			'uses' => 'App\Http\Controllers\AdminCategoryController@update'
		]);

		Route::get('/delete/{id}', [
			'as' => 'categories.delete',
			'uses' => 'App\Http\Controllers\AdminCategoryController@delete',
			'middleware' => 'can:category-delete'
		]);
	});

	//Menu
	Route::prefix('menus')->group(function () {
		Route::get('/', [
			'as' => 'menus.index',
			'uses' => 'App\Http\Controllers\AdminMenuController@index',
			'middleware' => 'can:menu-list'
		]);
		Route::get('/create', [
			'as' => 'menus.create',
			'uses' => 'App\Http\Controllers\AdminMenuController@create',
			'middleware' => 'can:menu-add'
		]);
		Route::post('/store', [
			'as' => 'menus.store',
			'uses' => 'App\Http\Controllers\AdminMenuController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'menus.edit',
			'uses' => 'App\Http\Controllers\AdminMenuController@edit',
			'middleware' => 'can:menu-edit'
		]);

		Route::post('/update/{id}', [
			'as' => 'menus.update',
			'uses' => 'App\Http\Controllers\AdminMenuController@update'
		]);

		Route::get('/delete/{id}', [
			'as' => 'menus.delete',
			'uses' => 'App\Http\Controllers\AdminMenuController@delete',
			'middleware' => 'can:menu-delete'
		]);
	});

	//Product
	Route::prefix('product')->group(function () {
		Route::get('/', [
			'as' => 'product.index',
			'uses' => 'App\Http\Controllers\AdminProductController@index',
			'middleware' => 'can:product-list'
		]);
		Route::get('/create', [
			'as' => 'product.create',
			'uses' => 'App\Http\Controllers\AdminProductController@create',
			'middleware' => 'can:product-add'
		]);
		Route::post('/store', [
			'as' => 'product.store',
			'uses' => 'App\Http\Controllers\AdminProductController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'product.edit',
			'uses' => 'App\Http\Controllers\AdminProductController@edit',
			'middleware' => 'can:product-edit,id'
		]);
		Route::post('/update/{id}', [
			'as' => 'product.update',
			'uses' => 'App\Http\Controllers\AdminProductController@update'
		]);
		Route::get('/delete/{id}', [
			'as' => 'product.delete',
			'uses' => 'App\Http\Controllers\AdminProductController@delete',
			'middleware' => 'can:product-delete'
		]);
	});

	//Slider
	Route::prefix('slider')->group(function () {
		Route::get('/', [
			'as' => 'slider.index',
			'uses' => 'App\Http\Controllers\AdminSliderController@index',
			'middleware' => 'can:slider-list'
		]);
		Route::get('/create', [
			'as' => 'slider.create',
			'uses' => 'App\Http\Controllers\AdminSliderController@create',
			'middleware' => 'can:slider-add'
		]);
		Route::post('/store', [
			'as' => 'slider.store',
			'uses' => 'App\Http\Controllers\AdminSliderController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'slider.edit',
			'uses' => 'App\Http\Controllers\AdminSliderController@edit',
			'middleware' => 'can:slider-edit'
		]);
		Route::post('/update/{id}', [
			'as' => 'slider.update',
			'uses' => 'App\Http\Controllers\AdminSliderController@update'
		]);
		Route::get('/delete/{id}', [
			'as' => 'slider.delete',
			'uses' => 'App\Http\Controllers\AdminSliderController@delete',
			'middleware' => 'can:slider-delete'
		]);
	});

	//Setting
	Route::prefix('settings')->group(function () {
		Route::get('/', [
			'as' => 'settings.index',
			'uses' => 'App\Http\Controllers\AdminSettingController@index',
			'middleware' => 'can:setting-list'
		]);
		Route::get('/create', [
			'as' => 'settings.create',
			'uses' => 'App\Http\Controllers\AdminSettingController@create',
			'middleware' => 'can:setting-add'
		]);
		Route::post('/store', [
			'as' => 'settings.store',
			'uses' => 'App\Http\Controllers\AdminSettingController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'settings.edit',
			'uses' => 'App\Http\Controllers\AdminSettingController@edit',
			'middleware' => 'can:setting-edit'
		]);
		Route::post('/update/{id}', [
			'as' => 'settings.update',
			'uses' => 'App\Http\Controllers\AdminSettingController@update'
		]);
		Route::get('/delete/{id}', [
			'as' => 'settings.delete',
			'uses' => 'App\Http\Controllers\AdminSettingController@delete',
			'middleware' => 'can:setting-delete'
		]);
	});

	//Order
	Route::prefix('orders')->group(function () {
		Route::get('/', [
			'as' => 'orders.index',
			'uses' => 'App\Http\Controllers\AdminOrderController@index',
			'middleware' => 'can:order-list'
		]);
		Route::get('/view/{id}', [
			'as' => 'orders.view',
			'uses' => 'App\Http\Controllers\AdminOrderController@view',
			'middleware' => 'can:order-edit'
		]);
		// Route::get('/create', [
		//     'as' => 'orders.create',
		//     'uses' => 'App\Http\Controllers\AdminOrderController@create',
		//     // 'middleware' => 'can:order-add'
		// ]);
		Route::post('/update-order-qty', [
			'as' => 'orders.updateOrderQty',
			'uses' => 'App\Http\Controllers\AdminOrderController@updateOrderQty'
		]);

		Route::post('/update-qty', [
			'as' => 'orders.updateQty',
			'uses' => 'App\Http\Controllers\AdminOrderController@updateQty'
		]);
		// Route::get('/edit/{id}', [
		//     'as' => 'orders.edit',
		//     'uses' => 'App\Http\Controllers\AdminOrderController@edit',
		//     // 'middleware' => 'can:order-edit,id'
		// ]);
		// Route::post('/update/{id}', [
		//     'as' => 'orders.update',
		//     'uses' => 'App\Http\Controllers\AdminOrderController@update'
		// ]);
		Route::get('/delete/{id}', [
			'as' => 'orders.delete',
			'uses' => 'App\Http\Controllers\AdminOrderController@delete',
			'middleware' => 'can:order-delete'
		]);
	});

	//User
	Route::prefix('users')->group(function () {
		Route::get('/', [
			'as' => 'users.index',
			'uses' => 'App\Http\Controllers\AdminUserController@index',
			'middleware' => 'can:user-list'
		]);
		Route::get('/create', [
			'as' => 'users.create',
			'uses' => 'App\Http\Controllers\AdminUserController@create',
			'middleware' => 'can:user-add'
		]);
		Route::post('/store', [
			'as' => 'users.store',
			'uses' => 'App\Http\Controllers\AdminUserController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'users.edit',
			'uses' => 'App\Http\Controllers\AdminUserController@edit',
			'middleware' => 'can:user-edit'
		]);
		Route::post('/update/{id}', [
			'as' => 'users.update',
			'uses' => 'App\Http\Controllers\AdminUserController@update'
		]);
		Route::get('/delete/{id}', [
			'as' => 'users.delete',
			'uses' => 'App\Http\Controllers\AdminUserController@delete',
			'middleware' => 'can:user-delete'
		]);
	});

	//Customer
	Route::prefix('customers')->group(function () {
		Route::get('/', [
			'as' => 'customers.index',
			'uses' => 'App\Http\Controllers\AdminCustomerController@index',
			'middleware' => 'can:customer-list'
		]);
		// Route::get('/create', [
		//     'as' => 'customers.create',
		//     'uses' => 'App\Http\Controllers\AdminCustomerController@create',
		//     // 'middleware' => 'can:customer-add'
		// ]);
		// Route::post('/store', [
		//     'as' => 'customers.store',
		//     'uses' => 'App\Http\Controllers\AdminCustomerController@store'
		// ]);
		// Route::get('/edit/{id}', [
		//     'as' => 'customers.edit',
		//     'uses' => 'App\Http\Controllers\AdminCustomerController@edit',
		//     // 'middleware' => 'can:customer-edit'
		// ]);
		// Route::post('/update/{id}', [
		//     'as' => 'customers.update',
		//     'uses' => 'App\Http\Controllers\AdminCustomerController@update'
		// ]);
		Route::get('/delete/{id}', [
			'as' => 'customers.delete',
			'uses' => 'App\Http\Controllers\AdminCustomerController@delete',
			'middleware' => 'can:customer-delete'
		]);
	});

	//Statistical
	Route::prefix('statistical')->group(function () {
		Route::get('/', [
			'as' => 'statistical.index',
			'uses' => 'App\Http\Controllers\AdminStatisticalController@index',
			'middleware' => 'can:statistical-list'
		]);
		Route::post('/filter-by-date', [
			'as' => 'statistical.filter-by-date',
			'uses' => 'App\Http\Controllers\AdminStatisticalController@filter_by_date',
			// 'middleware' => 'can:menu-list'
		]);
		Route::post('/dashboard-filter', [
			'as' => 'statistical.dashboard-filter',
			'uses' => 'App\Http\Controllers\AdminStatisticalController@dashboard_filter',
			// 'middleware' => 'can:menu-list'
		]);
		Route::post('/days-order', [
			'as' => 'statistical.days-order',
			'uses' => 'App\Http\Controllers\AdminStatisticalController@days_order',
			// 'middleware' => 'can:menu-list'
		]);
	});

	//Role
	Route::prefix('roles')->group(function () {
		Route::get('/', [
			'as' => 'roles.index',
			'uses' => 'App\Http\Controllers\AdminRoleController@index',
			'middleware' => 'can:role-list'
		]);
		Route::get('/create', [
			'as' => 'roles.create',
			'uses' => 'App\Http\Controllers\AdminRoleController@create',
			'middleware' => 'can:role-add'
		]);
		Route::post('/store', [
			'as' => 'roles.store',
			'uses' => 'App\Http\Controllers\AdminRoleController@store'
		]);
		Route::get('/edit/{id}', [
			'as' => 'roles.edit',
			'uses' => 'App\Http\Controllers\AdminRoleController@edit',
			'middleware' => 'can:role-edit'
		]);
		Route::post('/update/{id}', [
			'as' => 'roles.update',
			'uses' => 'App\Http\Controllers\AdminRoleController@update'
		]);
		Route::get('/delete/{id}', [
			'as' => 'roles.delete',
			'uses' => 'App\Http\Controllers\AdminRoleController@delete',
			'middleware' => 'can:role-delete'
		]);
	});

	//Permission
	Route::prefix('permissions')->group(function () {
		Route::get('/create', [
			'as' => 'permissions.create',
			'uses' => 'App\Http\Controllers\AdminPermissionController@createPermission',
			'middleware' => 'can:permission-add'
		]);
		Route::post('/store', [
			'as' => 'permissions.store',
			'uses' => 'App\Http\Controllers\AdminPermissionController@store'
		]);
	});
});

//Client
Route::get('/', 'App\Http\Controllers\ClientHomeController@index')->name('home');

//Search
Route::post('/search', 'App\Http\Controllers\ClientHomeController@search')->name('search');

//Detail Product
Route::get('/detail/{slug}/{id}', [
	'as' => 'detail.product',
	'uses' => 'App\Http\Controllers\ClientHomeController@detail'
]);

//Category
Route::get('/category/{slug}/{id}', [
	'as' => 'category.product',
	'uses' => 'App\Http\Controllers\ClientCategoryController@index'
]);

//Login Client
// Route::get('/client', 'App\Http\Controllers\ClientLoginController@index')->name('loginClient');


//Cart
Route::get('cart', 'App\Http\Controllers\ClientHomeController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'App\Http\Controllers\ClientHomeController@addToCart')->name('add.to.cart');
Route::patch('update-cart', 'App\Http\Controllers\ClientHomeController@update')->name('update.cart');
Route::delete('remove-from-cart', 'App\Http\Controllers\ClientHomeController@remove')->name('remove.from.cart');

//Checkout
Route::get('/login-checkout', 'App\Http\Controllers\ClientCheckoutController@loginCheckout')->name('login-checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\ClientCheckoutController@logoutCheckout')->name('logout-checkout');
Route::post('/add-customer', 'App\Http\Controllers\ClientCheckoutController@addCustomer')->name('add-customer');
Route::post('/login-customer', 'App\Http\Controllers\ClientCheckoutController@loginCustomer')->name('login-customer');
Route::get('/checkout', 'App\Http\Controllers\ClientCheckoutController@checkout')->name('checkout');
Route::post('/save-checkout', 'App\Http\Controllers\ClientCheckoutController@saveCheckout')->name('save-checkout');

// Route::get('/payment', 'App\Http\Controllers\ClientCheckoutController@payment')->name('payment');
Route::post('/order', 'App\Http\Controllers\ClientCheckoutController@order')->name('order');

//Orders
Route::get('/order-status', 'App\Http\Controllers\ClientOrderController@orderStatus')->name('order-status');
Route::get('/order-status-detail/{id}', 'App\Http\Controllers\ClientOrderController@orderStatusDetail')->name('order-status-detail');

//Paypal
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
