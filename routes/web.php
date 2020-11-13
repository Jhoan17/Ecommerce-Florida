<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {    return view('page.home'); })->name('home');

// Auth::routes();

// // ROUTES PAGE
// Route::get('/catalogo', function () { return view('page.catalogo'); })->name('catalogo');
// Route::get('/blog', function () { return view('page.blog'); })->name('blog');
// Route::get('/work-us', function () { return view('page.work-us'); })->name('work-us');
// Route::get('/contact', function () { return view('page.contact'); })->name('contact');
// Route::get('/shop', function () { return view('page.shop'); })->name('shop');


Route::get('/', 'Security\LoginController@index')->name('login');
Route::post('security/login', 'Security\LoginController@login')->name('login-post');
Route::get('security/logout', 'Security\LoginController@logout')->name('logout');
Route::get('security/forgot-password', 'Security\LoginController@forgotPassword')->name('forgot-password');
Route::post('security/send-password', 'Security\LoginController@sendPasswordNew')->name('send-password');


Route::get('admin/desk', 'Admin\DeskController@index')->name('admin')->middleware('auth');




// ROUTES ADMIN
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function (){




	Route::get('/customer', 'CustomerController@index')->name('customer-index');


	//Rutas de Usuarios
	Route::get('/user', 'UserController@index')->name('user-index');
	Route::get('/user/create', 'UserController@create')->name('user-create');
	Route::post('/user/store', 'UserController@store')->name('user-store');
	Route::get('/user/edit/{user_id}', 'UserController@edit')->name('user-edit');
	Route::put('/user/update/{user_id}', 'UserController@update')->name('user-update');
	Route::get('/user/destroy/{user_id}', 'UserController@destroy')->name('user-destroy');
	Route::post('user/{user}', 'UserController@show')->name('user-show');
	//----------------------------------------------------------------------------
	Route::get('user/{user_id}/state', 'UserController@state')->name('user-change-state');
	Route::get('user/{user_id}/image/edit', 'UserController@editImage')->name('user-image-edit');
	Route::put('user/{user_id}/image', 'UserController@updateImage')->name('user-image-update');
//Fin rutas de Usuarios
//------------------------------------------------------------------------------



	Route::get('/suggestion', 'SuggestionController@index')->name('suggestion-index');


	Route::get('combo-type/', 'ComboTypeController@index')->name('combo-type-index');
	Route::get('combo-type/create', 'ComboTypeController@create')->name('combo-type-create');
	Route::post('combo-type/store', 'ComboTypeController@store')->name('combo-type-store');
	Route::get('combo-type/{combo_type_id}/edit', 'ComboTypeController@edit')->name('combo-type-edit');
	Route::put('combo-type/{combo_type_id}', 'ComboTypeController@update')->name('combo-type-update');
	Route::post('combo-type/', 'ComboTypeController@show')->name('combo-type-show');
	Route::get('combo-type/{combo_type_id}/destroy', 'ComboTypeController@destroy')->name('combo-type-destroy');


	Route::get('/combo', 'ComboController@index')->name('combo-index');
	Route::get('/combo/create', 'ComboController@create')->name('combo-create');
	Route::post('/combo/store', 'ComboController@store')->name('combo-store');
	Route::get('combo/{combo_id}/state', 'ComboController@state')->name('combo-change-state');
	Route::post('combo/{combo}', 'ComboController@show')->name('combo-show');
	Route::get('combo/{combo_id}/edit', 'ComboController@edit')->name('combo-edit');
	Route::put('combo/{combo_id}', 'ComboController@update')->name('combo-update');
	Route::get('combo/{combo_id}/destroy', 'ComboController@destroy')->name('combo-destroy');


	
	Route::get('combo/image/create/{combo}', 'ComboImageController@create')->name('combo-image-create');
	Route::post('combo/image/create/store', 'ComboImageController@store')->name('combo-image-store');
	Route::get('combo/image/edit/{combo_image_id}', 'ComboImageController@edit')->name('combo-image-edit');
	Route::put('combo/image/edit/{combo_image_id}', 'ComboImageController@update')->name('combo-image-update');
	Route::get('combo/image/destroy/{combo_image_id}', 'ComboImageController@destroy')->name('combo-image-destroy');




	Route::put('/combo-product/{combo_id}/store', 'ComboProductController@store')->name('combo-product-store');



	Route::get('product/', 'ProductController@index')->name('product-index');
	Route::get('product/create', 'ProductController@create')->name('product-create');
	Route::post('product/store', 'ProductController@store')->name('product-store');
	Route::get('product/{product_id}/edit', 'ProductController@edit')->name('product-edit');
	Route::put('product/{product_id}', 'ProductController@update')->name('product-update');
	Route::post('product/{product}', 'ProductController@show')->name('product-show');
	Route::get('product/{product_id}/destroy', 'ProductController@destroy')->name('product-destroy');
	Route::get('product/{product_id}/state', 'ProductController@state')->name('product-change-state');
	Route::get('product/{product_id}/image/edit', 'ProductController@editImage')->name('product-image-edit');
	Route::put('product/{product_id}/image', 'ProductController@updateImage')->name('product-image-update');
	


	Route::get('product-category/', 'ProductCategoryController@index')->name('product-category-index');
	Route::get('product-category/create', 'ProductCategoryController@create')->name('product-category-create');
	Route::post('product-category/store', 'ProductCategoryController@store')->name('product-category-store');
	Route::get('product-category/{product_category_id}/edit', 'ProductCategoryController@edit')->name('product-category-edit');
	Route::put('product-category/{product_category_id}', 'ProductCategoryController@update')->name('product-category-update');
	Route::post('product-category/', 'ProductCategoryController@show')->name('product-category-show');
	Route::get('product-category/{product_category_id}/destroy', 'ProductCategoryController@destroy')->name('product-category-destroy');


	// Estas son las rutas de base
	Route::get('base/', 'BaseController@index')->name('base-index');
	Route::get('base/create', 'BaseController@create')->name('base-create');
	Route::post('base/store', 'BaseController@store')->name('base-store');
	Route::get('base/{base_id}/edit', 'BaseController@edit')->name('base-edit');
	Route::put('base/{base_id}', 'BaseController@update')->name('base-update');
	Route::post('base/{base}', 'BaseController@show')->name('base-show');
	Route::get('base/{base_id}/destroy', 'BaseController@destroy')->name('base-destroy');
	Route::get('base/{base_id}/state', 'BaseController@state')->name('base-change-state');
	// Fin de las rutas de base


	Route::get('base/image/create/{base}', 'BaseImageController@create')->name('base-image-create');
	Route::post('base/image/create/store', 'BaseImageController@store')->name('base-image-store');
	Route::get('base/image/edit/{base_image_id}', 'BaseImageController@edit')->name('base-image-edit');
	Route::put('base/image/edit/{base_image_id}', 'BaseImageController@update')->name('base-image-update');
	Route::get('base/image/destroy/{base_image_id}', 'BaseImageController@destroy')->name('base-image-destroy');


	Route::get('order-all', 'OrderController@orderAll')->name('order-all');
	Route::get('order-user', 'OrderController@orderUser')->name('order-user');
	Route::post('order/{order}', 'OrderController@show')->name('order-show');
	Route::get('order/state', 'OrderController@state')->name('order-change-state');



	/*RUTAS DEL MENU*/
    Route::get('menu', 'MenuController@index')->name('menu-index');
    Route::get('menu/create', 'MenuController@create')->name('menu-create');
    Route::post('menu/store', 'MenuController@store')->name('menu-store');
    Route::get('menu/{menu_id}/edit', 'MenuController@edit')->name('menu-edit');
    Route::put('menu/{menu_id}', 'MenuController@update')->name('menu-update');
    Route::get('menu/{menu_id}/delete', 'MenuController@delete')->name('menu-delete');
    Route::post('menu/menu-save-order', 'MenuController@saveOrder')->name('menu-save-order');

    /*RUTAS MENU_ROL*/
    Route::get('menu-rol', 'MenuRolController@index')->name('menu-rol-index');
    Route::post('menu-rol', 'MenuRolController@store')->name('menu-rol-store');

    // RUTAS PERMISSION
   	Route::get('permission/', 'PermissionController@index')->name('permission-index');
	Route::get('permission/create', 'PermissionController@create')->name('permission-create');
	Route::post('permission/store', 'PermissionController@store')->name('permission-store');
	Route::get('permission/{permission_id}/edit', 'PermissionController@edit')->name('permission-edit');
	Route::put('permission/{permission_id}', 'PermissionController@update')->name('permission-update');
	Route::post('permission/', 'PermissionController@show')->name('permission-show');
	Route::get('permission/{permission_id}/destroy', 'PermissionController@destroy')->name('permission-destroy');

	/*RUTAS PERMISSION_ROL*/
    Route::get('permission-rol', 'PermissionRolController@index')->name('permission-rol-index');
    Route::post('permission-rol', 'PermissionRolController@store')->name('permission-rol-store');

    Route::get('notification-read/{notification_id}', 'NotificationController@read')->name('notification-read');
    Route::get('notification-push', 'NotificationController@push')->name('notification-push');


    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::put('profile/{profile_id}', 'ProfileController@update')->name('profile-update');
	Route::put('profile/image/edit/{profile_image}', 'ProfileController@updateImage')->name('profile-image-update');
	Route::put('profile/change-password/{profile_id}', 'ProfileController@changePassword')->name('change-password');


});