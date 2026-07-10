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
                {{-- Home --}}
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                {{-- Students --}}
                <li class="{{ request()->routeIs('admin.student.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-lines-fill"></span>
                        <span class="mtext">Students</span>
                    </a>
                </li>

                {{-- Admins --}}
                <li
                    class="{{ request()->routeIs('admin.list') || request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.list') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-people-fill"></span>
                        <span class="mtext">Admins</span>
                    </a>
                </li>

                {{-- Teachers --}}
                <li class="{{ request()->routeIs('admin.teacher.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.teacher.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-video3"></span>
                        <span class="mtext">Teachers</span>
                    </a>
                </li>

                {{-- Class & Section --}}
                <li
                    class="dropdown
                    {{ request()->routeIs('admin.class.index') || request()->routeIs('admin.section.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-easel"></span>
                        <span class="mtext"> Class & Section </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.class.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.class.index') }}">Class</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.section.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.section.index') }}">Section</a>
                        </li>
                    </ul>
                </li>

                {{-- Subject & Class --}}
                <li
                    class="dropdown
                    {{ request()->routeIs('admin.subject.*') || request()->routeIs('admin.class.subject.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-book-half"></span>
                        <span class="mtext"> Subject & Class </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.subject.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.subject.index') }}">Subject</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.class.subject.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.class.subject.index') }}">Class Subject</a>
                        </li>
                    </ul>
                </li>

                {{-- Assigned Teacher --}}
                <li class="dropdown
                    {{ request()->routeIs('admin.teacher.assignments.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-check"></span>
                        <span class="mtext"> Assigned Teacher </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.teacher.assignments.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.teacher.assignments.index') }}">Teacher Assignments</a>
                        </li>
                    </ul>
                </li>

                {{-- Student Enrollment --}}
                <li
                    class="dropdown
                    {{ request()->routeIs('admin.student.enrollment.*') || request()->routeIs('admin.exam.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-plus"></span>
                        <span class="mtext"> Student Enrollment </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.student.enrollment.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.student.enrollment.index') }}">Enrollment</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.exam.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exam.index') }}">Exam</a>
                        </li>
                    </ul>
                </li>

                {{-- Exam & Publish --}}
                <li
                    class="dropdown
                    {{ request()->routeIs('admin.exam.*') || request()->routeIs('admin.exampublish.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-clock-history"></span>
                        <span class="mtext"> Exam & Publish </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.exam.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exam.index') }}">Exam</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.exampublish.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.exampublish.index') }}">Publish</a>
                        </li>
                    </ul>
                </li>

                {{-- Notices --}}
                <li class="{{ request()->routeIs('admin.notice.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.notice.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-bell"></span>
                        <span class="mtext">Notices</span>
                    </a>
                </li>

                {{-- api: sms gateway --}}
                <li
                    class="dropdown
                    {{ request()->routeIs('admin.exam.*') || request()->routeIs('admin.exampublish.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-code-slash"></span>
                        <span class="mtext"> Api Integration </span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('admin.api.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.api.smsgateway.index') }}">Sms Gateway</a>
                            <a href="{{ route('admin.api.mailgateway.index') }}">Mail Gateway</a>
                        </li>
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
<style>
    .sidebar-menu li.active>a {
        background: #1b1f3b;
        color: #fff;
        font-weight: 600;
    }

    .sidebar-menu li.open>ul {
        display: block;
    }
</style>
