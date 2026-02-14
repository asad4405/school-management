@extends('webview.layouts.master')
@section('content')
    <!-- Hero Section -->
    <section class="hero text-center py-5">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">Building Future Leaders</h1>
            <p class="lead">Quality Education | Discipline | Innovation</p>
            <a class="btn btn-light btn-lg mt-3">Apply for Admission</a>
        </div>
    </section>

    <!-- Quick Access -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="icon-box">
                        <i class="fa fa-user-graduate fa-2x text-primary"></i>
                        <h5 class="mt-3">Students</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box">
                        <i class="fa fa-chalkboard-teacher fa-2x text-primary"></i>
                        <h5 class="mt-3">Teachers</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box">
                        <i class="fa fa-file-lines fa-2x text-primary"></i>
                        <h5 class="mt-3">Result</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="icon-box">
                        <i class="fa fa-calendar-check fa-2x text-primary"></i>
                        <h5 class="mt-3">Routine</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notice & News -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h4 class="section-title">Notice Board</h4>
                    <ul class="list-group notice-box">
                        <li class="list-group-item">Admission Test Schedule Published</li>
                        <li class="list-group-item">Half Yearly Exam Routine</li>
                        <li class="list-group-item">Parents Meeting Notice</li>
                        <li class="list-group-item">Holiday Announcement</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4 class="section-title">Latest News</h4>
                    <p>🏆 Our students achieved 100% SSC pass rate.</p>
                    <p>🖥️ New Digital Lab inaugurated.</p>
                    <p>🎓 Scholarship program launched.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-5 text-center">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="counter text-primary">1500+</div>
                    <p>Students</p>
                </div>
                <div class="col-md-3">
                    <div class="counter text-primary">80+</div>
                    <p>Teachers</p>
                </div>
                <div class="col-md-3">
                    <div class="counter text-primary">25</div>
                    <p>Years Experience</p>
                </div>
                <div class="col-md-3">
                    <div class="counter text-primary">100%</div>
                    <p>Success Rate</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h3 class="section-title">Academic Facilities</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="icon-box">📚 Smart Classrooms</div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box">🧪 Science Laboratory</div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box">💻 Computer Lab</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <h3 class="section-title">Why Choose Green Valley School</h3>
            <ul>
                <li>Experienced Teachers</li>
                <li>Digital Learning System</li>
                <li>100% Result Record</li>
                <li>Safe Campus</li>
            </ul>
        </div>
    </section>

    <!-- Principal Message -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <h4 class="section-title text-white">Message from Principal</h4>
            <p>
                Our mission is to nurture students with knowledge, discipline and
                moral values to prepare them for a successful future.
            </p>
        </div>
    </section>
@endsection
