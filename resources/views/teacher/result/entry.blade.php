@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <!-- Default Basic Forms Start -->
        <div class="pd-20 card-box mb-30">
            <div>
                <marquee behavior="" direction="" class="text-danger fw-bold">বিশেষ দ্রষ্টব্য: এই স্টুডেন্টের প্রথমবার রেজাল্ট এন্ট্রির সময় অবশ্যই চেক করবেন সাল, ওই সাবজেক্টের পাশ মার্কস এবং ফুল মার্কস। [এখানে পাস মার্কস ডিফল্টভাবে 33 এবং ফুল মার্কস ডিফল্টভাবে 100 দেওয়া আছে] এবং সর্বশেষ মার্কস দিয়ে রেজাল্ট এন্ট্রি করবেন ধন্যবাদ।</marquee>
            </div>
            <div class="clearfix">
                <div class="my-2 pull-left">
                    <h4 class="text-blue h4">Result Entry</h4>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('teacher.result.entry.store.update', $student->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Show Student Info (Read Only)</label>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text" value="Name: {{ $student->student->name }}" readonly />
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text" value="Phone: {{ $student->student->phone }}" readonly />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label"></label>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text" value="Class Roll: {{ $student->class_roll ?? 'N/A' }}"
                            readonly />
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text" value="Roll No: {{ $student->roll_no }}" readonly />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label"></label>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text" value="Reg. No: {{ $student->reg_no }}" readonly />
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <input class="form-control" type="text"
                            value="Section: {{ $student_entollment->section->section_name }}" readonly />
                    </div>
                </div>

                {{-- exam --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Exam</label>
                    <div class="col-sm-12 col-md-5">
                        <select name="exam_id" id="exam_id" class="form-control">
                            <option value="{{ $exam->id }}" selected>{{ $exam->exam_name }}</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <select name="year" id="year" class="form-control">
                            @foreach ($exam_years as $value)
                                <option value="{{ $value->exam_year }}" @if($value->exam_year == $result->year) selected @endif>
                                    {{ $value->exam_year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- subject --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">
                        Subject wise Marks
                    </label>

                    <div class="col-sm-12 col-md-10">
                        <div class="row">
                            <div class="col-md-3"><label class="form-label">Subjects</label></div>
                            <div class="col-md-3"><label class="form-label">Subject Marks</label></div>
                            <div class="col-md-3"><label class="form-label">Pass Marks</label></div>
                            <div class="col-md-3"><label class="form-label">Full Marks</label></div>
                        </div>
                        @foreach ($subjects as $subject)
                            @php
                                $existing = $edit_result[$subject->id] ?? null;
                            @endphp

                            <div class="row mb-2">

                                <!-- subject -->
                                <div class="col-md-3">
                                    <input type="hidden" name="subject_id[]" value="{{ $subject->id }}">
                                    <input type="text" class="form-control" value="{{ $subject->subject_name }}" readonly>
                                </div>

                                <!-- marks -->
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="marks[]"
                                        value="{{ $existing->marks ?? '' }}" placeholder="Enter marks" required>
                                </div>

                                <!-- pass marks -->
                                <div class="col-md-3">
                                    <input class="form-control" name="pass_marks[]" type="text"
                                        value="{{ $existing->pass_marks ?? 33 }}" required />
                                </div>

                                <!-- full marks -->
                                <div class="col-md-3">
                                    <input class="form-control" name="full_marks[]" type="text"
                                        value="{{ $existing->full_marks ?? 100 }}" required />
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

                <div class=" btn-list">
                    <button type="submit" class="btn btn-primary active focus">
                        Entry Result
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
