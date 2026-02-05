<?php

use App\Http\Controllers\Teacher\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => '/teacher'], function () {
    // teacher dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('teacher.dashboard');
});
