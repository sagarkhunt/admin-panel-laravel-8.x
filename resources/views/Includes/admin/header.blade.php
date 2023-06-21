<div class="container-fluid">
    <!-- LOGO -->
    <a href="{{URL::to('admin/dashboard')}}" class="navbar-brand mr-0 mr-md-2 logo">
        <span class="logo-lg">
            <!-- <img src="{{URL::to('storage/app/public/Adminassets/images/logo1.svg')}}"  class=" avatar-xl" alt="" height="30" /> -->
            Project Logo

        </span>
        <span class="logo-sm">
             <img src="{{URL::to('storage/app/public/Adminassets/images/logo1.svg')}}" class=" avatar-xl" alt="" height="30" />
        </span>
    </a>

    <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
        <li class="">
            <button class="button-menu-mobile open-left disable-btn">
                <i data-feather="menu" class="menu-icon"></i>
                <i data-feather="x" class="close-icon"></i>
            </button>
        </li>
    </ul>

    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">


        <li class="dropdown notification-list align-self-center profile-dropdown">
            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <div class="media user-profile ">
                    <img src="{{URL::to('storage/app/public/Adminassets/images/users/avatar-7.jpg')}}" alt="user-image" class="rounded-circle align-self-center" />
                    <div class="media-body text-left">
                        <h6 class="pro-user-name ml-2 my-0">
                            <span>{{Auth::user()->name}} </span>
                            <span class="pro-user-desc text-muted d-block mt-1">Administrator </span>
                        </h6>
                    </div>
                    <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                </div>
            </a>
            <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                {{-- <a href="pages-profile.html" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>My Account</span>
                </a> --}}

                <a href="{{URL::to('admin/logout')}}" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
</div>
