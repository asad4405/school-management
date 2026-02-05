@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Teacher assignment Lists</h4>
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
                            <th>Teacher </th>
                            <th>Class </th>
                            <th>Section </th>
                            <th>Subject  </th>
                            <th>Status</th>
                            {{-- <th class="datatable-nosort">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignedClassSubjects as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->teacher->teacher->name }}</td>
                                <td>{{ $value->class_subject->class_name }}</td>
                                <td>{{ $value->section->section_name }}</td>
                                <td>
                                    @foreach (json_decode($value->subject_id) as $subject_id)
                                        @php
                                            $subject = \App\Models\Subject::find($subject_id);
                                        @endphp
                                        @if ($subject)
                                            <span class="badge bg-success text-white">{{ $subject->subject_name }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($value->status == 'Active')
                                        <span class="p-1 text-white rounded span bg-success">Active</span>
                                    @else
                                        <span class="p-1 text-white rounded span bg-danger">Deactive</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <a href="" class="p-0 m-0">
                                            <i class="dw dw-eye bg-warning p-2 text-white rounded"></i>
                                        </a>
                                    </div>
                                </td> --}}
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
