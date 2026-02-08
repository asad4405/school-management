<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::orderByRaw('position IS NULL, position ASC')->get();
        return view('admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'notice_for' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $notice = new Notice();
        $notice->admin_id    = auth()->user()->id;
        $notice->title       = $request->title;
        $notice->description = $request->description;
        $notice->notice_for  = $request->notice_for;
        if ($request->file('file')) {
            $file = $request->file('file');

            $imageName       = microtime('.') . '.' . $file->getClientOriginalExtension();
            $imagePath       = 'public/admin/uploads/notice/';
            $file->move($imagePath, $imageName);

            $notice->file   = $imagePath . $imageName;
        }
        $notice->position   = $request->position;
        $notice->status     = $request->status;
        $notice->save();

        return redirect()->route('admin.notice.index')->with('success', 'New Notice Added Success!');
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
        $edit_data = Notice::findOrFail($id);
        $file_ext = pathinfo($edit_data->file, PATHINFO_EXTENSION);
        return view('admin.notice.edit', compact('edit_data', 'file_ext'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'notice_for' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $notice = Notice::findOrFail($id);
        $notice->title       = $request->title;
        $notice->description = $request->description;
        $notice->notice_for  = $request->notice_for;
        if ($request->file('file')) {
            $file = $request->file('file');

            if (!is_null($notice->file) && file_exists($notice->file)) {
                unlink($notice->file);
            }

            $imageName       = microtime('.') . '.' . $file->getClientOriginalExtension();
            $imagePath       = 'public/admin/uploads/notice/';
            $file->move($imagePath, $imageName);

            $notice->file    = $imagePath . $imageName;
        }
        $notice->position    = $request->position;
        $notice->status      = $request->status;
        $notice->save();

        return redirect()->route('admin.notice.index')->with('success', 'Notice Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notice = Notice::findOrFail($id);
        if (!is_null($notice->file) && file_exists($notice->file)) {
            unlink($notice->file);
        }
        $notice->delete();
        return redirect()->route('admin.notice.index')->with('delete', 'Notice Deleted!');
    }
}
