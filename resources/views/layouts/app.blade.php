<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('frontend/assets/images/logo/sinarmeadow.png') }}">


    <title>{{ 'CITA SMII' }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- Scripts -->
    @stack('css')
    {{-- @vite(['resources/js/app.js']) --}}

</head>

<body>
    <!-- Preloader -->
    <div class="preloader"
        style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/images/logos/preload.gif') }}" alt="loader" class=""
                style="width: 800px">
        </div>
    </div>
    <div id="main-wrapper" class="auth-customizer-none">
        @include('sweetalert::alert')

        <!-- Sidebar Start -->
        @include('layouts.partials.sidebar-vertical')
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Header Start -->
            @include('layouts.partials.header')
            <!--  Header End -->
            {{-- sidebar horizontal --}}
             @include('layouts.partials.sidebar-horizontal')
              {{-- end sidebar horizontal --}}
            <div class="body-wrapper">
                <div class="container-fluid mw-100">
                    {{ $slot }}
                </div>
            </div>
            <script>
                function handleColorTheme(e) {
                    $("html").attr("data-color-theme", e);
                    $(e).prop("checked", !0);
                }
            </script>
            <button
                class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="icon ti ti-settings fs-7 text-white"></i>
            </button>

            {{-- <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                        Settings
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar="">
                    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check light-layout " name="theme-layout"
                            id="light-layout" autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="light-layout"> <iconify-icon
                                icon="solar:sun-2-outline" class="icon fs-7 me-2"></iconify-icon>Light</label>
                        <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="dark-layout"><iconify-icon
                                icon="solar:moon-outline" class="icon fs-7 me-2"></iconify-icon>Dark</label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="direction-l" id="ltr-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="ltr-layout"><iconify-icon
                                icon="solar:align-left-linear" class="icon fs-7 me-2"></iconify-icon>LTR</label>

                        <input type="radio" class="btn-check" name="direction-l" id="rtl-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="rtl-layout">
                            <iconify-icon icon="solar:align-right-linear" class="icon fs-7 me-2"></iconify-icon>RTL
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                        <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="BLUE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="AQUA_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="PURPLE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout"
                            id="green-theme-layout" autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Green_Theme')" for="green-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                            autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout"
                            id="orange-theme-layout" autocomplete="off">
                        <label
                            class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center rounded"
                            onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="vertical-layout">
                                <iconify-icon icon="solar:slider-vertical-minimalistic-linear"
                                    class="icon fs-7 me-2"></iconify-icon>Vertical
                            </label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="horizontal-layout">
                                <iconify-icon icon="solar:slider-minimalistic-horizontal-outline"
                                    class="icon fs-7 me-2"></iconify-icon>
                                Horizontal
                            </label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="layout" id="boxed-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="boxed-layout">
                            <iconify-icon icon="solar:cardholder-linear" class="icon fs-7 me-2"></iconify-icon>
                            Boxed
                        </label>

                        <input type="radio" class="btn-check" name="layout" id="full-layout"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="full-layout">
                            <iconify-icon icon="solar:scanner-linear" class="icon fs-7 me-2"></iconify-icon> Full
                        </label>
                    </div>

                    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <a href="javascript:void(0)" class="fullsidebar">
                            <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="full-sidebar"><iconify-icon
                                    icon="solar:sidebar-minimalistic-outline" class="icon fs-7 me-2"></iconify-icon>
                                Full</label>
                        </a>
                        <div>
                            <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                autocomplete="off">
                            <label class="btn p-9 btn-outline-primary rounded" for="mini-sidebar">
                                <iconify-icon icon="solar:siderbar-outline"
                                    class="icon fs-7 me-2"></iconify-icon>Collapse
                            </label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="card-with-border"><iconify-icon
                                icon="solar:library-broken" class="icon fs-7 me-2"></iconify-icon>Border</label>

                        <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                            autocomplete="off">
                        <label class="btn p-9 btn-outline-primary rounded" for="card-without-border">
                            <iconify-icon icon="solar:box-outline " class="icon fs-7 me-2"></iconify-icon>Shadow
                        </label>
                    </div>
                </div>
            </div> --}}

            <script>
                function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
                }
            </script>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>
    <!-- Import Js Files -->
    {{-- <script src="{{ asset('assets') }}/js/breadcrumb/breadcrumbChart.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/libs/apexcharts/dist/apexcharts.min.js"></script> --}}
    <script src="{{ asset('assets') }}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/js/theme/app.horizontal.init.js"></script>
    <script src="{{ asset('assets') }}/js/theme/theme.js"></script>
    <script src="{{ asset('assets') }}/js/theme/app.min.js"></script>
    <script src="{{ asset('assets') }}/js/theme/sidebarmenu.js"></script>
    <script src="{{ asset('assets') }}/js/theme/feather.min.js"></script>

    <!-- solar icons -->
    <script src="{{ asset('assets') }}/npm/iconify-icon%401.0.8/dist/iconify-icon.min.js"></script>

    @stack('scripts')
</body>

</html>
