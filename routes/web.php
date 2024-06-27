<?php

use App\Models\offer;
use App\Models\prodect;
use App\Models\section;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProdectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserpageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserpageController::class, 'index'])->name('homee');

Route::get('/login_customer',[CustomerController::class, 'login'])->name('login_customer');
Route::get('/register_customer',[CustomerController::class, 'register'])->name('register_customer');

Route::resource('/home', UserpageController::class);
Route::get('/about', [UserpageController::class, 'about'])->name('home.about');
Route::get('/Previousrequests', [UserpageController::class, 'Previousrequests'])->name('Previous.requests')->middleware(['auth']);
//authntcation 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//resource page
Route::resource('customer', CustomerController::class);
Route::resource('section', SectionController::class);
Route::resource('prodect', ProdectController::class);
Route::resource('order', OrderController::class);
Route::resource('offer', OfferController::class);


Route::controller(OfferController::class)->group(function(){
    Route::get('showuser', 'showuser')->name('showuseroffer');
    Route::get('offer/basket/{id}', 'Basket')->name('Basketoffer');
    //admin route
    Route::get('sendoffer/{id}', 'sendoffer')->name('sendoffer');
    Route::get('offer/sucess/{id}', 'status1')->name('offer.status1');
    Route::get('offer/rejected/{id}', 'status2')->name('offer.status2');
    Route::get('offer/accept/{id}', 'status3')->name('offer.status3');
    Route::delete('offer/del/{id}', 'del')->name('offer.del');
});


Route::controller(OrderController::class)->group(function(){
    Route::get('/Basketall', 'Basketall')->name('Basketall')->middleware(['auth']);
    Route::get('/delbascet/{id}', 'delbascet')->name('delbascet');
    Route::get('/delbascetprodect/{id}', 'delbascetprodect')->name('delbascetprodect');
    Route::get('/sendorder/{id}', 'sendorder')->name('sendorder');
    Route::post('/okorder/{id}', 'okorder')->name('okorder');
    Route::post('/okorderoffer', 'okorderoffer')->name('okorderoffer');
    //admin route
    Route::get('order/sucess/{id}', 'status1')->name('order.status1');
    Route::get('order/del/{id}', 'status2')->name('order.status2');
    Route::get('order/accept/{id}', 'status3')->name('order.status3');
    Route::get('order/basket/{id}', 'Basket')->name('Basket');
    Route::get('acceptedshow', 'acceptedshow')->name('order.acceptedshow');
    Route::get('Orderrejected', 'Orderrejected')->name('order.Orderrejected');
    Route::get('Ordercompleted', 'Ordercompleted')->name('order.Ordercompleted');
});

require __DIR__.'/auth.php';
//permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('getstripe', [StripeController::class, 'getstripe'])->name('getstripe');
Route::post('poststripe', [StripeController::class, 'poststripe'])->name('poststripe');
Route::get('success', [StripeController::class, 'successtransaction'])->name('success');
Route::get('cancel', [StripeController::class, 'canceltransaction'])->name('cancel');

Route::get('successoffer', [OrderController::class, 'successoffer'])->name('successoffer');
Route::get('canceloffer', [OrderController::class, 'canceloffer'])->name('canceloffer');


Route::get('/dashboard', [UserpageController::class, 'dashboard'])->middleware(['auth', 'verified','IsAdmin'])->name('admin.dashboard');
