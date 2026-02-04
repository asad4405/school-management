<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth','prefix' => '/admin'], function () {
    // admin dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    // admin list
    Route::get('/list',[AdminController::class,'admin_list'])->name('admin.list');

    // class
    Route::resource('/class',ClassController::class)->names('admin.class');

    // section
    Route::resource('/section',SectionController::class)->names('admin.section');

    // subject
    Route::resource('/subject',SubjectController::class)->names('admin.subject');

    // class subject
    Route::resource('/class-subject',ClassSubjectController::class)->names('admin.class.subject');
});
