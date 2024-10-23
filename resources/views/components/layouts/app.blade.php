<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">
    <head>
        <!--  Title -->
        <title>{{ config('app.name', 'Laravel') }}{{ isset($title) ? ' | ' . $title : '' }}</title>
        <!--  Required Meta Tag -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="handheldfriendly" content="true" />
        <meta name="MobileOptimized" content="width" />
        <meta name="description" content="Mordenize" />
        <meta name="author" content="" />
        <meta name="keywords" content="Mordenize" />
        <meta name="url" content="{{ url('/') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--  Favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" />
        
        <!-- Core Css -->
        <link  id="themeColors"  rel="stylesheet" href="{{ asset('templates/mdrnz/css/styles.css') }}" />
        @stack('css')
    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader">
            <img src="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        {{-- <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <x-layouts.sidebar/>

            <!--  Main wrapper -->
            <div class="body-wrapper">
                <x-layouts.header/>

                <div class="container-fluid mw-100">
                    {{ $slot }}
                </div>
                    
                <div class="dark-transparent sidebartoggler"></div>
                <div class="dark-transparent sidebartoggler"></div>
            </div>
        </div>

        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                <img src="../../dist/images/logos/favicon.ico" alt="" class="img-fluid">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar=""  data-simplebar>
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span>
                        <i class="ti ti-apps"></i>
                        </span>
                        <span class="hide-menu">Apps</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level my-3">
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-message-box.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Email App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                            <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-lifebuoy.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-application.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                            </div>
                        </a>
                        </li>
                        <ul class="px-8 mt-7 mb-4">
                        <li class="sidebar-item mb-3">
                            <h5 class="fs-5 fw-semibold">Quick Links</h5>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Pricing Page</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Authentication Design</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Register Now</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">404 Error Page</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Notes App</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">User Application</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Account Settings</a>
                        </li>
                        </ul>
                    </ul>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-chat.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-message-dots"></i>
                        </span>
                        <span class="hide-menu">Chat</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-calendar.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-calendar"></i>
                        </span>
                        <span class="hide-menu">Calendar</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-email.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Email</span>
                    </a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        
        <!--  Search Bar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content rounded-1">
                <div class="modal-header border-bottom">
                    <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                    <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
                    <i class="ti ti-x fs-5 ms-3"></i>
                    </span>
                </div>
                <div class="modal-body message-body" data-simplebar="">
                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                    <ul class="list mb-0 py-2">
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Modern</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                        <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Posts</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Detail</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Shop</span>
                        <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Modern</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                        <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Posts</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Detail</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Shop</span>
                        <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </div> --}}
        
        <div id="main-wrapper">
            <x-layouts.sidebar/>
            <div class="page-wrapper">
                <x-layouts.header/>

                <x-layouts.sidebar-horizontal/>

                <div class="body-wrapper">
                    <div class="container-fluid mw-100">
                        {{ $slot }}
                    </div>
                </div>
                <script>
                    function handleColorTheme(e)
                    {
                        document.documentElement.setAttribute("data-color-theme", e);
                    }
                </script>
                <button
                    class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <i class="icon ti ti-settings fs-7"></i>
                </button>

                <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                            Settings
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body h-n80" data-simplebar>
                        <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary rounded-2" for="light-layout">
                                <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
                            </label>

                            <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary rounded-2" for="dark-layout">
                                <i class="icon ti ti-moon fs-7 me-2"></i>Dark
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="ltr-layout">
                                <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
                            </label>

                            <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="rtl-layout">
                                <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
                            </label>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                        <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                            <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="BLUE_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="AQUA_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="PURPLE_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="GREEN_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                                onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="CYAN_THEME">
                                <div
                                    class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                            </label>

                            <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
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
                                    autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                                    autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                                    <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="boxed-layout">
                                <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
                            </label>

                            <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="full-layout">
                                <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
                            </label>
                        </div>

                        <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <a href="javascript:void(0)" class="fullsidebar">
                                <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                    autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                                    <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
                                </label>
                            </a>
                            <div>
                                <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                    autocomplete="off" />
                                <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                                    <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
                                </label>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                        <div class="d-flex flex-row gap-3 customizer-box" role="group">
                            <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="card-with-border">
                                <i class="icon ti ti-border-outer fs-7 me-2"></i>Border
                            </label>

                            <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="card-without-border">
                                <i class="icon ti ti-border-none fs-7 me-2"></i>Shadow
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!--  Search Bar -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content rounded-1">
                        <div class="modal-header border-bottom">
                            <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                            <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                                <i class="ti ti-x fs-5 ms-3"></i>
                            </a>
                        </div>
                        <div class="modal-body message-body" data-simplebar="">
                            <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                            <ul class="list mb-0 py-2">
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Modern</span>
                                        <span class="text-muted d-block">/dashboards/dashboard1</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Dashboard</span>
                                        <span class="text-muted d-block">/dashboards/dashboard2</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Contacts</span>
                                        <span class="text-muted d-block">/apps/contacts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Posts</span>
                                        <span class="text-muted d-block">/apps/blog/posts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Detail</span>
                                        <span
                                            class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Shop</span>
                                        <span class="text-muted d-block">/apps/ecommerce/shop</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Modern</span>
                                        <span class="text-muted d-block">/dashboards/dashboard1</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Dashboard</span>
                                        <span class="text-muted d-block">/dashboards/dashboard2</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Contacts</span>
                                        <span class="text-muted d-block">/apps/contacts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Posts</span>
                                        <span class="text-muted d-block">/apps/blog/posts</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Detail</span>
                                        <span
                                            class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                                    </a>
                                </li>
                                <li class="p-1 mb-1 bg-hover-light-black">
                                    <a href="javascript:void(0)">
                                        <span class="d-block">Shop</span>
                                        <span class="text-muted d-block">/apps/ecommerce/shop</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>

        <!--  Import Js Files -->
        <script src="{{ asset('templates/mdrnz/js/vendor.min.js') }}" type="module"></script>
        <script src="{{ asset('templates/mdrnz/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="module"></script>
        <script src="{{ asset('templates/mdrnz/libs/simplebar/dist/simplebar.min.js') }}" type="module"></script>
        <!--  core files -->
        <script src="{{ asset('templates/mdrnz/js/theme/app.init.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/theme/theme.js') }}" ></script>
        <script src="{{ asset('templates/mdrnz/js/theme/app.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/theme/sidebarmenu.js') }}" type="module"></script>

        {{-- <script src="{{ asset('templates/mdrnz/js/custom.js') }}" type="module"></script> --}}
        
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js" type="module"></script>
        <script src="{{ asset('templates/mdrnz/js/plugins/toastr-init.js') }}" type="module"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="module">
            $(function(){
                @if ($message = Session::get('success'))
                    toastr.success("{{ $message }}", "Success");
                @endif

                @if ($message = Session::get('error'))
                  toastr.error("{{ $message }}", "Failed");
                @endif

                ajaxSetup()

                $(document).ajaxSuccess(function(e,x) {
                    var result = $.parseJSON(x.responseText);
                    $('meta[name=csrf-token]').attr('content', result._token);
                    ajaxSetup()
                });

                function ajaxSetup() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector("meta[name=csrf-token]").getAttribute('content')
                        },
                    });
                }
            })
        </script>
        <script>
            const baseUrl = document.querySelector('meta[name=url]').getAttribute('content')
        </script>
        @stack('script')
        @vite('resources/js/page/app.js')
    </body>
</html>