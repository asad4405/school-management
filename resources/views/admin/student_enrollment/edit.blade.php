@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Student Enrollment</h4>
                </div>
            </div>
            <form action="{{ route('admin.student.enrollment.update', $edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Student Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="student_id" class="form-control">
                            <option>Select Student</option>
                            @foreach ($students as $value)
                                <option value="{{ $value->id }}" {{ $edit_data->student_id == $value->id ? 'selected' : '' }}>{{ $value->student->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Class Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="class_id" class="form-control">
                            <option>Select Class</option>
                            @foreach ($class as $value)
                                <option value="{{ $value->id }}" {{ $edit_data->class_id == $value->id ? 'selected' : '' }}>{{ $value->class_name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Section Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="section_id" class="form-control">
                            <option>Select Section</option>
                            @foreach ($section as $value)
                                <option value="{{ $value->id }}" {{ $edit_data->section_id == $value->id ? 'selected' : '' }}>{{ $value->section_name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Academic Year</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="academic_year" type="text" value="{{ $edit_data->academic_year }}" required />
                        @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Position (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="position" type="number" value="{{ $edit_data->position }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" {{ $edit_data->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Deactive" {{ $edit_data->status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Student Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
