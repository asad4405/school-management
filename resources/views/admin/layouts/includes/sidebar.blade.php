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
                    <a href="" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-people-fill"></span><span class="mtext">Students</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.student.index') }}">Student List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-people-fill"></span><span class="mtext">Admins</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.list') }}">Admin List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-video3"></span><span class="mtext">Teachers</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.teacher.index') }}">Teacher List</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="calendar.html" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
                    </a>
                </li> --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-archive"></span><span class="mtext"> Classes </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.class.index') }}">Class </a></li>
                        <li><a href="{{ route('admin.section.index') }}">Section </a></li>
                        <li><a href="{{ route('admin.subject.index') }}">Subject </a></li>
                        <li><a href="{{ route('admin.class.subject.index') }}">Class Subject </a></li>
                        <li><a href="{{ route('admin.teacher.assignments.index') }}">Teacher Assignments </a></li>
                    </ul>
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
