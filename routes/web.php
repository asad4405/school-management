<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/result',[FrontendController::class,'result'])->name('result');
Route::post('/result/store',[FrontendController::class,'result_store'])->name('result.store');
// Route::get('/result/show',[FrontendController::class,'result_show'])->name('result.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
