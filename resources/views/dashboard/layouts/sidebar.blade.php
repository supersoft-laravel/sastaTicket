<div class="sidebar -dashboard">
    <div class="sidebar__item">
        <div class="sidebar__button {{ request()->routeIs('dashboard') ? '-is-active' : '' }}">
            <a href="{{ route('dashboard') }}" class="d-flex items-center text-15 lh-1 fw-500">
                <i class="fas fa-border-all mr-15"></i>
                Dashboard
            </a>
        </div>
    </div>
    @canany(['view flight booking'])
        <div class="sidebar__item ">
            <div class="accordion -db-sidebar js-accordion">
                <div class="accordion__item {{ request()->routeIs('dashboard.flight.bookings') ? 'is-active' : '' }}">
                    <div class="accordion__button">
                        <div class="sidebar__button col-12 d-flex items-center justify-between">
                            <div class="d-flex items-center text-15 lh-1 fw-500">
                                <i class="fas fa-plane mr-15"></i>
                                Manage Flights
                            </div>
                            <div class="icon-chevron-sm-down text-7"></div>
                        </div>
                    </div>

                    <div class="accordion__content"
                        {{ request()->routeIs('dashboard.flight.bookings') ? 'style=max-height:35px' : '' }}>
                        <ul class="list-disc pb-5 pl-40">
                            <li>
                                <a href="{{ route('dashboard.flight.bookings') }}" class="text-15">Flight Bookings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('view contact')
        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('dashboard.contacts.*') ? '-is-active' : '' }}">
                <a href="{{ route('dashboard.contacts.index') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="fas fa-envelope mr-15"></i>
                    Contacts
                </a>
            </div>
        </div>
    @endcan

    {{-- <div class="sidebar__item ">
        <div class="accordion -db-sidebar js-accordion">
            <div class="accordion__item">
                <div class="accordion__button">
                    <div class="sidebar__button col-12 d-flex items-center justify-between">
                        <div class="d-flex items-center text-15 lh-1 fw-500">
                            <i class="fas fa-building mr-15"></i>
                            Manage Hotel
                        </div>
                        <div class="icon-chevron-sm-down text-7"></div>
                    </div>
                </div>

                <div class="accordion__content">
                    <ul class="list-disc pb-5 pl-40">

                        <li>
                            <a href="db-vendor-hotels.html" class="text-15">All hotels</a>
                        </li>

                        <li>
                            <a href="db-vendor-add-hotel.html" class="text-15">Add hotel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar__item ">
        <div class="accordion -db-sidebar js-accordion">
            <div class="accordion__item">
                <div class="accordion__button">
                    <div class="sidebar__button col-12 d-flex items-center justify-between">
                        <div class="d-flex items-center text-15 lh-1 fw-500">
                            <i class="fas fa-flag  mr-15"></i>
                            Manage tour
                        </div>
                        <div class="icon-chevron-sm-down text-7"></div>
                    </div>
                </div>

                <div class="accordion__content">
                    <ul class="list-disc pb-5 pl-40">

                        <li>
                            <a href="db-vendor-tour.html" class="text-15">All tour</a>
                        </li>

                        <li>
                            <a href="db-vendor-add-tour.html" class="text-15">Add tour</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar__item ">
        <div class="accordion -db-sidebar js-accordion">
            <div class="accordion__item">
                <div class="accordion__button">
                    <div class="sidebar__button col-12 d-flex items-center justify-between">
                        <div class="d-flex items-center text-15 lh-1 fw-500">
                            <i class="fas fa-bus-alt mr-15"></i>
                            Manage bus
                        </div>
                        <div class="icon-chevron-sm-down text-7"></div>
                    </div>
                </div>

                <div class="accordion__content">
                    <ul class="list-disc pb-5 pl-40">

                        <li>
                            <a href="db-vendor-bus.html" class="text-15">All bus</a>
                        </li>

                        <li>
                            <a href="db-vendor-add-bus.html" class="text-15">Add bus</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar__item">
        <div class="sidebar__button">
            <a href="db-wishlist.html" class="d-flex items-center text-15 lh-1 fw-500">
                <i class="fas fa-tags mr-15"></i>
                Wishlist
            </a>
        </div>
    </div> --}}

    <div class="sidebar__item">
        <div class="sidebar__button {{ request()->routeIs('profile.index') ? '-is-active' : '' }}">
            <a href="{{ route('profile.index') }}" class="d-flex items-center text-15 lh-1 fw-500">
                <i class="fas fa-user-circle  mr-15"></i>
                My Profile
            </a>
        </div>
    </div>
    <div class="sidebar__item">
        <div class="sidebar__button  {{ request()->routeIs('dashboard.notifications.index') ? '-is-active' : '' }}">
            <a href="{{ route('dashboard.notifications.index') }}" class="d-flex items-center text-15 lh-1 fw-500">
                <i class="fas fa-bell mr-15"></i>
                Notification
            </a>
        </div>
    </div>

    @can(['create complain'])
        <div class="sidebar__item">
            <div class="sidebar__button ">
                <a href="{{ route('dashboard.settings') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="fas fa-cog mr-15"></i>
                    Settings
                </a>
            </div>
        </div>
    @endcan

    <div class="sidebar__item">
        <div class="sidebar__button ">
            <a href="javascript:void(0);" class="d-flex items-center text-15 lh-1 fw-500"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-15"></i>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
