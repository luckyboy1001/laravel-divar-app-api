<?php


use App\Http\Controllers\Api\Auth\AuthController;


use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);




Route::group([
    'middleware' => 'auth:sanctum',
], function () {
   Route::get('/all', function () {
      return 'all';
   });
    Route::resource('user/advertises', App\Http\Controllers\Api\User\AdvertiseController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});


Route::get('advertises' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'index'])->name('advertise.index');
Route::get('advertises/{id}' , [App\Http\Controllers\Api\Main\AdvertiseController::class, 'show'])->name('advertise.show');


