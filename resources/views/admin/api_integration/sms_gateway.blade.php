@extends('admin.layouts.master')
@section('title') Sms Gateway @endsection
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Sms Gateway</h4>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.api.smsgateway.update',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">url</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="url" type="text" value="{{ $edit_data->url }}" required />
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Api Key</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="api_key" type="text" value="{{ $edit_data->api_key }}" required />
                        @error('api_key')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Senderid</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="senderid" type="text" value="{{ $edit_data->senderid }}" required />
                        @error('senderid')
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
