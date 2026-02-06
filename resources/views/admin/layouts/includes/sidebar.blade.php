<div class="left-side-bar">
    <div class="brand-logo">
        <a href="">
            <img src="{{ asset('public/admin/assets/vendors') }}/images/deskapp-logo.svg" alt="" class="dark-logo" />
            <img src="{{ asset('public/admin/assets/vendors') }}/images/deskapp-logo-white.svg" alt=""
                class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.student.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-lines-fill"></span><span class="mtext">Students</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.list') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-people-fill"></span><span class="mtext">Admins</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.teacher.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-video3"></span><span class="mtext">Teachers</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-easel"></span><span class="mtext"> Class & Section </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.class.index') }}">Class </a></li>
                        <li><a href="{{ route('admin.section.index') }}">Section </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-book-half"></span><span class="mtext"> Subject & Class </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.subject.index') }}">Subject </a></li>
                        <li><a href="{{ route('admin.class.subject.index') }}">Class Subject </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-check"></span><span class="mtext"> Assigned Teacher </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.teacher.assignments.index') }}">Teacher Assignments </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-plus"></span><span class="mtext"> Student Enrollment </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.student.enrollment.index') }}">Enrollment </a></li>
                        <li><a href="{{ route('admin.exam.index') }}">Exam </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.exam.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-clock-history"></span><span class="mtext">Exams</span>
                    </a>
                </li>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-pdf"></span><span class="mtext">Documentation</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="">Introduction</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
