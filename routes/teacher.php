<?php

use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/teacher'], function () {
    // teacher login
    Route::get('/login', [HomeController::class, 'teacher_login'])->name('teacher.login');
    Route::post('/login/submit', [HomeController::class, 'teacher_login_submit'])->name('teacher.login.submit');

    Route::group(['middleware' => 'teacher'], function () {
        // teacher dashboard
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('teacher.dashboard');

        // teacher list
        Route::get('/list', [TeacherController::class, 'teacher_list'])->name('teacher.list');
        Route::get('/show/{id}', [TeacherController::class, 'teacher_show'])->name('teacher.show');

        // teacher assigned class subject list
        Route::get('/assigned-class-subjects', [TeacherController::class, 'assignedClassSubjects'])->name('teacher.assigned.class.subjects');
        Route::get('/assigned-class-subjects/show/{id}', [TeacherController::class, 'assignedClassSubjectsShow'])->name('teacher.assigned.class.subjects.show');
    });
});
