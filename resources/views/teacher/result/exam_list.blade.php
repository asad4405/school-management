@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Exam List</h4>
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
                            <th>Exam Name</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $value)
                            <tr>
                                <td class="table-plus">{{ $loop->index + 1 }}</td>
                                <td>{{ $value->exam_name }}</td>

                                <td>
                                    <form action="{{ route('teacher.result.entry', $student->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="{{ $value->id }}">
                                        <input type="hidden" name="exam_id" value="{{ $value->id }}">
                                        <button type="submit" class="p-0 p-2 m-0 border-0 bg-warning text-white rounded text-center">
                                            Entry Result
                                        </button>
                                    </form>
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





@endsection
