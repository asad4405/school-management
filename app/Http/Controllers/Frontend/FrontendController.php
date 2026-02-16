<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\Exampublish;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('webview.index');
    }

    public function result()
    {
        $exams = Exam::latest()->get();
        $exam_years = Exampublish::select('exam_year')
            ->distinct()
            ->orderBy('exam_year', 'desc')
            ->pluck('exam_year');
        $classes = Classes::get();

        return view('webview.result', compact('exams', 'exam_years', 'classes'));
    }

    public function result_store(Request $request)
    {
        // Validate data
        $result_type = $request->result_type;

        if ($result_type == 'individual') {
            $request->validate([
                'exam' => 'required|exists:exams,id',
                'year' => 'required|integer',
                'roll_no' => 'required|string',
                'reg_no' => 'required|string',
                'result_type' => 'required',
            ]);
        } else {
            $request->validate([
                'exam' => 'required|exists:exams,id',
                'year' => 'required|integer',
                'class' => 'required|exists:classes,id',
                'result_type' => 'required',
            ]);
        }


        $exam_id = $request->exam;
        $year = $request->year;
        $roll_no = $request->roll_no;
        $reg_no = $request->reg_no;
        $class_id = $request->class;
        $result_type = $request->result_type;

        $student = Student::where('roll_no', $roll_no)
            ->where('reg_no', $reg_no)
            ->first();
        if(!$student || !$student->roll_no || !$student->reg_no){
            return back()->with('error', 'No student found with the provided roll number and registration number.');
        }

        if ($result_type == 'individual') {
            return Result::where('exam_id', $exam_id)
                ->where('year', $year)
                ->where('student_id', $student->id)
                ->with('resultdetails')
                ->first();
        } else {
            return Result::where('exam_id', $exam_id)
                ->where('year', $year)
                ->where('class_id', $class_id)
                ->first();
        }
    }
}
