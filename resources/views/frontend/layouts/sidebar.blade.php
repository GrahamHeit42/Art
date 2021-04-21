<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- favicon  -->
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- plugins  -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}" />
    <!-- main css  -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontcustom.css')}}">
    <!-- Toastr -->
    <script src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet" />
    <script src="{{asset('js/toastr.js')}}"></script>
    @yield('page-header')
</head>

<body>
    <div id="wrapper">
        <!-- Header  -->
        <header id="header">
            @include('frontend.layouts.header')
        </header>
        <!-- Header  -->
        <!-- Main section css  -->
        @yield('content')
        <!-- Main section css  -->
        <!-- Footer  -->
        <footer id="footer">
            @include('frontend.layouts.footer')
        </footer>
        <!-- Footer  -->
    </div>
    <!-- popup modal  -->
    <!-- popup modal -->
    <div class="modal fade upload-popup" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="popup-btn">
                                <a href="#" class="btn gallery-btn-green" onclick="myFunction()">Artist</a>
                                <span>OR</span>
                                <a href="{{url('commissioner/create')}}" class="btn gallery-btn-dark-yellow">Commissioner</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="popup-option">
                                <a href="{{url('artist-personal/create')}}" class="btn gallery-btn-dark-yellow">Personal</a>
                                <span>OR</span>
                                <a href="{{url('artist-commissioned/create')}}" class="btn gallery-btn-dark-yellow">Commissioned</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- plugins -->
    <script src="{{asset('plugins/jquery/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="{{asset('plugins/pooper/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('js/general.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    @yield('page-footer')
    @if(session()->has('status'))
    <script type="text/javascript">
        toastr.success('<?php echo session()->get('status'); ?>')
    </script>
    @endif
    @if(session()->has('success'))
    <script type="text/javascript">
        toastr.success('<?php echo session()->get('success'); ?>')
    </script>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
        toastr.error('{{$error}}')
    </script>
    @endforeach
    @endif
</body>

</html>