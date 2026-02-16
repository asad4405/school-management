<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Exam;
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
        $exam_years = Exam::select('exam_year')
            ->distinct()
            ->orderBy('exam_year', 'desc')
            ->pluck('exam_year');
        $classes = Classes::get();

        return view('webview.result', compact('exams', 'exam_years', 'classes'));
    }
}
