<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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


Route::get('/login', function () {
    //
})->middleware('guest:user');

Route::get('/register', function () {
    //
})->middleware('guest:user');


Route::get('/', [App\Http\Controllers\FrontProductListController::class, 'index']);
Route::get('/product/{id}', [App\Http\Controllers\FrontProductListController::class, 'show']);

Route::get('/category/{name}', [App\Http\Controllers\FrontProductListController::class, 'allProduct']);
Route::get('/productCategory/{id}', [App\Http\Controllers\FrontProductListController::class, 'allProductByCategory'])->name('productCategory');

Route::post('/login-user', [App\Http\Controllers\HomeController::class, 'userLogin'])->name('login-user');
Route::post('/register-user', [App\Http\Controllers\HomeController::class, 'userRegister'])->name('register-user');

Route::get('/productBrand/{id}', [App\Http\Controllers\FrontProductListController::class, 'allProductByBrand'])->name('productBrand');
Route::get('/productDetail/{id}', [App\Http\Controllers\FrontProductListController::class, 'productDetail'])->name('productDetail');
Route::get('/search', [App\Http\Controllers\FrontProductListController::class, 'search'])->name('search');

Route::post('/addToCart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('add.cart')->middleware('auth');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/products/{product}', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::post('/product/{product}', [App\Http\Controllers\CartController::class, 'removeCart'])->name('cart.remove');

Route::get('/checkout/{username}', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/orders', [App\Http\Controllers\CartController::class, 'order'])->name('order')->middleware('auth');
Route::get('/orders/{id}', [App\Http\Controllers\CartController::class, 'orderDetail'])->name('order.detail')->middleware('auth');

Route::post('/charge', [App\Http\Controllers\CartController::class, 'charge'])->name('cart.charge');
Route::post('/complete-checkout', [App\Http\Controllers\CartController::class, 'finalCheckout'])->name('cart.final-checkout')->middleware('auth');
//delivery Info 
Route::resource('/deliveryInfo', App\Http\Controllers\DeliveryInfoController::class);

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/verify', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::get('all/products', [App\Http\Controllers\FrontProductListController::class, 'moreProducts'])->name('more.product');
Route::get('/home', [App\Http\Controllers\FrontProductListController::class, 'index'])->name('home');
Route::get('/userAccountInfo', [App\Http\Controllers\UserController::class, 'userAccountInfo'])->name('user.accountInfo');
Route::get('/changePassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.changePassword');
Route::post('/changePassword', [App\Http\Controllers\UserController::class, 'changePasswordPost'])->name('user.changePasswordPost');

Route::get('/changeAccountInfo', [App\Http\Controllers\UserController::class, 'changeAccountInfo'])->name('user.changeAccountInfo');
Route::post('/changeAccountInfo', [App\Http\Controllers\UserController::class, 'changeAccountInfoPost'])->name('user.changeAccountInfoPost');

Route::get('/userAccountInfo', [App\Http\Controllers\UserController::class, 'userAccountInfo'])->name('user.accountInfo');


Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });


    Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::get('/category/index', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    //Brand 
    Route::resource('/brand', App\Http\Controllers\BrandController::class);

    Route::resource('/slider', App\Http\Controllers\SliderController::class);

    Route::get('/vendor', [App\Http\Controllers\UserController::class, 'vendorList']);

    Route::get('/vendor/new', [App\Http\Controllers\UserController::class, 'vendorNew']);
    //Product 
    Route::resource('/product', App\Http\Controllers\ProductController::class);
    //In Product to get Subcategory based on choosen Category
    Route::get('/subcategories/{id}', [App\Http\Controllers\ProductController::class, 'loadSubCategories']);
    //Status to get 
    Route::get('/orderstatus/{orderid}/{status}', [App\Http\Controllers\OrderController::class, 'loadStatus']);
    //Status Category 
    Route::get('/changedCategoryStatus', [App\Http\Controllers\CategoryController::class, 'behaviourOfStatus']);
    //Toggle IsSpecial
    Route::get('/changeSpecialTag', [App\Http\Controllers\CategoryController::class, 'toggleSpeicalTag']);

    //Status Product 
    Route::get('/changedProductStatus', [App\Http\Controllers\ProductController::class, 'behaviourOfStatus']);
    //Users
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    //Orders
    Route::get('orders', [App\Http\Controllers\CartController::class, 'userorder'])->name('user.orders');
    Route::get('orders/{orderid}', [App\Http\Controllers\OrderController::class, 'show'])->name('user.order');
    // Brand Status
    Route::get('/changedBrandStatus', [App\Http\Controllers\BrandController::class, 'behaviourOfStatusBrand']);
    // Payemnt Status
    Route::get('/paymentstatus/{orderidforpayment}/{statuspayment}', [App\Http\Controllers\OrderController::class, 'behaviourOfPaymentStatus']);
});