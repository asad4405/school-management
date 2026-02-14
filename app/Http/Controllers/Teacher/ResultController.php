<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\Result;
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
        $student_entollment = StudentEntollment::where('student_id', $student_id)->where('status', 'Active')->with('student', 'section')->first();
        $student = Student::where('id', $student_id)->with('student')->first();
        $exam = Exam::where('id', $request->exam_id)->first();
        $teacher_id = Teacher::where('user_id', auth()->id())->first()->id;

        $teacher_assign = TeacherAssignment::where('teacher_id', $teacher_id)->where('class_id', $student_entollment->class_id)->first();
        if (!$teacher_assign) {
            return redirect()->back()->with('error', 'No subjects assigned to you for this class.');
        }
        $subject_ids = $teacher_assign->subject_id;
        $subjectIds = json_decode($subject_ids, true);
        $subjects = Subject::whereIn('id', $subjectIds)->get();

        // edit value
        $edit_result = Result::where([
            'student_id' => $student_id,
            'exam_id' => $request->exam_id,
            'class_id' => $student_entollment->class_id,
            'section_id' => $student_entollment->section_id
        ])->get()->keyBy('subject_id');
        return view('teacher.result.entry', compact('student_entollment', 'student', 'exam', 'subjects', 'edit_result'));
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

            $result = Result::where([
                'student_id' => $student_id,
                'exam_id' => $request->exam_id,
                'class_id' => $student_entollment->class_id,
                'section_id' => $student_entollment->section_id,
                'subject_id' => $subject_id,
            ])->first();

            if ($result) {
                // UPDATE
                $result->marks = $marks;
                $result->pass_marks = $pass_marks;
                $result->full_marks = $full_marks;
                $result->grade = $this->calculateGrade($marks, $full_marks);
                $result->gpa = $this->calculateGPA($marks, $full_marks);
                $result->save();
            } else {
                $result_entry = new Result();
                $result_entry->student_id = $student_id;
                $result_entry->exam_id = $request->exam_id;
                $result_entry->class_id = $student_entollment->class_id;
                $result_entry->section_id = $student_entollment->section_id;
                $result_entry->subject_id = $subject_id;
                $result_entry->marks = $marks;
                $result_entry->pass_marks = $pass_marks;
                $result_entry->full_marks = $full_marks;
                $result_entry->grade = $this->calculateGrade($marks, $full_marks);
                $result_entry->gpa = $this->calculateGPA($marks, $full_marks);
                $result_entry->save();
            }
        }

        return redirect()->route('teacher.result.students', $student_entollment->class_id)
            ->with('success', 'Result saved successfully.');
    }


    private function calculateGrade($marks, $full_marks)
    {
        if ($full_marks == 0) {
            return 'N/A';
        }
        $percentage = ($marks / $full_marks) * 100;
        if ($percentage >= 80) {
            return 'A+';
        } elseif ($percentage >= 70) {
            return 'A';
        } elseif ($percentage >= 60) {
            return 'A-';
        } elseif ($percentage >= 50) {
            return 'B';
        } elseif ($percentage >= 40) {
            return 'C';
        } elseif ($percentage >= 33) {
            return 'D';
        } else {
            return 'F';
        }
    }

    private function calculateGPA($marks, $full_marks)
    {
        if ($full_marks == 0) {
            return 0;
        }
        $percentage = ($marks / $full_marks) * 100;
        if ($percentage >= 80) {
            return 5.0;
        } elseif ($percentage >= 70) {
            return 4.5;
        } elseif ($percentage >= 60) {
            return 4.0;
        } elseif ($percentage >= 50) {
            return 3.5;
        } elseif ($percentage >= 40) {
            return 3.0;
        } else {
            return 2.5;
        }
    }

}
