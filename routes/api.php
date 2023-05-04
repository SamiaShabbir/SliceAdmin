<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColdDrinksController;
use App\Http\Controllers\Api\AddToCartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/clear-cache', [ProductController::class, 'clearCache']);
Route::get('/test', [ProductController::class, 'test']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    // your API routes here
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/auth-user', [AuthController::class, 'show']);
    Route::get('/update-profile', [UserController::class, 'logout']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::post('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::post('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
    Route::get('/product-by-category', [ProductController::class, 'getProductByCategory']);
    Route::get('/drinks', [ColdDrinksController::class, 'index']);
    Route::post('/drinks', [ColdDrinksController::class, 'store']);
    Route::get('/drinks/{id}', [ColdDrinksController::class, 'show']);
    Route::post('/drinks/{id}', [ColdDrinksController::class, 'update']);
    Route::delete('/drinks/{id} ', [ColdDrinksController::class, 'destroy']);
    Route::get('/add-to-cart', [AddToCartController::class, 'index']);
    Route::post('/add-to-cart', [AddToCartController::class, 'store']);
    Route::get('/add-to-cart/{id}', [AddToCartController::class, 'show']);
    Route::post('/add-to-cart/{id}', [AddToCartController::class, 'update']);
    Route::delete('/add-to-cart/{id} ', [AddToCartController::class, 'destroy']);
    Route::get('/sauce ', [SauceController::class, 'index']);
    Route::post('/sauce ', [SauceController::class, 'store']);
    Route::get('/sauce/{id} ', [SauceController::class, 'show']);
    Route::post('/sauce/{id}', [SauceController::class, 'update']);
    Route::delete('/sauce/{id} ', [SauceController::class, 'destroy']);
    Route::get('/topping ', [ToppingController::class, 'index']);
    Route::post('/topping ', [ToppingController::class, 'store']);
    Route::get('/topping/{id} ', [ToppingController::class, 'show']);
    Route::post('/topping/{id} ', [ToppingController::class, 'update']);
    Route::delete('/topping/{id} ', [ToppingController::class, 'destroy']);
    Route::get('/order ', [OrderController::class, 'index']);
    Route::get('order/{id} ', [OrderController::class, 'show']);
    Route::post('/order ', [ColdDrinksController::class, 'store']);
    Route::get('get-user-other ', [AuthController::class, 'getUserOther']);
    Route::get('app_getCart ', [AuthController::class, 'showCartForApp']);
    Route::get('search-order ', [OrderController::class, 'SearchByOrderNumber']);
    Route::get('send-to-kitchen ', [OrderController::class, 'sendToKitchen']);
    Route::post('get-orders ', [OrderController::class, 'getOrders']);
    Route::post('add-disc ', [OrderController::class, 'addDisc']);
    Route::post('view-disc ', [OrderController::class, 'viewDisc']);
    Route::get('get-order-details ', [DriverController::class, 'getAllOrder']);
    Route::post('add-banner ', [BannerController::class, 'addBanner']);
    Route::get('view-banner ', [BannerController::class, 'viewBanner']);
    Route::post('add-dipping ', [SauceController::class, 'addDipping']);
    Route::get('get-dipping', [SauceController::class, 'getDipping']);
    Route::post('add-sub-categories', [CategoryController::class, 'addSubCategory']);
    Route::post('get-sub-category', [CategoryController::class, 'getSubCategory']);
    Route::post('add-oven', [OrderController::class, 'addOven']);
    Route::post('remove-from-disk', [OrderController::class, 'removeFromDisk']);
    Route::get('completed-order', [OrderController::class, 'completedOrders']);
    Route::post('get-customer-by-number', [DriverController::class, 'GetorderDetail']);
    Route::post('get-order', [DriverController::class, 'GetOrder']);
    Route::post('delivery-ok', [DriverController::class, 'delivered_ok']);
    Route::post('delivery-not-ok', [DriverController::class, 'Delivery_not_ok']);
    Route::post('item-not-accepted', [DriverController::class, 'Item_not_Accepted']);
    Route::post('explain-question', [DriverController::class, 'explainQuestion']);
    Route::post('add-payment-details', [PaymentDetailsController::class, 'addPaymentDetails']);
    Route::post('add-coupon', [PaymentDetailsController::class, 'addCoupon']);
    Route::post('apply-coupon', [PaymentDetailsController::class, 'applyCoupon']);
    Route::post('send-code', [AuthController::class, 'sendCode']);
    Route::post('add-desert', [ColdDrinksController::class, 'addDesert']);
    Route::get('get-all-orders', [OrderController::class, 'getAllOrders']);
    Route::get('delete-cart', [AddToCartController::class, 'deleteCart']);
    Route::get('delete-cart-by-id', [AddToCartController::class, 'deleteCartById']);
    // });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
