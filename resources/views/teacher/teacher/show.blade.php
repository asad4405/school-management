@extends('teacher.layouts.master')
@section('content')
    <div class="main-container">
        <div class="container py-2">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="teacher-card">
                        <div class="teacher-header">
                            <h3>Teacher Profile</h3>
                        </div>

                        <div class="text-center">
                            @if ($teacher->teacher->profile_photo)
                                <img src="{{ asset($teacher->teacher->profile_photo) }}" class="teacher-img" alt="Teacher">
                            @else
                                <img src="https://i.imgur.com/4Z7kZ8p.jpg" class="teacher-img" alt="Teacher">
                            @endif
                        </div>

                        <div class="teacher-head">
                            <h4>{{ $teacher->teacher->name }}</h4>
                            <span class="badge-subject">{{ $teacher->designation }}</span>
                        </div>
                        <div class="teacher-body">
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <p><strong>Email:</strong> {{ $teacher->teacher->email ?? 'N/A' }}</p>
                                    <p><strong>Phone:</strong> {{ $teacher->teacher->phone ?? 'N/A' }}</p>
                                    <p><strong>Teacher Code:</strong> {{ $teacher->teacher_code ?? 'N/A' }}</p>
                                    <p><strong>Join Date:</strong> {{ $teacher->join_date ?? 'N/A' }}</p>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <p><strong>Qualification:</strong> {{ $teacher->qualification ?? 'N/A' }}</p>
                                    <p><strong>Address:</strong> {{ $teacher->address ?? 'N/A' }}</p>
                                    <p><strong>Gender:</strong> {{ $teacher->gender ?? 'N/A' }}</p>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <p><strong>Birth Date:</strong> {{ $teacher->dob ?? 'N/A' }}</p>
                                    <p><strong>Religion:</strong> {{ $teacher->religion ?? 'N/A' }}</p>
                                    <p><strong>Nid:</strong> {{ $teacher->nid ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .teacher-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .1);
            transition: .3s;
        }

        .teacher-card:hover {
            transform: translateY(-6px);
        }

        .teacher-header {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            padding: 40px 20px 70px;
            text-align: center;
            color: #fff;
        }

        .teacher-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid #fff;
            object-fit: cover;
            margin-top: -70px;
        }

        .teacher-head {
            padding: 20px;
            text-align: center;
        }

        .teacher-body {
            padding: 0 25px 10px;
        }

        .teacher-body h4 {
            font-weight: 700;
        }

        .badge-subject {
            background: #eef2ff;
            color: #4f46e5;
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 20px;
            margin: 10px;
            display: inline-block;
        }
    </style>
@endsection
