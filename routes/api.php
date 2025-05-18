<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TopUpController;
use App\Http\Controllers\Api\WebHookController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::post('logout',[AuthController::class, 'logout']);
Route::post('webhooks',[WebHookController::class, 'update']);


//harus menyertakan bearer token
Route::group(['middleware' => 'jwt.verify'], function($router) {
    Route::post('top_ups', [TopUpController::class, 'store']);
    Route::resource('users', UserController::class);
    Route::resource('addresses', AddressController::class);
    Route::get('user/addresses', [AddressController::class, 'addressByUserSignIn']);
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::put('user/update', [UserController::class, 'update']);

});


// Route::middleware('jwt.verify')->get('test', function (Request $request) {
//     return 'success';
// });
