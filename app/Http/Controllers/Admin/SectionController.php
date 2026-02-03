<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::get();

        return view('admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = Classes::where(['status' => 'Active'])->orderBy('position', 'ASC')->get();
        return view('admin.section.create',compact('class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required',
        ]);

        $section = new Section();
        $section->class_id     = $request->class_id;
        $section->section_name = $request->section_name;
        $section->position     = $request->position;
        $section->status       = $request->status;
        $section->save();

        return redirect()->route('admin.section.index')->with('success', 'New Section Added Success!');
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
        $edit_data = Section::findOrFail($id);
        $class = Classes::where(['status' => 'Active'])->orderBy('position', 'ASC')->get();
        return view('admin.section.edit', compact('edit_data','class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required',
        ]);

        $section = Section::findOrFail($id);
        $section->class_id     = $request->class_id;
        $section->section_name = $request->section_name;
        $section->position     = $request->position;
        $section->status       = $request->status;
        $section->save();

        return redirect()->route('admin.section.index')->with('success', 'Section Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('admin.section.index')->with('delete', 'Section Deleted!');
    }
}
