@include('teacher.layouts.includes.meta')
@include('teacher.layouts.includes.preloader')
@include('teacher.layouts.includes.header')
@include('teacher.layouts.includes.sidebar')
<div class="mobile-menu-overlay"></div>

@yield('content')

@include('teacher.layouts.includes.script')
