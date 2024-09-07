@php
  $appSetting =  App\Models\AppSetting::first();
@endphp
   <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('dashboard')}}" class="brand-logo">
                <img class="logo-abbr" src="{{asset('uploads/logo')}}/{{$appSetting ? $appSetting->logoIcon : ''}}" alt="">
                <img class="logo-compact" src="{{asset('uploads/logo')}}/{{$appSetting ? $appSetting->logoText : ''}}" alt="">
                <img class="brand-title" src="{{asset('uploads/logo')}}/{{$appSetting ? $appSetting->logoText : ''}}" alt="">
            </a>
            {{-- <a href="index.html" class="brand-logo">

                <img class="logo-abbr "   src="{{asset('dashboard_assets/images/logo-text.png')}}" alt="">

                <img class="logo-compact" src="{{asset('dashboard_assets/images/logo-text.png')}}" alt="">
                <p class="brand-title">Hennry </p>
            </a> --}}

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            {{-- <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div> --}}
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown text-dark">
                               {{ Auth::user()->name }}
                          


                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.index') }}" class="dropdown-item border-bottom ">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    {{-- <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a> --}}

                                    <a class="dropdown-item mt-1 " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="icon-logout"> </i>  <span class="ml-2">Logout </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->


