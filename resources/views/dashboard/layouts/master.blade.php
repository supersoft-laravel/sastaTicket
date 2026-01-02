<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ \App\Helpers\Helper::getCompanyName() }} - @yield('title')</title>
    @include('dashboard.layouts.meta')
    @include('dashboard.layouts.css')
    @yield('css')
</head>

<body data-barba="wrapper">

    <div class="preloader js-preloader"></div>


    <div class="header-margin"></div>
    @include('dashboard.layouts.header')


    <div class="dashboard" data-x="dashboard" data-x-toggle="-is-sidebar-open">
        <div class="dashboard__sidebar bg-white scroll-bar-1">
            @include('dashboard.layouts.sidebar')
        </div>

        <div class="dashboard__main">
            <div class="dashboard__content">
                <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-40 md:pb-32">
                    <div class="col-auto">
                        <h1 class="text-30 lh-14 fw-500">@yield('title')</h1>
                        {{-- <div class="text-15 text-light-1">Lorem ipsum dolor sit amet, consectetur.</div> --}}
                    </div>

                    <div class="col-auto">

                    </div>
                </div>

                @yield('content')

                @include('dashboard.layouts.footer')
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    @include('dashboard.layouts.script')
    @yield('script')
</body>

</html>
