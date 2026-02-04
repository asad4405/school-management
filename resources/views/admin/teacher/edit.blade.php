@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Teacher</h4>
                </div>
            </div>
            <form action="{{ route('admin.teacher.update', $edit_user_teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="name" type="text" value="{{ $edit_user_teacher->name }}" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="email" value="{{ $edit_user_teacher->email }}" type="email"  />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="phone" type="text" value="{{ $edit_user_teacher->phone }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Designation</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="designation" type="text" value="{{ $edit_teacher->designation }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Join Date</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="join_date" type="date" value="{{ $edit_teacher->join_date }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" @selected($edit_user_teacher->status == 'Active')>Active</option>
                            <option value="Deactive" @selected($edit_user_teacher->status == 'Deactive')>Deactive</option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
