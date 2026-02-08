@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Attendance Students</h4>
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
                            <th>Student </th>
                            <th>Class Roll</th>
                            <th>Phone </th>
                            <th>Roll No. </th>
                            <th>Reg No.</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->student->student->name }}</td>
                                <td>{{ $value->student->class_roll ?? 'N/A' }}</td>
                                <td>{{ $value->student->student->phone }}</td>
                                <td>{{ $value->student->roll_no }}</td>
                                <td>{{ $value->student->reg_no }}</td>
                                <td>
                                    <a href="javascript:void(0)" style="display:inline-block; margin-right:10px;" class="p-2 text-white rounded bg-success attendance-btn
                                               {{ $value->attendance?->status === 'Present' ? '' : 'opacity-50' }}"
                                        data-id="{{ $value->student_id }}" data-status="Present">
                                        Present
                                        <span class="tick">{{ $value->attendance?->status === 'Present' ? '✔' : '' }}</span>
                                    </a>

                                    <a href="javascript:void(0)" style="display:inline-block;" class="p-2 text-white rounded bg-danger attendance-btn
                                               {{ $value->attendance?->status === 'Absent' ? '' : 'opacity-50' }}"
                                        data-id="{{ $value->student_id }}" data-status="Absent">
                                        Absent
                                        <span class="tick">{{ $value->attendance?->status === 'Absent' ? '✔' : '' }}</span>
                                    </a>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <a href="" class="p-0 m-0">
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
    <style>
        .tick {
            font-weight: bold;
            margin-left: 4px;
        }

        .opacity-50 {
            opacity: 0.5;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.attendance-btn', function () {

            let btn = $(this);
            let id = btn.data('id');
            let status = btn.data('status');

            $.ajax({
                url: "{{ route('teacher.attendance.store.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function (res) {

                    // SweetAlert success
                    Swal.fire({
                        icon: 'success',
                        title: 'Attendance Saved',
                        text: 'Marked as ' + res.status,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    let td = btn.closest('td');

                    // reset buttons
                    td.find('.attendance-btn')
                        .addClass('opacity-50')
                        .find('.tick').html('');

                    // active button
                    btn.removeClass('opacity-50')
                        .find('.tick')
                        .html(' ✔');
                }
            });
        });
    </script>






@endsection
