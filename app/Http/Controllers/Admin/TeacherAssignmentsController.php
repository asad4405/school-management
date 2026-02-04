<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class TeacherAssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_assignments = TeacherAssignment::orderBy('position', 'ASC')->get();
        return view('admin.teacher_assignments.index', compact('teacher_assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::where('status', 'Active')->with('teacher')->get();
        $class_subjects = ClassSubject::where('status', 'Active')->with('class')->orderBy('position', 'ASC')->get();
        $sections = Section::where('status', 'Active')->orderBy('position', 'ASC')->get();
        $subjects = Subject::where('status', 'Active')->orderBy('position', 'ASC')->get();
        return view('admin.teacher_assignments.create', compact('teachers', 'class_subjects', 'sections', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
        ]);

        $teacher_assignment = new TeacherAssignment();
        $teacher_assignment->admin_id   = auth()->user()->id;
        $teacher_assignment->teacher_id = $request->teacher_id;
        $teacher_assignment->class_id   = $request->class_id;
        $teacher_assignment->section_id = $request->section_id;
        $teacher_assignment->subject_id = json_encode($request->subject_id);
        $teacher_assignment->position   = $request->position;
        $teacher_assignment->status     = $request->status;
        $teacher_assignment->save();

        return redirect()->route('admin.teacher.assignments.index')->with('success', 'New Teacher Assignment Added Success!');
    }

    public function getSubjects(Request $request)
    {
        $classSubjects = ClassSubject::where('class_id', $request->class_id)->get();

        $subject_ids = [];
        foreach ($classSubjects as $cs) {
            $ids = json_decode($cs->subject_id);
            $subject_ids = array_merge($subject_ids, $ids); 
        }

        $subjects = Subject::whereIn('id', $subject_ids)->get();
        return response()->json($subjects);
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
        $teacher_assignment = TeacherAssignment::findOrFail($id);
        $teachers = Teacher::where('status', 'Active')->with('teacher')->get();
        $class_subjects = ClassSubject::where('status', 'Active')->with('class')->orderBy('position', 'ASC')->get();
        $sections = Section::where('status', 'Active')->orderBy('position', 'ASC')->get();
        $subjects = Subject::where('status', 'Active')->orderBy('position', 'ASC')->get();
        return view('admin.teacher_assignments.edit', compact('teacher_assignment', 'teachers', 'class_subjects', 'sections', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
        ]);

        $teacher_assignment = TeacherAssignment::findOrFail($id);
        $teacher_assignment->teacher_id   = $request->teacher_id;
        $teacher_assignment->class_id     = $request->class_id;
        $teacher_assignment->section_id   = $request->section_id;
        $teacher_assignment->subject_id   = json_encode($request->subject_id);
        $teacher_assignment->position     = $request->position;
        $teacher_assignment->status       = $request->status;
        $teacher_assignment->save();

        return redirect()->route('admin.teacher.assignments.index')->with('success', 'Teacher Assignment Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher_assignment = TeacherAssignment::findOrFail($id);
        $teacher_assignment->delete();
        return redirect()->route('admin.teacher.assignments.index')->with('delete', 'Teacher Assignment Deleted!');
    }
}
