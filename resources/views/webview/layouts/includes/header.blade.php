<!-- Top Info Bar -->
<div class="top-bar py-2">
    <div class="container d-flex justify-content-between">
        <span><i class="fa-solid fa-phone"></i> 01234-567890 |
            info@gvschool.edu</span>
        <span><i class="fa-solid fa-graduation-cap"></i> Admission Open 2026</span>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Demo School</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Academics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Notice</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('result') }}">Result</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item ms-2">
                    <a class="btn btn-warning btn-sm" href="">Student Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
