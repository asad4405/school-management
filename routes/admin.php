<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth','prefix' => '/admin'], function () {
    // admin dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
});
