<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_teacher = User::where(['status' => 'Active', 'role' => 'teacher'])->get();
        return view('admin.teacher.index', compact('user_teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // users table insert
            $user_teacher = new User();
            $user_teacher->name    = $request->name;
            $user_teacher->email   = $request->email;
            $user_teacher->phone   = $request->phone;
            $user_teacher->password = bcrypt($request->phone);
            $user_teacher->role    = 'teacher';
            $user_teacher->status  = $request->status;
            $user_teacher->save();

            // teachers table insert
            $teacher = new Teacher();
            $teacher->user_id      = $user_teacher->id;
            $teacher->teacher_code = 'TC' . str_pad($user_teacher->id, 4, '0', STR_PAD_LEFT);
            $teacher->designation  = $request->designation;
            $teacher->join_date    = $request->join_date;
            $teacher->status       = $request->status;
            $teacher->save();

            DB::commit();
            return redirect()->route('admin.teacher.index')->with('success', 'New Teacher Added Success!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
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
        $edit_user_teacher = User::findOrFail($id);
        $edit_teacher = Teacher::where('user_id', $id)->first();
        return view('admin.teacher.edit', compact('edit_user_teacher', 'edit_teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_teacher = User::findOrFail($id);
        $teacher = Teacher::where('user_id', $user_teacher->id)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_teacher->id,
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // users table update
            $user_teacher->name    = $request->name;
            $user_teacher->email   = $request->email;
            $user_teacher->phone   = $request->phone;
            $user_teacher->status  = $request->status;
            $user_teacher->save();

            // teachers table update
            $teacher->designation  = $request->designation;
            $teacher->join_date    = $request->join_date;
            $teacher->status       = $request->status;
            $teacher->save();

            DB::commit();
            return redirect()->route('admin.teacher.index')->with('success', 'Teacher Updated Success!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $user_teacher = User::findOrFail($id);
            $teacher = Teacher::where('user_id', $user_teacher->id)->first();

            if ($teacher) {
                $teacher->delete();
            }
            $user_teacher->delete();
            DB::commit();
            return redirect()->route('admin.teacher.index')->with('delete', 'Teacher Deleted Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Delete failed! ' . $e->getMessage());
        }
    }
}
