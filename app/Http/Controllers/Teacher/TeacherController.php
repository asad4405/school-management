<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function assignedClassSubjects()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $assignedClassSubjects = TeacherAssignment::where('teacher_id', $teacher->id)->get();
        return view('teacher.assigned_class_subjects', compact('assignedClassSubjects'));
    }
}
