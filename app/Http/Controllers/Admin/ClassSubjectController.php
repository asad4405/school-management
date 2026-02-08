<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class_subjects = ClassSubject::get();
        return view('admin.class_subject.index', compact('class_subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = Classes::where('status','Active')->orderBy('position','ASC')->get();
        $subject = Subject::where('status','Active')->orderBy('position','ASC')->get();
        return view('admin.class_subject.create',compact('class','subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        if(ClassSubject::where('class_id', $request->class_id)->exists()) {
            return redirect()->back()->with('error', 'Class Already Exists!');
        }

        $class_subject = new ClassSubject();
        $class_subject->class_id   = $request->class_id;
        $class_subject->subject_id = json_encode($request->subject_id);
        $class_subject->position   = $request->position;
        $class_subject->status     = $request->status;
        $class_subject->save();

        return redirect()->route('admin.class.subject.index')->with('success', 'New Class Subject Added Success!');
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
        $edit_data = ClassSubject::findOrFail($id);
        $class = Classes::where('status','Active')->orderBy('position','ASC')->get();
        $subject = Subject::where('status','Active')->orderBy('position','ASC')->get();
        return view('admin.class_subject.edit', compact('edit_data', 'class', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $class_subject = ClassSubject::findOrFail($id);
        $class_subject->class_id   = $request->class_id;
        $class_subject->subject_id = json_encode($request->subject_id);
        $class_subject->position   = $request->position;
        $class_subject->status     = $request->status;
        $class_subject->save();

        return redirect()->route('admin.class.subject.index')->with('success', 'Class Subject Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = ClassSubject::findOrFail($id);
        $subject->delete();
        return redirect()->route('admin.class.subject.index')->with('delete', 'Class Subject Deleted!');
    }
}
