<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use App\Models\StudentEntollment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance_class()
    {
        $classes = Classes::where('status', 'Active')->orderBy('position', 'ASC')->get();
        return view('teacher.attendance.class', compact('classes'));
    }
    public function attendance_students($class_id)
    {
        $students = StudentEntollment::where('class_id', $class_id)->where('status', 'Active')->with('student')->get();
        return view('teacher.attendance.index', compact('students'));
    }

    public function attendance_store_update(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $enrollment = StudentEntollment::where('student_id', $student->id)->first();


        if (!$enrollment) {
            return response()->json([
                'error' => 'Student enrollment not found'
            ], 422);
        }

        $attendance = Attendance::where('student_id', $student->id)
            ->whereDate('date', Carbon::today())
            ->first();

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->user_id    = auth()->user()->id;
            $attendance->student_id = $student->id;
            $attendance->class_id   = $enrollment->class_id;
            $attendance->section_id = $enrollment->section_id;
            $attendance->date       = Carbon::today();
        }

        $attendance->status = $request->status;
        $attendance->save();

        return response()->json([
            'status' => $attendance->status
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
