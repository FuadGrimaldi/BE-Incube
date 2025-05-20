<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TopUpController;
use App\Http\Controllers\Api\WebHookController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\UserSubController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\DataProdukController;


Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::post('logout',[AuthController::class, 'logout']);
Route::post('webhooks',[WebHookController::class, 'update']);
Route::get('store-data', [DataProdukController::class, 'storeDataFromESP32']);


//harus menyertakan bearer token
Route::group(['middleware' => 'jwt.verify'], function($router) {
    Route::post('top_ups', [TopUpController::class, 'store']);
    Route::resource('users', UserController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('data-products', DataProdukController::class);
    Route::resource('user-subscriptions', UserSubController::class);
    Route::get('user/data-produk/{id}', [DataProdukController::class, 'dataProdukByIdProduk']);
    Route::get('user/user-subscriptions', [UserSubController::class, 'showUserSubByIdLogin']);
    Route::get('user/addresses', [AddressController::class, 'addressByUserSignIn']);
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::put('user/update', [UserController::class, 'update']);

});


// Route::middleware('jwt.verify')->get('test', function (Request $request) {
//     return 'success';
// });
