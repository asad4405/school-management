<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentEntollment;
use Illuminate\Http\Request;

class StudentEntollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stuent_enrollments = StudentEntollment::latest()->get();
        return view('admin.student_enrollment.index', compact('stuent_enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        $class = Classes::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        $section = Section::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        return view('admin.student_enrollment.create', compact('students', 'class', 'section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'academic_year' => 'required',
        ]);

        if(StudentEntollment::where('student_id',$request->student_id)->where('class_id', $request->class_id)->exists()) {
            return redirect()->back()->with('error', 'Class Already Exists!');
        }

        $student_enrollment = new StudentEntollment();
        $student_enrollment->admin_id     = auth()->user()->id;
        $student_enrollment->student_id   = $request->student_id;
        $student_enrollment->class_id     = $request->class_id;
        $student_enrollment->section_id   = $request->section_id;
        $student_enrollment->academic_year= $request->academic_year;
        $student_enrollment->position     = $request->position;
        $student_enrollment->status       = $request->status;
        $student_enrollment->save();

        return redirect()->route('admin.student.enrollment.index')->with('success', 'New Student Enrollment Added Success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_data = StudentEntollment::findOrFail($id);
        $students = Student::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        $class = Classes::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        $section = Section::where(['status' =>'Active'])->orderBy('position', 'ASC')->get();
        return view('admin.student_enrollment.edit', compact('edit_data', 'students', 'class', 'section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'academic_year' => 'required',
        ]);

        if(StudentEntollment::where('student_id',$request->student_id)->where('class_id', $request->class_id)->exists()) {
            return redirect()->back()->with('error', 'Class Already Exists!');
        }

        $student_enrollment = StudentEntollment::findOrFail($id);
        $student_enrollment->admin_id     = auth()->user()->id;
        $student_enrollment->student_id   = $request->student_id;
        $student_enrollment->class_id     = $request->class_id;
        $student_enrollment->section_id   = $request->section_id;
        $student_enrollment->academic_year= $request->academic_year;
        $student_enrollment->position     = $request->position;
        $student_enrollment->status       = $request->status;
        $student_enrollment->save();

        return redirect()->route('admin.student.enrollment.index')->with('success', 'Student Enrollment Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_enrollment = StudentEntollment::findOrFail($id);
        $student_enrollment->delete();
        return redirect()->route('admin.student.enrollment.index')->with('delete', 'Student Enrollment Deleted!');
    }
}
