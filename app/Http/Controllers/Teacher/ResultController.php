<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Exampublish;
use App\Models\Result;
use App\Models\Resultdetails;
use App\Models\Student;
use App\Models\StudentEntollment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function result_class()
    {
        $classes = Classes::where('status', 'Active')->orderBy('position', 'ASC')->get();
        return view('teacher.result.class', compact('classes'));
    }

    public function result_students($class_id)
    {
        $students = StudentEntollment::where('class_id', $class_id)->where('status', 'Active')->with('student')->get();
        $class = Classes::findOrFail($class_id);
        return view('teacher.result.index', compact('students', 'class'));
    }

    public function result_exam_list($student_id)
    {
        $exams = Exam::where('status', 'Active')->latest()->get();
        $student = Student::where('id', $student_id)->with('student')->first();
        return view('teacher.result.exam_list', compact('exams', 'student'));
    }

    public function result_entry(Request $request, $student_id)
    {
        $student_entollment = StudentEntollment::where('student_id', $student_id)
            ->where('status', 'Active')
            ->with('student', 'section')
            ->first();

        $student = Student::where('id', $student_id)->with('student')->first();
        $exam = Exam::where('id', $request->exam_id)->first();
        $exam_years = Exampublish::where('exam_id', $exam->id)->get();
        $teacher_id = Teacher::where('user_id', auth()->id())->first()->id;
        $teacher_assign = TeacherAssignment::where('teacher_id', $teacher_id)
            ->where('class_id', $student_entollment->class_id)
            ->first();

        if (!$teacher_assign) {
            return redirect()->back()->with('error', 'No subjects assigned to you for this class.');
        }

        $subject_ids = $teacher_assign->subject_id;
        $subjectIds = json_decode($subject_ids, true);

        $subjects = Subject::whereIn('id', $subjectIds)->get();

        $result = Result::where([
            'student_id' => $student_id,
            'exam_id' => $request->exam_id,
            'class_id' => $student_entollment->class_id,
            'section_id' => $student_entollment->section_id
        ])->first();

        $edit_result = [];

        if ($result) {
            $edit_result = Resultdetails::where('result_id', $result->id)
                ->get()
                ->keyBy('subject_id');
        }

        return view('teacher.result.entry', compact(
            'student_entollment',
            'student',
            'exam',
            'exam_years',
            'subjects',
            'result',
            'edit_result'
        ));
    }


    public function result_entry_store_update(Request $request, $student_id)
    {
        $student_entollment = StudentEntollment::where('student_id', $student_id)
            ->where('status', 'Active')
            ->first();

        $request->validate([
            'exam_id' => 'required',
            'subject_id' => 'required|array',
            'marks' => 'required|array',
            'pass_marks' => 'required|array',
            'full_marks' => 'required|array',
        ]);

        // create result

        $result = Result::where([
            'student_id' => $student_id,
            'exam_id' => $request->exam_id,
            'class_id' => $student_entollment->class_id,
            'section_id' => $student_entollment->section_id,
            'year' => $request->year,
        ])->first();

        if (!$result) {
            $result = new Result();
            $result->student_id = $student_id;
            $result->exam_id = $request->exam_id;
            $result->class_id = $student_entollment->class_id;
            $result->section_id = $student_entollment->section_id;
            $result->year = $request->year;
            $result->full_marks = 0;
            $result->avg_gpa = 0;
            $result->avg_grade = 'F';
            $result->save();
        }

        // ResultDetails

        foreach ($request->subject_id as $key => $subject_id) {

            $marks = $request->marks[$key];
            $pass_marks = $request->pass_marks[$key];
            $full_marks = $request->full_marks[$key];

            if ($marks > $full_marks) {
                return redirect()->back()->with(
                    'error',
                    'Marks cannot be greater than full marks for subject: ' .
                        Subject::find($subject_id)->subject_name
                );
            }

            $grade = $this->calculateGrade($marks, $full_marks);
            $gpa = $this->calculateGPA($marks, $full_marks);

            $detail = Resultdetails::where([
                'result_id' => $result->id,
                'subject_id' => $subject_id,
            ])->first();

            if ($detail) {
                // UPDATE
                $detail->marks = $marks;
                $detail->pass_marks = $pass_marks;
                $detail->full_marks = $full_marks;
                $detail->grade = $grade;
                $detail->gpa = $gpa;
                $detail->save();
            } else {
                // INSERT
                $details = new Resultdetails();
                $details->result_id = $result->id;
                $details->subject_id = $subject_id;
                $details->marks = $marks;
                $details->pass_marks = $pass_marks;
                $details->full_marks = $full_marks;
                $details->grade = $grade;
                $details->gpa = $gpa;
                $details->save();
            }
        }

        // Recalculate From Database

        $allDetails = Resultdetails::where('result_id', $result->id)->get();

        $totalFullMarks = 0;
        $totalGpa = 0;
        $subjectCount = $allDetails->count();
        $hasFail = false;

        foreach ($allDetails as $d) {

            $totalFullMarks += $d->full_marks;
            $totalGpa += $d->gpa;

            if ($d->grade == 'F') {
                $hasFail = true;
            }
        }

        // Apply Fail Rule

        if ($hasFail) {

            $result->avg_gpa = 0;
            $result->avg_grade = 'F';
        } else {

            $avgGpa = $subjectCount > 0 ? $totalGpa / $subjectCount : 0;

            $result->avg_gpa = round($avgGpa, 2);
            $result->avg_grade = $this->calculateFinalGrade($avgGpa);
        }

        $result->full_marks = $totalFullMarks;
        $result->save();


        return redirect()->route('teacher.result.students', $student_entollment->class_id)
            ->with('success', 'Result saved successfully.');
    }


    private function calculateGrade($marks, $full_marks)
    {
        if ($full_marks == 0) return 'N/A';

        $percentage = ($marks / $full_marks) * 100;

        if ($percentage >= 80) return 'A+';
        elseif ($percentage >= 70) return 'A';
        elseif ($percentage >= 60) return 'A-';
        elseif ($percentage >= 50) return 'B';
        elseif ($percentage >= 40) return 'C';
        elseif ($percentage >= 33) return 'D';
        else return 'F';
    }

    private function calculateGPA($marks, $full_marks)
    {
        if ($full_marks == 0) return 0;

        $percentage = ($marks / $full_marks) * 100;

        if ($percentage >= 80) return 5.0;
        elseif ($percentage >= 70) return 4.0;
        elseif ($percentage >= 60) return 3.5;
        elseif ($percentage >= 50) return 3.0;
        elseif ($percentage >= 40) return 2.5;
        elseif ($percentage >= 33) return 2.0;
        else return 0;
    }

    private function calculateFinalGrade($gpa)
    {
        if ($gpa >= 5) return 'A+';
        elseif ($gpa >= 4) return 'A';
        elseif ($gpa >= 3.5) return 'A-';
        elseif ($gpa >= 3) return 'B';
        elseif ($gpa >= 2.5) return 'C';
        elseif ($gpa >= 2) return 'D';
        else return 'F';
    }
}
