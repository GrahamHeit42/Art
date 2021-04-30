<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @stack('stylesheets')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('admin') }}" class="brand-link">
                <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }}"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset(auth()->user()->profile_image ?? 'admin/dist/img/user2-160x160.jpg') }}"
                             class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->display_name ?? null }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : NULL }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MASTERS</li>
                        <li class="nav-item has-treeview {{ (request()->is('admin/subjects*') || request()->is('admin/mediums*')) ? 'active menu-is-opening menu-open' : NULL }}">
                            <a href="#" class="nav-link {{ (request()->is('admin/subjects*') || request()->is('admin/mediums*')) ? 'active' : NULL }}">
                                <i class="nav-icon fas fa-chart-pie text-info"></i>
                                <p>
                                    Masters
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/subjects') }}" class="nav-link {{ request()->is('admin/subjects*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Subjects</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/mediums') }}" class="nav-link {{ request()->is('admin/mediums*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mediums</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">MODULES</li>
                        <li class="nav-item has-treeview {{ (request()->is('admin/users*') || request()->is('admin/posts*')) ? 'active menu-is-opening menu-open' : NULL }}">
                            <a href="#" class="nav-link {{ (request()->is('admin/users*') || request()->is('admin/posts*')) ? 'active' : NULL }}">
                                <i class="nav-icon fas fa-chart-pie text-success"></i>
                                <p>
                                    Modules
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/posts') }}" class="nav-link {{ request()->is('admin/posts*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Posts</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">OTHER</li>
                        <li class="nav-item has-treeview {{ (request()->is('admin/pages*') || request()->is('admin/settings*')) ? 'active menu-is-opening menu-open' : NULL }}">
                            <a href="#" class="nav-link {{ (request()->is('admin/pages*') || request()->is('admin/settings*')) ? 'active' : NULL }}">
                                <i class="nav-icon fas fa-chart-pie text-danger"></i>
                                <p>
                                    OTHERS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/pages') }}" class="nav-link {{ request()->is('admin/pages*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pages</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/settings') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : NULL }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Settings</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" style="position: fixed; bottom: 0;">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Logout
                                    {{-- <span class="right badge badge-danger">New</span>--}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $page_title ?? NULL }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $page_title ?? NULL }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                {{-- MAIN CONTENT --}}
                @yield('content')
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }}
                <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
                .
            </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> {{ config('constants.app.version') }}
            </div>
        </footer>
    </div>

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('admin/dist/js/pages/dashboard3.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        const BASE_URL = '{{ url("admin") }}';
        const ASSET_URL = '{{ asset("/") }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
