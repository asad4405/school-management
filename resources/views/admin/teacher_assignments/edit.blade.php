@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Teacher Assignment</h4>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.teacher.assignments.update', $teacher_assignment->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Teacher</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12 select2_teacher" name="teacher_id" required>
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $teacher_assignment->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Class</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="class_id" id="class_id" required>
                            <option value="">Select Class</option>
                            @foreach ($class_subjects as $class)
                                <option value="{{ $class->class->id }}" {{ $teacher_assignment->class_id == $class->class->id ? 'selected' : '' }}>
                                    {{ $class->class->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="form-control select2-multiple" name="subject_id[]" id="subject_id"
                            multiple="multiple">
                            <!-- Subjects loaded by JS -->
                        </select>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Section</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12 select2_section" name="section_id" required>
                            <option value="">Select Section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}" {{ $teacher_assignment->section_id == $section->id ? 'selected' : '' }}>{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Position (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="position" type="number"
                            value="{{ $teacher_assignment->position }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" {{ $teacher_assignment->status == 'Active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="Deactive" {{ $teacher_assignment->status == 'Deactive' ? 'selected' : '' }}>
                                Deactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Teacher Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .select2-container--default .select2-selection--single {
            display: flex !important;
            align-items: center !important;
            height: 45px !important;
        }

        .select2-container--default .select2-selection--multiple {
            display: flex !important;
            align-items: center !important;
            height: 45px !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2-multiple').select2({
                placeholder: "Select",
                closeOnSelect: false,
                width: '100%'
            });
            $('.select2_teacher').select2({
                placeholder: "Select Teacher",
                allowClear: true
            });
            $('.select2_section').select2({
                placeholder: "Select Section",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            // Page load এ subjects load + pre-select
            function loadSubjects(classId, selectedSubjects = []) {
                if (classId) {
                    $.ajax({
                        url: '{{ route("getClassSubjects") }}',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function (data) {
                            $('#subject_id').empty();

                            // Loop over fetched subjects
                            $.each(data, function (key, subject) {
                                let selected = selectedSubjects.includes(subject.id) ? 'selected' : '';
                                $('#subject_id').append('<option value="' + subject.id + '" ' + selected + '>' + subject.subject_name + '</option>');
                            });

                            $('#subject_id').trigger('change'); // select2 refresh
                        }
                    });
                } else {
                    $('#subject_id').empty();
                }
            }

            let initialClassId = $('#class_id').val();
            let selectedSubjects = @json(array_map('intval', json_decode($teacher_assignment->subject_id)));
            loadSubjects(initialClassId, selectedSubjects);

            $('#class_id').change(function () {
                let classId = $(this).val();
                loadSubjects(classId);
            });

        });
    </script>




@endsection
