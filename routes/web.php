<?php

use App\Http\Controllers\Offers\OfferController;
use App\Http\Controllers\PaymentProviderController;
use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',10);
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('comment', [App\Http\Controllers\HomeController::class, 'SaveComment'])->name('comment.save');




################Begin paymentGateways Routes ########################

Route::group(['prefix' => 'offers', 'middleware' => 'auth','namespace' =>'Offers'], function () {
    Route::get('/', [OfferController::class, 'index'])->name('offers.all');
    Route::get('details/{offer_id}', [OfferController::class, 'show'])->name('offers.show');
});

Route::get('get-checkout-id', [PaymentProviderController::class, 'getCheckOutId'])->name('offers.checkout');

################End paymentGateways Routes ########################


