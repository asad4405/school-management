<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentEntollmentsController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherAssignmentsController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin'], function () {
    // admin login
    Route::get('/login', [HomeController::class, 'admin_login'])->name('admin.login');
    Route::post('/login/submit', [HomeController::class, 'admin_login_submit'])->name('admin.login.submit');

    Route::group(['middleware' => 'admin'], function () {
        // admin dashboard
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

        // admin list
        Route::get('/list', [AdminController::class, 'admin_list'])->name('admin.list');

        // student list
        Route::resource('/student', StudentController::class)->names('admin.student');

        // teacher list
        Route::resource('/teacher', TeacherController::class)->names('admin.teacher');

        // class
        Route::resource('/class', ClassController::class)->names('admin.class');

        // section
        Route::resource('/section', SectionController::class)->names('admin.section');

        // subject
        Route::resource('/subject', SubjectController::class)->names('admin.subject');

        // class subject
        Route::resource('/class-subject', ClassSubjectController::class)->names('admin.class.subject');

        // teacher_assignments
        Route::resource('/teacher-assignments', TeacherAssignmentsController::class)->names('admin.teacher.assignments');
        Route::get('/get-class-subjects', [TeacherAssignmentsController::class, 'getSubjects'])->name('getClassSubjects');

        // student enrollment
        Route::resource('/student-enrollment', StudentEntollmentsController::class)->names('admin.student.enrollment');

        // student enrollment
        Route::resource('/exam', ExamController::class)->names('admin.exam');
    });
});
