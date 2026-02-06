<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::orderBy('position','ASC')->get();
        return view('admin.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => 'required',
            'exam_year' => 'required',
        ]);

        $exam = new Exam();
        $exam->admin_id      = auth()->user()->id;
        $exam->exam_name     = $request->exam_name;
        $exam->exam_year     = $request->exam_year;
        $exam->position      = $request->position;
        $exam->position_date = $request->position_date;
        $exam->status        = $request->status;
        $exam->save();

        return redirect()->route('admin.exam.index')->with('success', 'New Subject Added Success!');
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
        $edit_data = Exam::findOrFail($id);
        return view('admin.exam.edit', compact('edit_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'exam_name' => 'required',
            'exam_year' => 'required',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->exam_name       = $request->exam_name;
        $exam->exam_year       = $request->exam_year;
        $exam->position        = $request->position;
        $exam->position_date   = $request->position_date;
        $exam->status          = $request->status;
        $exam->save();

        return redirect()->route('admin.exam.index')->with('success', 'Exam Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('admin.exam.index')->with('delete', 'Exam Deleted!');
    }
}
