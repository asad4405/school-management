@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Create Teacher Assignment</h4>
                </div>
            </div>
            <form action="{{ route('admin.teacher.assignments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Teacher</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="teacher_id" required>
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Teacher</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="class_id" id="class_id" required>
                            <option value="">Select Class</option>
                            @foreach ($class_subjects as $cs)
                                <option value="{{ $cs->class->id }}">
                                    {{ $cs->class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="form-control select2-multiple" name="subject_id[]" id="subject_id"
                            multiple="multiple">
                            <!-- Subjects will be loaded via AJAX -->
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Section</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="section_id" required>
                            <option value="">Select Section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Position (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="position" type="number" value="" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Add Teacher Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>

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
        });
    </script>

    <script>
        $('#class_id').change(function () {
            var classId = $(this).val(); // এখন correct classes.id pathacche
            if (classId) {
                $.ajax({
                    url: '{{ route("getClassSubjects") }}',
                    type: 'GET',
                    data: { class_id: classId }, // class_subjects এর row খুঁজতে use করব
                    success: function (data) {
                        $('#subject_id').empty();
                        $.each(data, function (key, subject) {
                            $('#subject_id').append('<option value="' + subject.id + '">' + subject.subject_name + '</option>');
                        });
                        $('#subject_id').trigger('change'); // select2 refresh
                    }
                });
            } else {
                $('#subject_id').empty();
            }
        });

    </script>





@endsection