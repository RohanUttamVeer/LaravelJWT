<?php

// 'middleware' => 'api',

use App\Http\Controllers\Emailcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyOtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    // 'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('send_otp', [Emailcontroller::class, 'send_otp']);
    Route::post('verify_otp', [VerifyOtpController::class, 'verify_otp']);
    Route::get('get_user', [UserController::class, 'get_user']);
    Route::get('get_all_users', [UserController::class, 'get_all_users']);
    Route::patch('update_user', [UserController::class, 'update_user']);
    Route::delete('delete_user', [UserController::class, 'delete_user']);
});