@extends('webview.layouts.master')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4 class="mb-0">Result Search</h4>
                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('result.store') }}" method="POST">
                            @csrf
                            <!-- Exam Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Exam Name</label>
                                <select class="form-select" name="exam">
                                    <option selected disabled>Select Exam</option>
                                    @foreach($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Year of Examination</label>
                                <select class="form-select" name="exam_year">
                                    <option selected disabled>Select Year</option>
                                    @foreach ($exam_years as $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Result Type -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Type of Result</label>
                                <select class="form-select" id="resultType" name="result_type">
                                    <option selected disabled>Select Type</option>
                                    <option value="individual">Individual / Detailed Result</option>
                                    <option value="classwise">Class Wise Result</option>
                                </select>
                            </div>

                            <!-- Individual Fields -->
                            <div id="individualFields" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Roll Number of Examinee</label>
                                    <input type="text" name="roll_no" class="form-control" placeholder="Enter Roll Number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Registration Number of Examinee</label>
                                    <input type="text" name="reg_no" class="form-control"
                                        placeholder="Enter Registration Number">
                                </div>
                            </div>

                            <!-- Class Wise Field -->
                            <div id="classWiseField" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Select Class</label>
                                    <select class="form-select" name="class">
                                        <option selected disabled>Select Class</option>
                                        @foreach ($classes as $value)
                                            <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-5 rounded-pill">
                                    Search Result
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.getElementById('resultType').addEventListener('change', function () {

            let individual = document.getElementById('individualFields');
            let classwise = document.getElementById('classWiseField');

            if (this.value === 'individual') {
                individual.style.display = 'block';
                classwise.style.display = 'none';
            } else if (this.value === 'classwise') {
                individual.style.display = 'none';
                classwise.style.display = 'block';
            } else {
                individual.style.display = 'none';
                classwise.style.display = 'none';
            }
        });
    </script>
@endsection
