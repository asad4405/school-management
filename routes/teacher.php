<?php

use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\ResultController;
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

        // teacher attendance
        Route::get('/attendance/class', [AttendanceController::class,'attendance_class'])->name('teacher.attendance.class');
        Route::get('/attendance/students/{class_id}', [AttendanceController::class,'attendance_students'])->name('teacher.attendance.students');
        Route::post('/attendance/store/update', [AttendanceController::class,'attendance_store_update'])->name('teacher.attendance.store.update');
        Route::resource('/attendance', AttendanceController::class)->names('teacher.attendance');

        // result
        Route::get('/result/class', [ResultController::class,'result_class'])->name('teacher.result.class');
        Route::get('/result/students/{class_id}', [ResultController::class,'result_students'])->name('teacher.result.students');
        Route::get('/result/exam-list/{student_id}', [ResultController::class,'result_exam_list'])->name('teacher.result.exam.list');
        Route::get('/result/entry/{student_id}', [ResultController::class,'result_entry'])->name('teacher.result.entry');
        Route::post('/result/entry/store/update/{student_id}', [ResultController::class,'result_entry_store_update'])->name('teacher.result.entry.store.update');
    });
});
