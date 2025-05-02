     <!-- ========== Topbar Start ========== -->
     <div class="navbar-custom">
         <div class="topbar container-fluid">
             <div class="d-flex align-items-center gap-lg-2 gap-1">

                 <!-- Topbar Brand Logo -->
                 <div class="logo-topbar">
                     <!-- Logo light -->
                     <a href="index.html" class="logo-light">
                         <span class="logo-lg">
                             <img src="{{ asset('dashboard/assets/images/logo.png') }}" alt="logo">
                         </span>
                         <span class="logo-sm">
                             <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="small logo">
                         </span>
                     </a>

                     <!-- Logo Dark -->
                     <a href="index.html" class="logo-dark">
                         <span class="logo-lg">
                             <img src="{{ asset('dashboard/assets/images/logo-dark.png') }}" alt="dark logo">
                         </span>
                         <span class="logo-sm">
                             <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="small logo">
                         </span>
                     </a>
                 </div>

                 <!-- Sidebar Menu Toggle Button -->
                 <button class="button-toggle-menu">
                     <i class="ri-menu-2-fill"></i>
                 </button>

                 <!-- Horizontal Menu Toggle Button -->
                 <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                     <div class="lines">
                         <span></span>
                         <span></span>
                         <span></span>
                     </div>
                 </button>

                 <!-- Topbar Search Form -->
                 {{-- <div class="app-search dropdown d-none d-lg-block">
                     <form>
                         <div class="input-group">
                             <input type="search" class="form-control dropdown-toggle" placeholder="Search..."
                                 id="top-search">
                             <span class="ri-search-line search-icon"></span>
                         </div>
                     </form>

                     <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                         <!-- item-->
                         <div class="dropdown-header noti-title">
                             <h5 class="text-overflow mb-1">Found <b class="text-decoration-underline">08</b> results
                             </h5>
                         </div>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="ri-file-chart-line fs-16 me-1"></i>
                             <span>Analytics Report</span>
                         </a>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="ri-lifebuoy-line fs-16 me-1"></i>
                             <span>How can I help you?</span>
                         </a>

                         <!-- item-->
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <i class="ri-user-settings-line fs-16 me-1"></i>
                             <span>User profile settings</span>
                         </a>

                         <!-- item-->
                         <div class="dropdown-header noti-title">
                             <h6 class="text-overflow mt-2 mb-1 text-uppercase">Users</h6>
                         </div>

                         <div class="notification-list">
                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item">
                                 <div class="d-flex">
                                     @if (Auth::user()->profile_pic)
                                         <img class="d-flex me-2 rounded-circle" src="{{ Auth::user()->profile_pic }}"
                                             alt="Generic placeholder image" height="32">
                                     @else
                                         <img class="d-flex me-2 rounded-circle"
                                             src="{{ asset('dashboard/assets/images/users/avatar-1.jpg') }}"
                                             alt="Generic placeholder image" height="32">
                                     @endif
                                     <div class="w-100">
                                         <h5 class="m-0 fs-14">Erwin Brown</h5>
                                         <span class="fs-12 mb-0">UI Designer</span>
                                     </div>
                                 </div>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item">
                                 <div class="d-flex">
                                     <img class="d-flex me-2 rounded-circle"
                                         src="{{ asset('dashboard/assets/images/users/avatar-5.jpg') }}"
                                         alt="Generic placeholder image" height="32">
                                     <div class="w-100">
                                         <h5 class="m-0 fs-14">Jacob Deo</h5>
                                         <span class="fs-12 mb-0">Developer</span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </div> --}}
             </div>

             <ul class="topbar-menu d-flex align-items-center gap-3">
                 <li class="dropdown d-lg-none">
                     <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                         role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="ri-search-line fs-22"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">
                         <form class="p-3">
                             <input type="search" class="form-control" placeholder="Search ..."
                                 aria-label="Recipient's username">
                         </form>
                     </div>
                 </li>

                 <li class="dropdown notification-list">
                     <a class="nav-link dropdown-toggle arrow-none position-relative" data-bs-toggle="dropdown"
                         href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="ri-notification-3-fill fs-22 position-relative"></i>
                         <span id="notificationCount"
                             class="noti-icon-badge position-absolute badge rounded-pill bg-danger">
                             0
                         </span>
                     </a>

                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                         <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                             <div class="row align-items-center">
                                 <div class="col">
                                     <h6 class="m-0 fs-16 fw-medium">Notifications</h6>
                                 </div>
                                 <div class="col-auto">
                                     <a href="javascript:void(0);" id="clearNotifications"
                                         class="text-dark text-decoration-underline">
                                         <small>Mark All as Read</small>
                                     </a>
                                 </div>
                             </div>
                         </div>

                         <div id="notificationDropdown" style="max-height: 300px;" data-simplebar>
                             <h5 class="text-muted fs-12 fw-bold p-2 text-uppercase mb-0">Unread</h5>
                         </div>

                         <!-- View All -->
                         {{-- <a href="javascript:void(0);" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                            View All
                        </a> --}}
                     </div>
                 </li>



                 <li class="d-none d-sm-inline-block">
                     <div class="nav-link" id="light-dark-mode">
                         <i class="ri-moon-fill fs-22"></i>
                     </div>
                 </li>


                 <li class="d-none d-md-inline-block">
                     <a class="nav-link" href="" data-toggle="fullscreen">
                         <i class="ri-fullscreen-line fs-22"></i>
                     </a>
                 </li>

                 <li class="dropdown me-md-2">
                     <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                         href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <span class="account-user-avatar">

                            @if (Auth::user()->profile_pic)
                                <img src="{{ asset(Auth::user()->profile_pic) }}" alt="user-image" width="32"
                                    class="rounded-circle">
                                
                            @else
                                <img src="{{ asset('dashboard/assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
                            @endif
                            
                         </span>

                         <span class="d-lg-flex flex-column gap-1 d-none">
                             <h5 class="my-0 text-capitalize">{{ Auth::user()->first_name }}
                                 {{ Auth::user()->last_name }}</h5>
                             <h6 class="my-0 fw-normal">
                                 @auth
                                     @switch(Auth::user()->role_id)
                                         @case(1)
                                             Admin
                                         @break

                                         @case(7)
                                             Team Leader
                                         @break

                                         @case(3)
                                             Back Office
                                         @break

                                         @case(4)
                                             Photography
                                         @break

                                         @case(5)
                                             Accounting
                                         @break

                                         @case(6)
                                             Marketing
                                         @break

                                         @default
                                             Agent
                                     @endswitch
                                 @endauth
                             </h6>
                         </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                         <!-- item-->
                         <div class=" dropdown-header noti-title">
                             <h6 class="text-overflow m-0">Welcome !</h6>
                         </div>

                         <!-- item-->
                         <a href="{{ route('profile') }}" class="dropdown-item">
                             <i class="ri-account-circle-fill align-middle me-1"></i>
                             <span>My Account</span>
                         </a>

                         <a href="{{ route('changePassword') }}" class="dropdown-item">
                             <i class="ri-settings-3-fill align-middle me-1"></i>
                             <span>Change Password</span>
                         </a>

                         <!-- item-->
                         <a href="{{ route('logout') }}" class="dropdown-item">
                             <i class="ri-logout-box-fill align-middle me-1"></i>
                             <span>Logout</span>
                         </a>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
     <!-- ========== Topbar End ========== -->
