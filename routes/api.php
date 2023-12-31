<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\TaskFileController;
use App\Http\Controllers\UserTaskController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');

    Route::apiResource('/tasks',TasksController::class)->names('tasks');

    Route::apiResource('/checklist',CheckListController::class)->names('check_lists')->except('index');

    Route::get('/checklist/toggleCompleted/{id}',[CheckListController::class ,'toggleCompleted']);

    Route::apiResource('/taskfiles',TaskFileController::class)->only('store','destroy');

    Route::get('/usertask/{user}',[UserTaskController::class,'show']);

    Route::get('users', [UserController::class,'index']);
});

Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::post('/register', [ProfileUserController::class, 'store'])->name('register');

