@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Subject</h4>
                </div>
            </div>
            <form action="{{ route('admin.subject.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Subject Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="subject_name" type="text" value="{{ $edit_data->subject_name }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Subject Code (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="subject_code" type="text" value="{{ $edit_data->subject_code }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" @if($edit_data->status == 'Active') selected @endif>Active</option>
                            <option value="Deactive" @if($edit_data->status == 'Deactive') selected @endif>Detactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
