@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Create Class Subject</h4>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.class.subject.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Class Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="class_id" class="form-control select2_class">
                            <option>Select Class</option>
                            @foreach ($class as $value)
                                <option value="{{ $value->id }}">{{ $value->class_name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Subject Name</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="subject_id[]" class="form-control select2-multiple" multiple="multiple">
                            <option>Select Subject</option>
                            @foreach ($subject as $value)
                                <option value="{{ $value->id }}">{{ $value->subject_name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        Add Class Subject
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .select2-container--default .select2-selection--single{
            display: flex !important;
            align-items: center !important;
            height: 45px !important;
        }
        .select2-container--default .select2-selection--multiple{
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
                placeholder: "Select Subject",
                closeOnSelect: false,
                width: '100%'
            });

            $('.select2_class').select2({
                placeholder: "Select Class",
                allowClear: true
            });
        });
    </script>
@endsection
