@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Edit Student</h4>
                </div>
            </div>
            <form action="{{ route('admin.student.update', $edit_user_student->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="name" type="text" value="{{ $edit_user_student->name }}"
                            required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="email" type="email" value="{{ $edit_user_student->email }}"
                            required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="phone" type="text" value="{{ $edit_user_student->phone }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Issue Date</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="issue_date" type="date" value="{{ $edit_student->issue_date }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Expire Date</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="expire_date" type="date" value="{{ $edit_student->expire_date }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="status">
                            <option value="Active" {{ $edit_user_student->status == 'Active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="Deactive" {{ $edit_user_student->status == 'Deactive' ? 'selected' : '' }}>Deactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
