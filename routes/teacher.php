<?php

use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => '/teacher'], function () {
    // teacher dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('teacher.dashboard');
    // teacher assigned class subject list
    Route::get('/assigned-class-subjects', [TeacherController::class, 'assignedClassSubjects'])->name('teacher.assigned.class.subjects');
    Route::get('/assigned-class-subjects/show/{id}', [TeacherController::class, 'assignedClassSubjectsShow'])->name('teacher.assigned.class.subjects.show');
});
