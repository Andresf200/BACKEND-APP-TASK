<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\ProfileUserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');

    Route::apiResource('/tasks',TasksController::class)->names('tasks');

    Route::apiResource('/checklist',CheckListController::class)->names('check_lists')->except('index');

    Route::get('/checklist/toggleCompleted/{id}',[CheckListController::class ,'toggleCompleted']);
});

Route::get('/login', [AuthController::class, 'store'])->name('login');
Route::post('/register', [ProfileUserController::class, 'store'])->name('register');

