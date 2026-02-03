@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Class Lists</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.class.create') }}" class="btn btn-primary btn-sm scroll-click"><i
                            class="fa fa-plus"></i> Create</a>
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
                            <th>Class Name</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>
                                    @if ($value->status == 'Active')
                                        <span class="p-1 text-white rounded span bg-success">Active</span>
                                    @else
                                        <span class="p-1 text-white rounded span bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td>{{ $value->position }}</td>
                                <td>
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <a href="{{ route('admin.class.edit', $value->id) }}" class="p-0 m-0">
                                            <i class="dw dw-edit2 bg-primary p-2 text-white rounded"></i>
                                        </a>

                                        <form action="{{ route('admin.class.destroy', $value->id) }}" method="POST"
                                            class="m-0 p-0 delete-form">
                                            @csrf
                                            @method('DELETE')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This class will be permanently deleted!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

@endsection
