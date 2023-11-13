<!-- begin #header -->
<div id="header" class="header navbar navbar-{{ ConfigsHelper::getByKey('header_styling') }} {{ ConfigsHelper::getByKey('header')=='fixed'?'navbar-fixed-top':'' }}">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="{{ url('/') }}" class="navbar-brand" style="background-color: {{ ConfigsHelper::getByKey('header_styling')=='inverse'?'#2d353c':'#fff' }} !important; white-space: nowrap;">
                <img style="height: 32px !important;float: left;  margin-right: 10px;  margin-top: 0px;" class="navbar-logo-rcti-plus" src="{{ asset('assets/img/logo-banten.png') }}" data-id="navbar-banten-logo" alt="RCTI+ Logo" />{{ ConfigsHelper::getByKey('sitename') }}
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            @if(ConfigsHelper::getByKey('sidebar_search'))
            <li>
                <form class="navbar-form full-width">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter keyword" />
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>
            @endif
            @if(ConfigsHelper::getByKey('show_notifications'))
            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell-o"></i>
                </a>
            </li>
            @endif
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img id="img-header-avatar" src="{{ Auth::user()->avatar=='avatar.png'? asset('assets/img/'. Auth::user()->avatar) : url('files/profile/'. Auth::user()->avatar) }}" alt="Avatar" />
                    <span class="hidden-xs">{{ Auth::user()->name }}</span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="{{ route('settings.users.profile') }}">Edit Profile</a></li>
                    <li class="divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end #header -->