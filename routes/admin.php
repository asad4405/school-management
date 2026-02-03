<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth','prefix' => '/admin'], function () {
    // admin dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    // admin list
    Route::get('/list',[AdminController::class,'admin_list'])->name('admin.list');
});
