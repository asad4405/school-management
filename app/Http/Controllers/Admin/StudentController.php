<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_student = User::where([ 'role' => 'student'])->get();
        return view('admin.student.index', compact('user_student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.student.create');
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
            $user_student = new User();
            $user_student->name    = $request->name;
            $user_student->email   = $request->email;
            $user_student->phone   = $request->phone;
            $user_student->password = bcrypt($request->phone);
            $user_student->role    = 'student';
            $user_student->status  = $request->status;
            $user_student->save();

            // students table insert

            $lastStudent = Student::orderBy('id', 'desc')->lockForUpdate()->first();
            // Roll No (6 digit)
            $nextRoll = $lastStudent ? ((int)$lastStudent->roll_no + 1) : 210221;
            // Reg No (10 digit)
            $nextReg  = $lastStudent ? ((int)$lastStudent->reg_no + 1) : 2123125029;

            $student = new Student();
            $student->admin_id    = auth()->user()->id;
            $student->user_id     = $user_student->id;
            $student->student_id  = 'ST' . str_pad($user_student->id, 4, '0', STR_PAD_LEFT);
            $student->roll_no     = (string) $nextRoll;
            $student->reg_no      = (string) $nextReg;
            $student->issue_date  = $request->issue_date;
            $student->status      = $request->status;
            $student->save();

            DB::commit();
            return redirect()->route('admin.student.index')->with('success', 'New Student Added Success!');
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
        $edit_user_student = User::findOrFail($id);
        $edit_student = Student::where('user_id', $id)->first();
        return view('admin.student.edit', compact('edit_user_student', 'edit_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_student = User::findOrFail($id);
        $student = Student::where('user_id', $user_student->id)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_student->id,
            'phone' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // users table update
            $user_student->name    = $request->name;
            $user_student->email   = $request->email;
            $user_student->phone   = $request->phone;
            $user_student->status  = $request->status;
            $user_student->save();

            // students table update
            $student->admin_id    = auth()->user()->id;
            $student->issue_date  = $request->issue_date;
            $student->expire_date = $request->expire_date;
            $student->status      = $request->status;
            $student->save();
            DB::commit();
            return redirect()->route('admin.student.index')->with('success', 'Student Updated Success!');
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
            $user_student = User::findOrFail($id);
            $student = Student::where('user_id', $user_student->id)->first();

            if ($student) {
                $student->delete();
            }
            $user_student->delete();
            DB::commit();
            return redirect()->route('admin.student.index')->with('delete', 'Student Deleted Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Delete failed! ' . $e->getMessage());
        }
    }
}
