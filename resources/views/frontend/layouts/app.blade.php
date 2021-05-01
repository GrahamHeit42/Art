<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page_title ?? NULL }} - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @stack('stylesheets')
    @stack('styles')

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <div class="row">
                <div class="col-lg-2">
                    <div id="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/Logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(request()->path() === '/')
                        <div class="header-search-box">
                            <form action="">
                                <div class="form-group row">
                                    <i class="fa fa-search col-sm-2" aria-hidden="true"></i>
                                    <div class="col-sm-10">
                                        <input title="Search" type="text" class="form-control" id="search"
                                               placeholder="Search here...">
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    @guest()
                        <div class="header-dropdown">
                            <div class="profile">
                                <a class="btn gallery-btn-green" href="{{  url('register') }}">Register</a>
                                <a class="btn gallery-btn-green" href="{{  url('login') }}">Login</a>
                            </div>
                        </div>
                    @else
                        <div class="header-dropdown">
                            <div class="profile">
                                <a id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/icon/profile.svg') }}" alt="">
                                </a>
                                <div class="dropdown-menu profile_dropdown" aria-labelledby="profile">
                                    <ul>
                                        <li class="profile_li">
                                            <a class="" href="{{ url('profile') }}">
                                                <span class="">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                                Profile
                                            </a>
                                        </li>
                                        <li class="profile_li">
                                            <a class="" href="{{ url('settings') }}">
                                                <span class="">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                </span>
                                                Settings
                                            </a>
                                        </li>

                                        <li class="profile_li">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <span class="">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                </span>
                                                    Logout
                                                </a>
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="message">
                                <a href="" id="message" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <img src="{{ asset('assets/icon/message.svg') }}" alt="">
                                </a>
                                <div class="dropdown-menu message_dropdown" aria-labelledby="message">
                                    <ul>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="notification">
                                <a href="" id="notification" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <img src="{{ asset('assets/icon/notification.svg') }}" alt="">
                                </a>
                                <div class="dropdown-menu notification_dropdown" aria-labelledby="notification">
                                    <ul>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                Lorem, ipsum dolor.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="plus">
                                <a data-toggle="modal" data-target="#postUploadModal">
                                    <img src="{{ asset('assets/icon/plus.svg') }}" alt="">
                                </a>
                            </div>

                        </div>
                    @endguest
                </div>
            </div>
        </header>

        <div id="main">
            @yield('content')
        </div>

        <footer id="footer">
            <div class="row">
                <div class="col-lg-8">
                    <div class="usefull-link">
                        <ul>
                            <li>
                                <a href="{{ url('terms-and-conditions') }}">Terms and conditions</a>
                            </li>
                            <li>
                                <a href="{{ url('help-and-faqs') }}">Help & FAQ</a>
                            </li>
                            <li>
                                <a href="{{ url('contact-us') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="realeyze">
                        <p>©2021
                            <a href="#">Realeyze</a>
                            | Version {{ config('constants.app.version') }}
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- popup modal -->
    <div class="modal fade upload-popup" id="postUploadModal" tabindex="-1" role="dialog"
         aria-labelledby="postUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postUploadModalLabel">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="popup-btn">
                                <a href="javascript:" class="btn gallery-btn-green"
                                   onclick="myFunction()">Artist
                                </a>
                                <span>OR</span>
                                <a href="{{ url('posts/create/commissioner') }}" class="btn gallery-btn-dark-yellow">
                                    Commissioner
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="popup-option">
                                <a href="{{ url('posts/create/artist') }}" class="btn gallery-btn-dark-yellow">Personal</a>
                                <span>OR</span>
                                <a href="{{ url('posts/create/commissioner') }}" class="btn gallery-btn-dark-yellow">Commissioned</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal" data-targe="#postUploadModal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    @stack('scripts')

    <script src="{{ asset('assets/js/general.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>

    <script type="text/javascript">
        let toastrOptions = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(session()->has('success'))
        toastr.success("{{ session()->get('success') }}", 'Success', toastrOptions);
        @elseif(session()->has('error'))
        toastr.error('{{ session()->get('error') }}', 'Error', toastrOptions);
        @endif
    </script>

</body>
</html>
