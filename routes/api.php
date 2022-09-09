<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Orders\PaymentController;
use App\Http\Controllers\Api\Buy\BuySponsorController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('buy','Api\Buy\BuySponsorController@index' );
Route::get('orders/generate','Api\Orders\PaymentController@tokenGenerate' )->name('tokenGenerate');
Route::post('orders/make/payment','Api\Orders\PaymentController@makePayment')->name('makePayment');
