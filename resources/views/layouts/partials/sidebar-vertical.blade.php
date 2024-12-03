<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <!-- Sidebar scroll-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <!-----------Profile------------------>
            <div class="user-profile position-relative"
                style="background: url({{ asset('frontend/assets/images/logo/pic.jpg') }}) no-repeat; background-size: cover; width: 300px;">
                <!-- User profile image -->
                <div class="profile-img">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}" alt="user" class="w-100 rounded-circle overflow-hidden">
                    @else
                        <img src="{{ asset('assets/images/logos/sinarmeadow.png') }}" alt="user" class="w-100 rounded-circle overflow-hidden">
                    @endif
                </div>
                <!-- User profile text-->
                <div class="profile-text hide-menu pt-1 dropdown">
                    <a href="javascript:void(0)"
                        class="dropdown-toggle u-dropdown w-100 text-white
                            d-block
                            position-relative
                        "
                        id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item d-flex gap-2" href="{{ route('ideas.my') }}">
                            <i data-feather="user" class="feather-sm text-info "></i>
                            My Ideas
                        </a>
                        <a class="dropdown-item d-flex gap-2" href="{{ route('profile.edit') }}">
                            <i data-feather="user" class="feather-sm text-info "></i>
                            My Profile
                        </a>
                        <a class="dropdown-item d-flex gap-2" href="{{ route('ideas.my_ideaLikes') }}">
                            <i data-feather="user" class="feather-sm text-info "></i>
                            My Favorite Ideas
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="dropdown-item d-flex gap-2">
                                <i data-feather="log-out" class="feather-sm text-danger"></i>
                                Logout
                            </a>
                        </form>
                        {{-- <div class="dropdown-divider"></div>
                        <div class="px-3 py-2">
                            <a href="page-user-profile.html"
                                class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-----------Profile End------------------>

            <ul id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" id="get-url">
                        <iconify-icon icon="solar:screencast-2-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- ---------------------------------- -->
                <!-- Master Data  -->
                <!-- ---------------------------------- -->
                @can('view data master')
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Master Data</span>
                </li>
                @endcan
                @can('view users master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.index') }}">
                        <iconify-icon icon="solar:calendar-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                @endcan
                @can('view category master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('categories.index') }}">
                        <iconify-icon icon="solar:notes-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                @endcan
                @can('view department master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('departments.index') }}">
                        <iconify-icon icon="solar:chat-line-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Departments</span>
                    </a>
                </li>
                @endcan
                @can('view position master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('positions.index') }}">
                        <iconify-icon icon="solar:letter-unread-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Positions</span>
                    </a>
                </li>
                @endcan
                @can('view level master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('levels.index') }}">
                        <iconify-icon icon="solar:palette-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Levels</span>
                    </a>
                </li>
                @endcan
                @can('view permission master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('permissions.index') }}">
                        <iconify-icon icon="solar:bedside-table-2-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Permissions</span>
                    </a>
                    </li>
                @endcan
                @can('view role master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('roles.index') }}">
                        <iconify-icon icon="solar:list-check-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Roles</span>
                    </a>
                </li>
                @endcan
                @can('view section master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('sections.index') }}">
                        <iconify-icon icon="solar:list-check-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Sections</span>
                    </a>
                </li>
                @endcan
                @can('view approver master')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('approvers.index') }}">
                        <iconify-icon icon="solar:list-check-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Approvers</span>
                    </a>
                </li>
                @endcan

                @can('view target master')
                <li class="sidebar-item">
                    <a href="{{ route('targets.index') }}" class="sidebar-link">
                        <i class="ti ti-circle"></i>
                        <span class="hide-menu">Target</span>
                    </a>
                </li>
                @endcan
                <!-- ---------------------------------- -->
                <!-- Idea Data  -->
                <!-- ---------------------------------- -->
                @can('view idea')
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Idea Data</span>
                </li>
                @endcan
                @can('view idea')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('ideas.index') }}">
                        <iconify-icon icon="solar:calendar-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Wall of Ideas</span>
                    </a>
                </li>
                @endcan
                <!-- ---------------------------------- -->
                <!-- Idea Approval  -->
                <!-- ---------------------------------- -->
                @can('view idea approval')
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Idea Approval</span>
                </li>
                @endcan
                @can('view idea approval')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('ideas.approvals') }}">
                        <iconify-icon icon="solar:calendar-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">List Idea Approval</span>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>

        <!-- End Sidebar scroll-->
    </div>
</aside>
