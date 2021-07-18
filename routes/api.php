<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);




Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::resource('user/advertises', App\Http\Controllers\Api\User\AdvertiseController::class);

    // upload photo routes
    Route::post('user/advertises/images', [App\Http\Controllers\Api\User\AdvertiseImageController::class, 'upload'])->name('user.advertise.image.upload');

    Route::post('logout', [AuthController::class, 'logout']);
});


Route::get('advertises' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'index'])->name('advertise.index');
Route::get('advertises/{id}' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'show'])->name('advertise.show');


