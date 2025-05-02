@include('dashboard.layouts.header')
@include('dashboard.layouts.topbar')
@include('dashboard.layouts.leftsidebar')
@include('dashboard.layouts.breadcrumbs')


@yield('main-content')

@include('dashboard.layouts.footer')