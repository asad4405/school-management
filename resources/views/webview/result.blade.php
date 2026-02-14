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

                        <form action="" method="POST">
                            @csrf
                            <!-- Exam Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Exam Name</label>
                                <select class="form-select" name="exam">
                                    <option selected disabled>Select Exam</option>
                                    <option value="">Mid Term</option>
                                    <option value="">Final Exam</option>
                                    <option value="">Test Exam</option>
                                </select>
                            </div>

                            <!-- Year -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Year of Examination</label>
                                <select class="form-select" name="year">
                                    <option selected disabled>Select Year</option>
                                    <option value="">2025</option>
                                    <option value="">2024</option>
                                    <option value="">2023</option>
                                </select>
                            </div>

                            <!-- Result Type -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Type of Result</label>
                                <select class="form-select" id="resultType">
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
                                    <input type="text" name="reg_no" class="form-control" placeholder="Enter Registration Number">
                                </div>
                            </div>

                            <!-- Class Wise Field -->
                            <div id="classWiseField" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Select Class</label>
                                    <select class="form-select">
                                        <option selected disabled>Select Class</option>
                                        <option>Class 6</option>
                                        <option>Class 7</option>
                                        <option>Class 8</option>
                                        <option>Class 9</option>
                                        <option>Class 10</option>
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
