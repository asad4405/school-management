@extends('webview.layouts.master')
@section('content')
    @if ($result_type == 'individual')



        <style>
            .result-wrapper {
                background: #fff;
                padding: 25px;
                border: 1px solid #000;
                max-width: 794px;
                /* A4 width */
                margin: auto;
            }

            .school-header img {
                width: 70px;
            }

            .info-table td {
                padding: 6px;
                border-bottom: 1px solid #ddd;
                font-size: 13px;
            }

            .subject-table th,
            .subject-table td {
                border-bottom: 1px solid #ddd;
                padding: 8px;
                font-size: 13px;
            }

            .subject-table th {
                font-weight: 600;
            }

            /* ---------- PRINT SETTINGS ---------- */
            @media print {

                @page {
                    size: A4;
                    margin: 12mm;
                }

                body {
                    background: none;
                    zoom: 100%;
                }

                .container {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                }

                .result-wrapper {
                    border: none;
                    padding: 0;
                    width: 100%;
                    page-break-inside: avoid;
                }

                table,
                tr,
                td,
                th {
                    page-break-inside: avoid !important;
                }

                .no-print {
                    display: none !important;
                }
            }
        </style>

        <div class="container my-4">
            <div class="result-wrapper">

                <!-- Header -->
                <div class="text-center school-header mb-4">
                    <img src="school-logo.png" alt="School Logo">
                    <h5 class="fw-bold mt-2 text-uppercase">
                        WEB BASED RESULT PUBLICATION SYSTEM
                    </h5>
                    <p class="mb-1">For School Examination</p>
                    <h6 class="mt-3 fw-bold">
                        Result of Annual Examination - {{ $individual_result->year }}
                    </h6>
                </div>

                <hr>

                <!-- Student Info -->
                <h6 class="fw-bold mb-3">Student Information Summary</h6>

                <table class="table table-borderless info-table">
                    <tr>
                        <td width="25%"><strong>Roll No</strong></td>
                        <td width="25%">{{ $individual_result->student->roll_no ?? 'N/A' }}</td>
                        <td width="25%"><strong>Registration No</strong></td>
                        <td width="25%">{{ $individual_result->student->roll_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Name of Student</strong></td>
                        <td colspan="3">{{ $individual_result->student->student->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Guardian Name</strong></td>
                        <td colspan="3">{{ $individual_result->student->guardian_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Class</strong></td>
                        <td>{{ $individual_result->class->class_name }}</td>
                        <td><strong>Group</strong></td>
                        <td>{{ $individual_result->section->section_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td>{{ $individual_result->student->gender ?? 'N/A' }}</td>
                        <td><strong>Date of Birth</strong></td>
                        <td>{{ $individual_result->student->dob ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Result</strong></td>
                        <td>GPA: {{ $individual_result->avg_gpa }}</td>
                        <td>Grade: {{ $individual_result->avg_grade }}</td>
                        <td>Position: {{ $individual_result->position ?? 'N/A' }} </td>
                    </tr>
                </table>

                <!-- Subject Result -->

                <h6 class="fw-bold text-center mb-3">Subject-wise Grade / Marks</h6>

                <table class="table subject-table text-center">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Marks</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($individual_result->resultdetails as $result)
                            <tr>
                                <td>{{ $result->subject->subject_code }}</td>
                                <td>{{ $result->subject->subject_name }}</td>
                                <td>{{ $result->marks }}</td>
                                <td>{{ $result->grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Print Button -->
                <div class="text-end mt-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        🖨️ Print Result
                    </button>
                </div>

            </div>
        </div>


    @elseif ($result_type == 'classwise')
        <div class="container my-5">
            <div class="card shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="mb-0 fw-bold">
                            Class {{ $class_results->first()->class->class_name }} Result
                        </h3>
                        <small class="text-muted">Academic Result Summary</small>
                    </div>

                    <button onclick="window.print()" class="btn btn-primary no-print mt-2 mt-md-0">
                        🖨️ Print Result
                    </button>
                </div>
            </div>

            <div class="row">
                @foreach ($class_results as $value)
                    <div class="col-lg-3 col-6">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $value->student->student->name }}</h6>
                                <p class="mb-1">Roll: {{ $value->student->roll_no }}</p>
                                <p class="mb-1">Marks: {{ $value->total_marks }}</p>
                                <p class="mb-1">GPA: {{ $value->avg_gpa }} ({{ $value->avg_grade }})</p>
                                <p class="mb-1">Position: {{ $value->position }}</p>
                                @if ($value->avg_grade == 'F')
                                    <span class="badge bg-danger">Fail</span>
                                @else
                                    <span class="badge bg-success">Pass</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


@endsection
