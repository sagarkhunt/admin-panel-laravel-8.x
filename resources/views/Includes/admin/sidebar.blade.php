<div class="media user-profile mt-2 mb-2">
    @if(file_exists(storage_path('app/public/user/'.Auth::user()->profile_picture)) && Auth::user()->profile_picture != '')

        <img src="{{URL::to('storage/app/public/user/'.Auth::user()->profile_picture)}}" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
    @else
        <img src="{{URL::to('storage/app/public/Adminassets/images/users/avatar-7.jpg')}}" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
    @endif


        @if(file_exists(storage_path('app/public/user/'.Auth::user()->profile_picture)) && Auth::user()->profile_picture != '')
            <img src="{{URL::to('storage/app/public/user/'.Auth::user()->profile_picture)}}" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />
        @else
            <img src="{{URL::to('storage/app/public/Adminassets/images/users/avatar-7.jpg')}}" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />
        @endif




    <div class="media-body">
        <h6 class="pro-user-name mt-0 mb-0">{{Auth::user()->name}}</h6>
        <span class="pro-user-desc">Administrator</span>
    </div>
    <div class="dropdown align-self-center profile-dropdown-menu">
        <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
            aria-expanded="false">
            <span data-feather="chevron-down"></span>
        </a>
        <div class="dropdown-menu profile-dropdown">
            {{-- <a href="pages-profile.html" class="dropdown-item notify-item">
                <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                <span>My Account</span>
            </a> --}}

            <div class="dropdown-divider"></div>

            <a href="{{URL::to('admin/logout')}}" class="dropdown-item notify-item">
                <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>
<div class="sidebar-content">
    <!--- Sidemenu -->
    <div id="sidebar-menu" class="slimscroll-menu">
        <ul class="metismenu" id="menu-bar">
            <li class="menu-title">Navigation</li>

            <li>
                <a href="{{URL::to('admin/dashboard')}}">
                    <i data-feather="home"></i>
                    {{-- <span class="badge badge-success float-right">1</span> --}}
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="menu-title">Apps</li>
            <li>
                <a href="{{URL::to('admin/users')}}">
                    <i data-feather="user"></i>
                    <span> Users </span>
                </a>
            </li>

        </ul>
    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
</div>
