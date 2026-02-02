@include('admin.layouts.includes.meta')
@include('admin.layouts.includes.preloader')
@include('admin.layouts.includes.header')
@include('admin.layouts.includes.sidebar')
<div class="mobile-menu-overlay"></div>

@yield('content')

@include('admin.layouts.includes.script')
