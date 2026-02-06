@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Exam</h4>
                </div>
            </div>
            <form action="{{ route('admin.exam.update', parameters: $edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Exam Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="exam_name" type="text" value="{{ $edit_data->exam_name }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Exam Year</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="exam_year" type="text" value="{{ $edit_data->exam_year }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Published Date (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="position_date" type="date" value="{{ $edit_data->position_date ?? '' }}" />
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
                        Update Exam
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
