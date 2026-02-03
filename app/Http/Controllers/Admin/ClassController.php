<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::get();
        return view('admin.class.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required'
        ]);

        $class = new Classes();
        $class->class_name = $request->class_name;
        $class->position   = $request->position;
        $class->status     = $request->status;
        $class->save();
        return redirect()->route('admin.class.index')->with('success','New Class Added Success!');
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
        $edit_data = Classes::find($id);
        return view('admin.class.edit',compact('edit_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_name' => 'required'
        ]);

        $class = Classes::find($id);
        $class->class_name = $request->class_name;
        $class->position   = $request->position;
        $class->status     = $request->status;
        $class->update();
        return redirect()->route('admin.class.index')->with('success','Class Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = Classes::find($id);
        $class->delete();
        return redirect()->route('admin.class.index')->with('delete','Class Deleted!');
    }
}
