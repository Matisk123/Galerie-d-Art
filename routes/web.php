<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','role:super_admin'])->group(function(){
    Route::get('/super-admin', [SuperAdminController::class,'dashboard']);
    Route::get('/super-admin/admin-requests', [SuperAdminController::class,'listRequests']);
    Route::post('/super-admin/admin-requests/{id}/accept', [SuperAdminController::class,'acceptRequest']);
    Route::post('/super-admin/admin-requests/{id}/refuse', [SuperAdminController::class,'refuseRequest']);
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class,'dashboard']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/menu', [MenuController::class,'index']);
});
