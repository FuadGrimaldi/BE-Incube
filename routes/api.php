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
use App\Http\Controllers\Api\SensorController;


Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::post('refresh',[AuthController::class, 'refresh']);
Route::post('logout',[AuthController::class, 'logout']);
Route::post('webhooks',[WebHookController::class, 'update']);
Route::post('store-data', [DataProdukController::class, 'storeDataFromESP32']);
Route::get('get-data', [DataProdukController::class, 'getDataFromESP32']);


Route::get('device-setting/{device_id}', [SensorController::class, 'getDeviceSetting']);
Route::put('update-threshold/{device_id}', [SensorController::class, 'updateThreshold']);
Route::put('update-fan-status/{device_id}', [SensorController::class, 'updateFanStatus']);
Route::put('update-lampu-status/{device_id}', [SensorController::class, 'updateLampuStatus']);

Route::post('users/{id}', [UserController::class, 'createUser']);


//harus menyertakan bearer token
Route::group(['middleware' => 'jwt.verify'], function($router) {
    Route::post('top_ups', [TopUpController::class, 'store']);
    Route::resource('users', UserController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('data-products', DataProdukController::class);
    Route::resource('user-subscriptions', UserSubController::class);
    Route::put('user/update-status-produk', [ProdukController::class, 'activateProduk']);
    Route::get('user/data-produk/{id}', [DataProdukController::class, 'dataProdukByIdProduk']);
    Route::get('user/user-subscriptions', [UserSubController::class, 'showUserSubByIdLogin']);
    Route::get('user/addresses', [AddressController::class, 'addressByUserSignIn']);
    Route::put('user/update-addresses', [AddressController::class, 'updateAddress']);
    Route::post('user/store-addresses', [AddressController::class, 'storeAddressByUserLogin']);
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::put('user/update-profile', [UserController::class, 'updateProfile']);

});


// Route::middleware('jwt.verify')->get('test', function (Request $request) {
//     return 'success';
// });
