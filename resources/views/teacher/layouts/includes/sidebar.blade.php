<div class="left-side-bar">
    <div class="brand-logo">
        <a href="">
            <img src="{{ asset('public/teacher/assets/vendors') }}/images/deskapp-logo.svg" alt="" class="dark-logo" />
            <img src="{{ asset('public/teacher/assets/vendors') }}/images/deskapp-logo-white.svg" alt=""
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
                <li class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('teacher.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>

                {{-- Teachers --}}
                <li class="dropdown
                    {{ request()->routeIs('teacher.list') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-video3"></span>
                        <span class="mtext">Teachers</span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('teacher.list') ? 'active' : '' }}">
                            <a href="{{ route('teacher.list') }}">Teacher List</a>
                        </li>
                    </ul>
                </li>

                {{-- Class & Subject --}}
                <li class="dropdown
                    {{ request()->routeIs('teacher.assigned.class.subjects') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-easel-fill"></span>
                        <span class="mtext">Class & Subject</span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('teacher.assigned.class.subjects') ? 'active' : '' }}">
                            <a href="{{ route('teacher.assigned.class.subjects') }}">Assigned Class Subject</a>
                        </li>
                    </ul>
                </li>

                {{-- Attendance --}}
                <li class="dropdown
                    {{ request()->routeIs('teacher.attendance.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-calendar-check-fill"></span>
                        <span class="mtext">Attendance</span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('teacher.attendance.class') ? 'active' : '' }}">
                            <a href="{{ route('teacher.attendance.class') }}">Student Attendance</a>
                        </li>
                    </ul>
                </li>

                {{-- Results --}}
                <li class="dropdown
                    {{ request()->routeIs('teacher.result.*') ? 'active open' : '' }}">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-award-fill"></span>
                        <span class="mtext">Results</span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ request()->routeIs('teacher.result.class') ? 'active' : '' }}">
                            <a href="{{ route('teacher.result.class') }}">Result Entry</a>
                        </li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="calendar.html" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
                    </a>
                </li> --}}

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
