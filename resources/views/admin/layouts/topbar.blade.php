<!-- ============================================================== -->
<!-- Topbar header -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="/assets/images/logo-icon.png" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img width="40px" height="40px" src="/assets/images/logo-light-icon.png" alt="homepage"
                         class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span  id="textlogo">
                         <!-- dark Logo text -->
                         <img width="108px" height="25px" src="/assets/images/logo-text.png" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo text -->
                         <img width="180px" height="40px" src="/assets/images/logo-light-text.png" class="light-logo"
                              alt="homepage"/>
                </span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                <li class="nav-item"><a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="ti-menu"></i></a></li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">

                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                class="mdi mdi-email"></i>
                        <div class="notify">
                            @if(count(Auth::user()->unreadNotifications))
                                <span class="heartbit"></span> <span class="point"></span>
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown"
                         aria-labelledby="2">
                        <ul>
                            <li>
                                @if($newnotes = count(Auth::user()->unreadNotifications))
                                    <div class="drop-title">You have {{$newnotes}} new notifications
                                        <br>
                                        <a class="text-danger" markAllRead href="#">
                                            <small>تعليم الكل كمقروء</small>
                                        </a>
                                    </div>
                                @else
                                    <div class="drop-title"> لا يوجد إشعارات</div>
                                @endif
                            </li>
                            @if($newnotes = count(Auth::user()->unreadNotifications))
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        @foreach(Auth::user()->unreadNotifications as $note)
                                            <a href="{{ $note->data['link'] }}" notification
                                               data-noteid="{{ $note->id }}">

                                                <div class="mail-contnet">
                                                    <h5 class="text-info">{{ $note->data['title'] }}</h5>
                                                    <span class="mail-desc">{{ $note->data['message'] }}</span>
                                                    </span>
                                                    <span class="time">{{ $note->created_at->diffForHumans() }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                            {{--<li>--}}
                            {{--<a class="nav-link text-center" href="{{ action('Admin\NotificationController@index') }}"> <strong>--}}
                            {{--All Notifications--}}
                            {{--</strong> <i class="fa fa-angle-left"></i> </a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><img src="/assets/images/users/1.jpg" alt="user"
                                                                       class="profile-pic"/></a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="/assets/images/users/1.jpg" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a data-logout href="javascript:void(0)"><i class="fa fa-power-off"></i> تسجيل
                                    الخروج</a>
                                <form action="/logout" method="post">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->