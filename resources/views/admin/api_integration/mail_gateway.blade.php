@extends('admin.layouts.master')
@section('title') Mail Gateway @endsection
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Mail Gateway</h4>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.api.mailgateway.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Mailer</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_mailer" type="text" value="{{ $edit_data->mail_mailer }}" required />
                        @error('mail_mailer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Host</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_host" type="text" value="{{ $edit_data->mail_host }}" required />
                        @error('mail_host')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Port</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_port" type="text" value="{{ $edit_data->mail_port }}" required />
                        @error('mail_port')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Username</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_username" type="text" value="{{ $edit_data->mail_username }}" required />
                        @error('mail_username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Password</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_password" type="text" value="{{ $edit_data->mail_password }}" required />
                        @error('mail_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mail Encryption</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="mail_encryption" type="text" value="{{ $edit_data->mail_encryption }}" required />
                        @error('mail_encryption')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
