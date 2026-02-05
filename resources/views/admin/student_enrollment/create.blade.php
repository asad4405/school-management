@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Create Student Enrollment</h4>
                </div>
            </div>
            <form action="{{ route('admin.student.enrollment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Student Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="student_id" class="form-control">
                            <option>Select Student</option>
                            @foreach ($students as $value)
                                <option value="{{ $value->id }}">{{ $value->student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Class Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="class_id" class="form-control">
                            <option>Select Class</option>
                            @foreach ($class as $value)
                                <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Section Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="section_id" class="form-control">
                            <option>Select Section</option>
                            @foreach ($section as $value)
                                <option value="{{ $value->id }}">{{ $value->section_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Academic Year</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="academic_year" type="text" required />
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
                            <option value="Deactive">Detactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Add Student Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
