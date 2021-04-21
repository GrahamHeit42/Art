<div class="row">
    <div class="col-lg-2">
        <div id="logo">
            <a href="{{asset('/')}}">
                <img src="{{asset('images/Logo.png')}}" alt="Art Harbour" />
            </a>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="header-search-box">
            @if (request()->path() !== 'login' && request()->path() !== 'register')
                <form action="">
                    <div class="form-group row">
                        <i class="fa fa-search col-sm-2" aria-hidden="true"></i>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="search" placeholder="Search here...">
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        @if(empty(Auth::user()))
        <div class="header-dropdown">
            <div class="profile">
                <a class="btn gallery-btn-green" href="{{url('register')}}">Register
                </a>
                <a class="btn gallery-btn-green" href="{{url('login')}}">Login
                </a>
            </div>
        </div>
        @else
        <div class="header-dropdown">
            <div class="profile">
                <a id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="pointer">
                    <img src="{{asset('icon/profile.svg')}}" alt="">
                </a>
                <div class="dropdown-menu profile_dropdown" aria-labelledby="profile">
                    <ul>
                        <li class="profile_li">
                            <a class="" href="{{asset('profile')}}">
                                <span class="">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>Profile
                            </a>
                        </li>
                        <li class="profile_li">
                            <a class="" href="{{url('/logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </span>Logout
                            </a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="message">
                <a href="" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('icon/message.svg')}}" alt="">
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
                <a href="" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('icon/notification.svg')}}" alt="">
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
                <a data-toggle="modal" data-target="#exampleModal" class="pointer">
                    <img src="{{asset('icon/plus.svg')}}" alt="">
                </a>
            </div>
        </div>
        @endif
    </div>
</div>