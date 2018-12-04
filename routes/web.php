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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkPassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    // Categories Routes (Admin)
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');

    // Products Routes
    Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
    Route::get('/admin/view-products', 'ProductsController@viewProducts');
    Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}', 'ProductsController@deleteProductImage');
    Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deleteAltImage');

    // Products Attributes Routes
    Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductsController@addAttributes');
    Route::match(['get', 'post'], '/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
    Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductsController@addImages');
    Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');

    // Coupon Routes
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@addCoupon');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@editCoupon');
    Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}', 'CouponsController@deleteCoupon');

    // Banner Routes
    Route::match(['get', 'post'], '/admin/add-banner', 'BannersController@addBanner');
    Route::match(['get', 'post'], '/admin/edit-banner/{id}', 'BannersController@editBanner');
    Route::get('/admin/view-banners', 'BannersController@viewBanners');
    Route::get('/admin/delete-banner/{id}', 'BannersController@deleteBanner');
});

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Route::get('/logout', 'AdminController@logout');

// Home Page
Route::get('/', 'IndexController@index');

// Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

// Product Detail Page
Route::get('/product/{id}', 'ProductsController@product');

// Get Product Attribute Price
Route::get('/get-product-price', 'ProductsController@getProductPrice');

// Add to Cart Route
Route::match(['get', 'post'], 'add-cart', 'ProductsController@addtocart');

// Cart Page
Route::match(['get', 'post'], 'cart', 'ProductsController@cart');

// Delete Product from Cart Page
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');

// Update Product Quantity in Cart
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');

// Apply Coupon
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

// Users Login/Register Page
Route::get('/login-register', 'UsersController@userLoginRegister');

// Users Register Form Submit
Route::post('/user-register', 'UsersController@register');

// Users Login Form Submit
Route::post('/user-login', 'UsersController@login');

// Users logout
Route::get('/user-logout', 'UsersController@logout');

// Check if User already exists
Route::match(['get', 'post'], '/check-email','UsersController@checkEmail');

// All Routes after Login
Route::group(['middleware' => ['frontLogin']], function() {
    // Users Account Page
    Route::match(['get', 'post'], 'account', 'UsersController@account');
    // Check User Current Password
    Route::post('/check-user-pwd', 'UsersController@chkUserPassword');
    // Update User Password
    Route::post('/update-user-pwd', 'UsersController@updatePassword');
});