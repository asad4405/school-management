@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Teacher Lists</h4>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger">{{ session('delete') }}</div>
            @endif
            <div class="pb-20">
                <table class="table data-table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">SL</th>
                            <th>Name </th>
                            <th>Phone </th>
                            <th>Designation </th>
                            <th>Join Date </th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->teacher->name }}</td>
                                <td>{{ $value->teacher->phone }}</td>
                                <td>{{ $value->designation }}</td>
                                <td>{{ $value->join_date }}</td>
                                <td>
                                    @if ($value->status == 'Active')
                                        <span class="p-1 text-white rounded span bg-success">Active</span>
                                    @else
                                        <span class="p-1 text-white rounded span bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <a href="{{ route('teacher.show',$value->id) }}" class="p-0 m-0">
                                            <i class="dw dw-eye bg-warning p-2 text-white rounded"></i>
                                        </a>
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
