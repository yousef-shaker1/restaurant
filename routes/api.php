<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\OfferController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\BasketController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\SectionController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\OrderOfferController;
use App\Http\Controllers\api\BasketoffersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']] , function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});


Route::group(['middleware' => ['user.token']] , function(){
Route::get('/product',[ProductController::class, 'index']);
Route::get('/product/{id}',[ProductController::class, 'show_one']);
Route::post('/product/create',[ProductController::class, 'store']);
Route::post('/product/edit/{id}',[ProductController::class, 'edit']);
Route::delete('/product/{id}',[ProductController::class, 'delete']);


Route::get('/section',[SectionController::class, 'index']);
Route::get('/section/{id}',[SectionController::class, 'show']);
Route::post('/section/create',[SectionController::class, 'store']);
Route::post('/section/edit/{id}',[SectionController::class, 'edit']);
Route::delete('/section/{id}',[SectionController::class, 'delete']);

Route::get('/customer',[CustomerController::class, 'index']);
Route::get('/customer/{id}',[CustomerController::class, 'show']);
Route::post('/customer/create',[CustomerController::class, 'store']);
Route::post('/customer/edit/{id}',[CustomerController::class, 'edit']);
Route::delete('/customer/{id}',[CustomerController::class, 'delete']);    

Route::get('/offer',[OfferController::class, 'index']);
Route::get('/offer/{id}',[OfferController::class, 'show']);
Route::post('/offer/create',[OfferController::class, 'store']);
Route::post('/offer/edit/{id}',[OfferController::class, 'edit']);
Route::delete('/offer/{id}',[OfferController::class, 'delete']);  


Route::get('/basket',[BasketController::class, 'index']);
Route::get('/basket/show/{id}',[BasketController::class, 'show']);

Route::get('/basketoffers',[BasketoffersController::class, 'index']);
Route::get('/basketoffers/show/{id}',[BasketoffersController::class, 'show']);

Route::get('/order',[OrderController::class, 'index']);
Route::get('/order/show/{id}',[OrderController::class, 'show']);
Route::put('/order/success/{id}',[OrderController::class, 'success']);
Route::put('/order/rejection/{id}',[OrderController::class, 'rejection']);
Route::put('/order/completed/{id}',[OrderController::class, 'completed']);
Route::delete('/order/{id}',[OrderController::class, 'delete']);

Route::get('/orderoffer',[OrderOfferController::class, 'index']);
Route::get('/orderoffer/show/{id}',[OrderOfferController::class, 'show']);
Route::put('/orderoffer/success/{id}',[OrderOfferController::class, 'success']);
Route::put('/orderoffer/rejection/{id}',[OrderOfferController::class, 'rejection']);
Route::put('/orderoffer/completed/{id}',[OrderOfferController::class, 'completed']);
Route::delete('/orderoffer/{id}',[OrderOfferController::class, 'delete']);

});