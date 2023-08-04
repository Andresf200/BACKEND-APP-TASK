<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');

});

Route::get('/login', [AuthController::class, 'store'])->name('login');

