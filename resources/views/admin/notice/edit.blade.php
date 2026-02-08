@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Notice</h4>
                </div>
            </div>
            <form action="{{ route('admin.notice.update', $edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Notice Title</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="title" type="text" value="{{ $edit_data->title }}" required />
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                    <div class="col-sm-12 col-md-10">
                        <textarea name="description" id="description"
                            class="form-control">{{ $edit_data->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Notice For</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="notice_for">
                            <option value="all">All</option>
                            <option value="student" {{ $edit_data->notice_for == 'student' ? 'selected' : '' }}>Student
                            </option>
                            <option value="teacher" {{ $edit_data->notice_for == 'teacher' ? 'selected' : '' }}>Teacher
                            </option>
                            <option value="admin" {{ $edit_data->notice_for == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">File (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="file" type="file" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Position (optional)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="position" type="number" value="{{ $edit_data->position }}" />

                        @if ($edit_data->file)
                            @if ($file_ext == 'pdf')
                                <div class="mt-3">
                                    <a href="{{ asset($edit_data->file) }}" target="_blank" class="bg-success p-2 text-white rounded">View File</a>
                                </div>
                            @else
                                <div class="mt-3">
                                    <img src="{{ asset($edit_data->file) }}" alt="Notice File" width="100">
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" {{ $edit_data->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Deactive" {{ $edit_data->status == 'Deactive' ? 'selected' : '' }}>Deactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Notice
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
