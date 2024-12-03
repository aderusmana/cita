<aside class="left-sidebar with-horizontal">
    <!-- Sidebar scroll-->
    <div>
        <!-- Sidebar navigation-->
        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid mw-100">
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link " href="{{ route('dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:screencast-2-linear"
                            class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Apps -->
                <!-- ============================= -->
                @can('view data master')
                <li class="sidebar-item">
                    <a class="sidebar-link two-column has-arrow" href="javascript:void(0)"
                        aria-expanded="false">
                        <iconify-icon icon="solar:archive-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Master Data Management</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @can('view users master')
                            <li class="sidebar-item">
                                <a href="{{ route('users.index') }}" class="sidebar-link">
                                    <i class="ti ti-circle"></i>
                                    <span class="hide-menu">Users</span>
                                </a>
                            </li>
                        @endcan
                        @can('view category master')
                            <li class="sidebar-item">
                            <a href="{{ route('categories.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Category</span>
                                </a>
                            </li>
                        @endcan
                        @can('view department master')
                            <li class="sidebar-item">
                                <a href="{{ route('departments.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Departments</span>
                                </a>
                            </li>
                        @endcan
                        @can('view position master')
                            <li class="sidebar-item">
                                <a href="{{ route('positions.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Positions</span>
                                </a>
                            </li>
                        @endcan
                        @can('view level master')
                            <li class="sidebar-item">
                                <a href="{{ route('levels.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Levels</span>
                                </a>
                            </li>
                        @endcan
                        @can('view permission master')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Permissions</span>
                                </a>
                            </li>
                        @endcan
                        @can('view role master')
                            <li class="sidebar-item">
                                <a href="{{ route('roles.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('view section master')
                            <li class="sidebar-item">
                                <a href="{{ route('sections.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Sections</span>
                                </a>
                            </li>
                        @endcan
                        @can('view approver master')
                            <li class="sidebar-item">
                                <a href="{{ route('approvers.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
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
                    </ul>
                </li>
                @endcan
                <!-- ============================= -->
                <!-- PAGES -->
                <!-- ============================= -->
                @can('view idea')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="solar:programming-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Idea</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('ideas.index') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Wall of Ideas</span>
                            </a>
                        </li>
                        </ul>
                    </li>
                @endcan
                <!-- ============================= -->
                <!-- PAGES -->
                <!-- ============================= -->
                @can('view idea approval')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="solar:programming-linear" class="aside-icon"></iconify-icon>
                        <span class="hide-menu">Idea Approval</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('ideas.approvals') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Idea List Approval</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
