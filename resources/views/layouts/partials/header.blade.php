<header class="topbar rounded-0 border-0 text-bg-primary">
    <div class="with-vertical"><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Header -->
        <!-- ---------------------------------- -->
        <nav class="navbar navbar-expand-lg px-lg-0 px-3 py-0">
            <div class="d-none d-lg-block">
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard') }}" class="text-nowrap logo-img d-flex align-items-center gap-2">
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->

                            <!-- Light Logo icon -->
                            <img src="{{ asset('assets') }}/images/logos/Logo Cita.png" style="width:100px;height:50px"
                                alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->

                    </a>
                </div>


            </div>

            <ul class="navbar-nav gap-2">

                <li class="nav-item nav-icon-hover-bg rounded-circle">
                    <a class="nav-link nav-icon-hover sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:list-bold"></iconify-icon>
                    </a>
                </li>
                <!-- ------------------------------- -->
                <!-- start notification Dropdown -->
                <!-- ------------------------------- -->
                {{-- <li class="nav-item d-none d-lg-block search-box nav-icon-hover-bg rounded-circle">
                    <a class="nav-link nav-icon-hover d-none d-md-flex waves-effect waves-dark"
                        href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                    </a>
                </li> --}}


                <li class="nav-item d-none d-lg-block dropdown nav-icon-hover-bg rounded-circle">
                    <a class="nav-link nav-icon-hover" id="drop2" href="javascript:void(0)" aria-haspopup="true"
                        aria-expanded="false">
                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                    </a>
                    <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden"
                        aria-labelledby="drop2">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="ps-3 pt-3">
                                    <div class="border-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <a href="https://sinarmeadow.com" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative ">
                                                        <div
                                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:chat-line-linear"
                                                                class="text-primary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block ">
                                                            <h6 class="mb-0 bg-hover-primary">Sinar Meadow Official</h6>

                                                        </div>
                                                    </a>
                                                    <a href="http://hris.sinarmeadow.com:8081/" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-secondary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:bill-list-linear"
                                                                class="text-secondary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Andal Linkage</h6>

                                                        </div>
                                                    </a>
                                                    <a href="https://emgmt.sinarmeadow.com/loginPage?next=/"
                                                        target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-success-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:bedside-table-2-linear"
                                                                class="text-success fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">E-Mgmt</h6>

                                                        </div>
                                                    </a>
                                                    <a href="https://wotix.sinarmeadow.com/login.php" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-warning-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">

                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Wotix</h6>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <a href="https://frontend.sinarmeadow.com/smii/login.php"
                                                        target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-danger-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:cart-large-2-linear"
                                                                class="text-danger fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Frontend</h6>

                                                        </div>
                                                    </a>
                                                    <a href="http://simcost.sinarmeadow.com/" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:calendar-linear"
                                                                class="text-primary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Sim Cost</h6>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>


            </ul>

            <div class="d-block d-lg-none">
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard') }}" class="text-nowrap logo-img d-flex align-items-center gap-2">
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('assets') }}/images/logos/Logo Cita.png" style="width:100px;height:50px"
                                alt="homepage" class="dark-logo">
                            <!-- Light Logo icon -->
                            <img src="{{ asset('assets') }}/images/logos/Logo Cita.png" style="width:100px;height:50px"
                                alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->
                    </a>
                </div>


            </div>
            <ul class="navbar-nav flex-row  gap-2 align-items-center justify-content-center d-flex d-lg-none">
                <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                    <a class="navbar-toggler nav-link text-white nav-icon-hover border-0" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="">
                            <i class="ti ti-dots fs-7"></i>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between py-2 py-lg-0">
                    <ul class="navbar-nav flex-row  align-items-center justify-content-center d-flex d-lg-none">
                        {{-- <li class="nav-item dropdown">
                            <a href="javascript:void(0)"
                                class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                aria-controls="offcanvasWithBothOptions">
                                <iconify-icon icon="solar:menu-dots-circle-linear"></iconify-icon>
                            </a>
                        </li> --}}
                        <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle">
                            <a class="nav-link nav-icon-hover waves-effect waves-dark" href="javascript:void(0)"
                                id="drop2" aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>
                                <div class="notify">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up overflow-hidden"
                                aria-labelledby="drop2">

                                <div class="py-3 px-4 bg-primary">
                                    <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                    <div class="mb-0 fs-2 fw-medium text-white">You have
                                        {{ auth()->user()->unreadNotifications->count() ?? 0 }} Notifications</div>
                                </div>
                                <div class="message-body" data-simplebar="">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <a href="javascript:void(0)"
                                            class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                            <span
                                                class="flex-shrink-0 bg-primary-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-primary">
                                                {{ substr(auth()->user()->where('id', $notification->data['user_id'])->first()->name,0,1) }}
                                            </span>
                                            <div class="w-80">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="mb-1">{{ $notification->data['data']['title'] }}</h6>
                                                    <span
                                                        class="fs-2 d-block text-muted ">{{ $notification->created_at->format('H:i') }}</span>
                                                </div>
                                                <span
                                                    class="fs-2 d-block text-truncate text-muted">{{ $notification->data['data']['message'] }}
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="p-3">
                                    <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                        href="javascript:void(0);">
                                        <span class="mark-as-read-all">Mark all as read</span>
                                        <iconify-icon icon="solar:alt-arrow-right-outline"
                                            class="iconify-sm"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav gap-2 flex-row ms-auto align-items-center justify-content-center">

                        <li class="nav-item nav-icon-hover-bg rounded-circle">
                            <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon"></iconify-icon>
                            </a>
                            <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun"></iconify-icon>
                            </a>
                        </li>

                        <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle d-none d-lg-block">
                            <a class="nav-link nav-icon-hover waves-effect waves-dark" href="javascript:void(0)"
                                id="drop2" aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>
                                <div class="notify">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up dropdown-menu-end overflow-hidden"
                                aria-labelledby="drop2">

                                <div class="py-3 px-4 bg-primary">
                                    <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                    <div class="mb-0 fs-2 fw-medium text-white">You have
                                        {{ auth()->user()->unreadNotifications->count() ?? 0 }} Notifications</div>
                                </div>
                                <div class="message-body" data-simplebar="">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <a href="javascript:void(0)"
                                            class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom">
                                            <span
                                                class="flex-shrink-0 bg-primary-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-primary">
                                                {{ substr(auth()->user()->where('id', $notification->data['user_id'])->first()->name,0,1) }}
                                            </span>
                                            <div class="w-80">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="mb-1">{{ $notification->data['data']['title'] }}</h6>
                                                    <span
                                                        class="fs-2 d-block text-muted ">{{ $notification->created_at->format('H:i') }}</span>
                                                </div>
                                                <span
                                                    class="fs-2 d-block text-truncate text-muted">{{ $notification->data['data']['message'] }}
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="p-3">
                                    <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                        href="javascript:void(0);">
                                        <span class="mark-as-read-all">Mark all as read</span>
                                        <iconify-icon icon="solar:alt-arrow-right-outline"
                                            class="iconify-sm"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item hover-dd dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                aria-expanded="false">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}"
                                        alt="Avatar" class="profile-pic rounded-circle round-30">
                                @else
                                    <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="Avatar"
                                        class="profile-pic rounded-circle round-30">
                                @endif
                            </a>
                            <div class="dropdown-menu pt-0 content-dd overflow-hidden dropdown-menu-end user-dd"
                                aria-labelledby="drop2">
                                <div class="profile-dropdown position-relative" data-simplebar="">
                                    <div class=" py-3 border-bottom">
                                        <div class="d-flex align-items-center px-3">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}"
                                                    alt="user" class="rounded-circle round-50">
                                            @else
                                                <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}"
                                                    alt="user" class="rounded-circle round-50">
                                            @endif
                                            <div class="ms-3">
                                                <h5 class="mb-1 fs-4">{{ Auth::user()->name }}</h5>
                                                <p class="mb-0 fs-2 d-flex align-items-center text-muted">
                                                    {{ Auth::user()->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-body pb-1">
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('ideas.my') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Ideas
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('ideas.my_ideaLikes') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Favorite Ideas
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('profile.edit') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Profile
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div
                                                class="py-8 px-3 d-flex justify-content-between dropdown-item align-items-center h6 mb-0  rounded-2 link">
                                                <a href="javascript:void(0)" class="">
                                                    Mode
                                                </a>
                                                <div>
                                                    <a class="moon dark-layout" href="javascript:void(0)">
                                                        <iconify-icon icon="solar:moon-line-duotone"
                                                            class="moon"></iconify-icon>
                                                    </a>
                                                    <a class="sun light-layout" href="javascript:void(0)">
                                                        <iconify-icon icon="solar:sun-2-line-duotone"
                                                            class="sun"></iconify-icon>
                                                    </a>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                                    class="h6 mb-0 dropdown-item d-flex justify-content-start py-8 rounded-2 link cursor-pointer">
                                                    <i class="fa fa-sign-out me-3 text-xl"></i>
                                                    Log Out
                                                </a>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>


                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- ---------------------------------- -->
        <!-- End Vertical Layout Header -->
        <!-- ---------------------------------- -->

        <!-- ------------------------------- -->
        <!-- apps Dropdown in Small screen -->
        <!-- ------------------------------- -->
        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
            aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                    <a href="{{ route('profile.edit') }}" class="text-nowrap logo-img d-block">
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('assets') }}/images/logos/logowhite.png" alt="homepage"
                                style="width: 100px">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- Light Logo text -->
                            <img src="{{ asset('assets') }}/images/logos/Logo Cita.png"
                                style="width:100px;height:50px" class="light-logo ps-2" alt="homepage">
                        </span>
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow px-1" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <iconify-icon icon="solar:shield-plus-outline" class="fs-6"></iconify-icon>
                                </span>
                                <span class="hide-menu">Apps</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level my-3">
                                <li class="sidebar-item py-2">
                                    <a href="https://sinarmeadow.com" target="_blank"
                                        class="d-flex align-items-center position-relative ">
                                        <div
                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:chat-line-linear"
                                                class="text-primary fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block ">
                                            <h6 class="mb-0 bg-hover-primary">Sinar Meadow Official</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="http://hris.sinarmeadow.com:8081/" target="_blank"
                                        class="d-flex align-items-center position-relative">
                                        <div
                                            class="bg-secondary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:bill-list-linear"
                                                class="text-secondary fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Andal Linkage</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://emgmt.sinarmeadow.com/loginPage?next=/" target="_blank"
                                        class="d-flex align-items-center position-relative">
                                        <div
                                            class="bg-success-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:bedside-table-2-linear"
                                                class="text-success fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">E-Mgmt</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://wotix.sinarmeadow.com/login.php" target="_blank"
                                        class="d-flex align-items-center position-relative">
                                        <div
                                            class="bg-warning-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:letter-unread-linear"
                                                class="text-warning fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Wotix</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="https://frontend.sinarmeadow.com/smii/login.php" target="_blank"
                                        class="d-flex align-items-center position-relative">
                                        <div
                                            class="bg-danger-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:cart-large-2-linear"
                                                class="text-danger fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Frontend</h6>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="http://simcost.sinarmeadow.com/" target="_blank"
                                        class="d-flex align-items-center position-relative">
                                        <div
                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:calendar-linear"
                                                class="text-primary fs-5"></iconify-icon>
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-0 bg-hover-primary">Sim Cost</h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="app-header with-horizontal">
        <nav class="navbar navbar-expand-xl container-fluid mw-100">
            <ul class="navbar-nav gap-2 align-items-center">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone"></iconify-icon>
                    </a>
                </li>
                <li class="nav-item d-none d-xl-block">
                    <div class="brand-logo d-flex align-items-center justify-content-between">
                        <a href="{{ route('dashboard') }}"
                            class="text-nowrap logo-img d-flex align-items-center gap-2">
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="{{ asset('assets') }}/images/logos/Logo Cita.png"
                                    style="width:100px;height:50px" alt="homepage" class="dark-logo">
                                <!-- Light Logo icon -->
                                <img src="{{ asset('assets') }}/images/logos/Logo Cita.png"
                                    style="width:100px;height:50px" alt="homepage" class="light-logo">
                            </b>
                            <!--End Logo icon -->
                        </a>
                    </div>



                </li>

                <li class="nav-item d-none d-lg-block search-box">
                    <a class="nav-link nav-icon-hover d-none d-md-flex waves-effect waves-dark"
                        href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    </a>
                </li>

                <li class="nav-item hover-dd d-none d-lg-block dropdown">
                    <a class="nav-link nav-icon-hover" id="drop2" href="javascript:void(0)" aria-haspopup="true"
                        aria-expanded="false">
                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                    </a>
                    <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0 overflow-hidden"
                        aria-labelledby="drop2">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="ps-3 pt-3">
                                    <div class="border-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <a href="https://sinarmeadow.com" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative ">
                                                        <div
                                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:chat-line-linear"
                                                                class="text-primary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block ">
                                                            <h6 class="mb-0 bg-hover-primary">Sinar Meadow Official
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <a href="http://hris.sinarmeadow.com:8081/" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-secondary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:bill-list-linear"
                                                                class="text-secondary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Andal Linkage</h6>
                                                        </div>
                                                    </a>
                                                    <a href="https://emgmt.sinarmeadow.com/loginPage?next=/"
                                                        target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-success-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:bedside-table-2-linear"
                                                                class="text-success fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">E-Mgmt</h6>
                                                        </div>
                                                    </a>
                                                    <a href="https://wotix.sinarmeadow.com/login.php" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-warning-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:letter-unread-linear"
                                                                class="text-warning fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Wotix</h6>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="position-relative">
                                                    <a href="https://frontend.sinarmeadow.com/smii/login.php"
                                                        target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-danger-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:cart-large-2-linear"
                                                                class="text-danger fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Frontend</h6>
                                                        </div>
                                                    </a>
                                                    <a href="http://simcost.sinarmeadow.com/" target="_blank"
                                                        class="d-flex align-items-center pb-9 position-relative">
                                                        <div
                                                            class="bg-primary-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="solar:calendar-linear"
                                                                class="text-primary fs-5"></iconify-icon>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <h6 class="mb-0 bg-hover-primary">Sim Cost</h6>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>


            <a class="navbar-toggler nav-icon-hover p-0 border-0 text-white" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav gap-2 flex-row ms-auto align-items-center justify-content-center">
                        <li class="nav-item nav-icon-hover-bg rounded-circle">
                            <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:moon-line-duotone" class="moon"></iconify-icon>
                            </a>
                            <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
                                <iconify-icon icon="solar:sun-2-line-duotone" class="sun"></iconify-icon>
                            </a>
                        </li>



                        <li class="nav-item hover-dd dropdown nav-icon-hover-bg rounded-circle  d-none d-lg-block">
                            <a class="nav-link nav-icon-hover waves-effect waves-dark" href="javascript:void(0)"
                                id="drop2" aria-expanded="false">
                                <iconify-icon icon="solar:bell-bing-line-duotone"></iconify-icon>
                                <div class="notify">
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu py-0 content-dd  dropdown-menu-animate-up dropdown-menu-end overflow-hidden"
                                aria-labelledby="drop2">

                                <div class="py-3 px-4 bg-primary">
                                    <div class="mb-0 fs-6 fw-medium text-white">Notifications</div>
                                    <div class="mb-0 fs-2 fw-medium text-white">
                                        You have <span
                                            id="notificationCount">{{ auth()->user()->unreadNotifications->count() ?? 0 }}</span>
                                        Notifications
                                    </div>
                                </div>
                                <div class="message-body notif" data-simplebar="">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <button type="button"
                                            class="p-3 d-flex align-items-center dropdown-item gap-3 border-bottom mark-as-read"
                                            data-id="{{ $notification->id }}">
                                            <span
                                                class="flex-shrink-0 bg-primary-subtle rounded-circle round-40 d-flex align-items-center justify-content-center fs-6 text-primary">
                                                {{ substr(auth()->user()->where('id', $notification->data['user_id'])->first()->name,0,1) }}
                                            </span>
                                            <div class="w-80">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="mb-1">{{ $notification->data['data']['title'] }}
                                                    </h6>
                                                    <span
                                                        class="fs-2 d-block text-muted ">{{ $notification->created_at->format('H:i') }}</span>
                                                </div>
                                                <span
                                                    class="fs-2 d-block text-truncate text-muted">{{ $notification->data['data']['message'] }}
                                                </span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                                <div class="p-3">
                                    <a class="d-flex btn btn-primary  align-items-center justify-content-center gap-2"
                                        href="javascript:void(0);">
                                        <span class="mark-as-read-all">Mark all as read</span>
                                        <iconify-icon icon="solar:alt-arrow-right-outline"
                                            class="iconify-sm"></iconify-icon>
                                    </a>
                                </div>
                            </div>
                        </li>


                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        <li class="nav-item hover-dd dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                aria-expanded="false">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}"
                                        alt="Avatar" width="30" class="profile-pic rounded-circle">
                                @else
                                    <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="Avatar"
                                        width="30" class="profile-pic rounded-circle">
                                @endif
                            </a>
                            <div class="dropdown-menu content-dd overflow-hidden pt-0 dropdown-menu-end user-dd"
                                aria-labelledby="drop2">
                                <div class="profile-dropdown position-relative" data-simplebar="">
                                    <div class=" py-3 border-bottom">
                                        <div class="d-flex align-items-center px-3">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}"
                                                    alt="Avatar" class="rounded-circle round-50">
                                            @else
                                                <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}"
                                                    alt="Avatar" class="rounded-circle round-50">
                                            @endif
                                            <div class="ms-3">
                                                <h5 class="mb-1 fs-4">{{ Auth::user()->name }}</h5>
                                                <p class="mb-0 fs-2 d-flex align-items-center text-muted">
                                                    {{ Auth::user()->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-body pb-1">
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('ideas.my') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Ideas
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('ideas.my_ideaLikes') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Favorite Ideas
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div class="h6 mb-0 dropdown-item py-2 px-3 rounded-2 link">
                                                <a href="{{ route('profile.edit') }}"
                                                    class=" d-flex  align-items-center ">
                                                    My Profile
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="px-3">
                                            <div
                                                class="py-8 px-3 d-flex justify-content-between dropdown-item align-items-center h6 mb-0  rounded-2 link">
                                                <a href="javascript:void(0)" class="">
                                                    Mode
                                                </a>
                                                <div>
                                                    <a class="moon dark-layout" href="javascript:void(0)">
                                                        <iconify-icon icon="solar:moon-line-duotone"
                                                            class="moon"></iconify-icon>
                                                    </a>
                                                    <a class="sun light-layout" href="javascript:void(0)">
                                                        <iconify-icon icon="solar:sun-2-line-duotone"
                                                            class="sun"></iconify-icon>
                                                    </a>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                                    class="h6 mb-0 dropdown-item d-flex justify-content-start py-8 rounded-2 link cursor-pointer">
                                                    <i class="fa fa-sign-out me-3 text-xl"></i>
                                                    Log Out
                                                </a>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const htmlElement = document.documentElement;
            const darkModeStorage = localStorage.getItem('darkMode');

            // Function to set dark mode
            const setDarkMode = (darkModeOn) => {
                htmlElement.setAttribute('data-bs-theme', darkModeOn ? 'dark' : 'light');
                localStorage.setItem('darkMode', darkModeOn ? 'enabled' : 'disabled');
            };

            // Initialize dark mode based on stored preference
            if (darkModeStorage === 'enabled') {
                setDarkMode(true);
            } else {
                setDarkMode(false);
            }

            // Event listeners for mode icons
            const moonIcon = document.querySelector('.moon');
            const sunIcon = document.querySelector('.sun');

            if (moonIcon && sunIcon) {
                moonIcon.addEventListener('click', function() {
                    setDarkMode(false);
                });

                sunIcon.addEventListener('click', function() {
                    setDarkMode(true);
                });
            } else {
                console.error('Moon or Sun icon not found!');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk memperbarui jumlah notifikasi
            function updateNotificationCount() {
                fetch('{{ route('notifications.count') }}')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('notificationCount').textContent = data.count;
                    })
                    .catch(error => console.error('Error:', error));
            }

            const messageBody = document.querySelector('.message-body.notif');

                if (messageBody) {
                    console.log('Message body found, adding event listener.');
                    messageBody.addEventListener('click', function(event) {
                        console.log('Click event detected.');
                        const target = event.target.closest(
                        '.mark-as-read'); // Use closest to ensure correct element
                        if (target) {
                            console.log('Mark as read button clicked.');
                            const notificationId = target.getAttribute('data-id');
                            console.log('Notification ID:', notificationId);

                            fetch('{{ route('notifications.markAsRead') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        notification_id: notificationId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Response data:', data);
                                    if (data.success) {
                                        target.remove();
                                        const notificationCountElement = document
                                            .getElementById('notificationCount');
                                        let currentCount = parseInt(notificationCountElement
                                            .textContent);
                                        notificationCountElement.textContent = currentCount - 1;
                                    } else {
                                        alert('Failed to mark notification as read.');
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            console.log('Clicked element is not a mark-as-read button.');
                    }
                });
            } else {
                console.error('Message body not found.');
            }
            // Dapatkan semua elemen dengan kelas .mark-as-read-all
            const markAsReadAllButtons = document.querySelectorAll('.mark-as-read-all');

                // Tambahkan event listener ke setiap elemen
                markAsReadAllButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        // Mencegah event bubbling yang mungkin menutup dropdown
                        event.stopPropagation();
                        console.log('Mark all as read button clicked.');

                        // Logika untuk menandai semua notifikasi sebagai dibaca
                        fetch('{{ route('notifications.markAllAsRead') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Response data:', data);
                                if (data.success) {
                                    // Hapus semua elemen notifikasi dari DOM
                                    document.querySelectorAll(
                                        '.message-body.notif button').forEach(
                                        button => button.remove());

                                    // Update jumlah notifikasi
                                    const notificationCountElement = document
                                        .getElementById('notificationCount');
                                    notificationCountElement.textContent =
                                    0; // Set jumlah notifikasi menjadi 0

                                    // Tampilkan pesan sukses tanpa alert
                                    const successMessage = document.createElement(
                                    'div');
                                    successMessage.textContent =
                                        'All notifications have been marked as read.';
                                    successMessage.classList.add('alert',
                                        'alert-success');
                                    document.body.appendChild(successMessage);
                                    setTimeout(() => successMessage.remove(),
                                    3000); // Hapus pesan setelah 3 detik
                                } else {
                                    alert('Failed to mark all notifications as read.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            });
    </script>
</header>
