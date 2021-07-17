<?php

use App\Http\Controllers\Api\AdvertiseController;
use App\Http\Controllers\Api\AuthController;

use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);




Route::group([
    'middleware' => 'auth:sanctum',
], function () {
   Route::get('/all', function () {
      return 'all';
   });


    Route::resource('advertises', AdvertiseController::class);




    Route::post('logout', [AuthController::class, 'logout']);
});
