<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exampublish;
use Illuminate\Http\Request;

class ExamPublishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam_publishs = Exampublish::get();

        return view('admin.exam_publish.index', compact('exam_publishs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::latest()->get();
        return view('admin.exam_publish.create', compact('exams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required',
            'exam_year' => 'required',
        ]);

        $exam_publish = new Exampublish();
        $exam_publish->admin_id  = auth()->user()->id;
        $exam_publish->exam_id   = $request->exam_id;
        $exam_publish->exam_year = $request->exam_year;
        $exam_publish->publish_date = $request->publish_date;
        $exam_publish->status    = $request->status;
        $exam_publish->position  = $request->position;
        $exam_publish->save();

        return redirect()->route('admin.exampublish.index')->with('success', 'New Exam Publish Added Success!');
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
        $edit_data = Exampublish::findOrFail($id);
        $exams = Exam::latest()->get();
        return view('admin.exam_publish.edit', compact('edit_data', 'exams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'exam_id' => 'required',
            'exam_year' => 'required',
        ]);

        $exam_publish = Exampublish::findOrFail($id);
        $exam_publish->admin_id  = auth()->user()->id;
        $exam_publish->exam_id   = $request->exam_id;
        $exam_publish->exam_year = $request->exam_year;
        $exam_publish->publish_date = $request->publish_date;
        $exam_publish->status    = $request->status;
        $exam_publish->position  = $request->position;
        $exam_publish->save();

        return redirect()->route('admin.exampublish.index')->with('success', 'Exam Publish Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam_publish = Exampublish::findOrFail($id);
        $exam_publish->delete();
        return redirect()->route('admin.exampublish.index')->with('delete', 'Exam Publish Deleted!');
    }
}
