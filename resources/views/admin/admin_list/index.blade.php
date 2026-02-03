@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Admin Lists</h4>
                </div>
                <div class="pull-right">
                    <a href="" class="btn btn-primary btn-sm scroll-click"><i class="fa fa-plus"></i> Create</a>
                </div>
            </div>
            <div class="pb-20">
                <table class="table data-table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td> <span class="p-1 text-white rounded span bg-info">{{ $value->role }}</span></td>
                                <td>
                                    @if ($value->status == 'Active')
                                        <span class="p-1 text-white rounded span bg-success">Active</span>
                                    @else
                                        <span class="p-1 text-white rounded span bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <a href="#" class="p-0 m-0">
                                            <i class="dw dw-edit2 bg-primary p-2 text-white rounded"></i>
                                        </a>

                                        <form action="" method="POST" class="m-0 p-0">
                                            <button type="submit" class="p-0 m-0 border-0 bg-transparent">
                                                <i class="dw dw-delete-3 bg-danger p-2 text-white rounded"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
