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




Route::get('/', [App\Http\Controllers\FrontProductListController::class, 'index']);
Route::get('/product/{id}', [App\Http\Controllers\FrontProductListController::class, 'show']);

Route::get('/category/{name}', [App\Http\Controllers\FrontProductListController::class, 'allProduct']);
Route::get('/addToCart/{product}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('add.cart')->middleware('auth');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show');
Route::post('/products/{product}', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::post('/product/{product}', [App\Http\Controllers\CartController::class, 'removeCart'])->name('cart.remove');

Route::get('/checkout/{amount}', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/orders', [App\Http\Controllers\CartController::class, 'order'])->name('order')->middleware('auth');
Route::post('/charge', [App\Http\Controllers\CartController::class, 'charge'])->name('cart.charge');
//delivery Info 
Route::resource('/deliveryInfo', App\Http\Controllers\DeliveryInfoController::class);

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/verify',[App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::get('all/products', [App\Http\Controllers\FrontProductListController::class, 'moreProducts'])->name('more.product');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'isAdmin', 'is_user_verify_email']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
   
    // Route::get('/email/verify', function () {
    //     return view('auth.verify');
    // });
    // Route::get('/email/verify',[App\Http\Auth]);
    //To View Order

    //Category
    Route::post('/category/create', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::get('/category/index', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    //Brand 
    Route::resource('/brand', App\Http\Controllers\BrandController::class);
    //Product 
    Route::resource('/product', App\Http\Controllers\ProductController::class);
    //In Product to get Subcategory based on choosen Category
    Route::get('/subcategories/{id}', [App\Http\Controllers\ProductController::class, 'loadSubCategories']);
    //Status to get 
    Route::get('/orderstatus/{orderid}/{status}', [App\Http\Controllers\OrderController::class, 'loadStatus']);
    //Status Category 
    Route::get('/changedCategoryStatus', [App\Http\Controllers\CategoryController::class, 'behaviourOfStatus']);
    //Status Product 
    Route::get('/changedProductStatus', [App\Http\Controllers\ProductController::class, 'behaviourOfStatus']);
    //Users
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    //Orders
    Route::get('orders', [App\Http\Controllers\CartController::class, 'userorder']);
    Route::get('orders/{userid}/{orderid}', [App\Http\Controllers\CartController::class, 'viewUserOrder'])->name('user.order');
});