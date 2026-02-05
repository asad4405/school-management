<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacher_list()
    {
        $teachers = Teacher::where('status', 'Active')->with('teacher')->get();
        return view('teacher.teacher.list', compact('teachers'));
    }

    public function teacher_show($id)
    {
        $teacher = Teacher::where('id', $id)->with('teacher')->first();
        return view('teacher.teacher.show', compact('teacher'));
    }
    public function assignedClassSubjects()
    {
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        $assignedClassSubjects = TeacherAssignment::where('teacher_id', $teacher->id)->get();
        return view('teacher.assigned_class_subject.assigned_class_subjects', compact('assignedClassSubjects'));
    }
}
