<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\AuthController;
use App\Http\Controllers\Ajax\UserController;
use App\Http\Controllers\Ajax\LogController;

// صفحات الواجهة
Route::view('/', 'login')->name('login');
Route::view('/users', 'users')->middleware('auth');
Route::view('/logs',  'logs' )->middleware('auth');

// نقاط الأجاكس
Route::post('/ajax/login',  [AuthController::class,'login'])->name('ajax.login');
Route::post('/ajax/logout', [AuthController::class,'logout'])->name('ajax.logout');

Route::middleware('auth')->group(function () {
    Route::get('/ajax/users',            [UserController::class,'index']);
    Route::post('/ajax/users',           [UserController::class,'store']);
    Route::put('/ajax/users/{user}',     [UserController::class,'update']);
    Route::delete('/ajax/users/{user}',  [UserController::class,'destroy']);

    Route::get('/ajax/logs',             [LogController::class,'index']);
});
