<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('dashboard/assets/images/logo.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('dashboard/assets/images/logo.png') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user p-3 text-white">
            <a href="{{ route('profile') }}" class="d-flex align-items-center text-reset">
                <div class="flex-shrink-0">

                    @if (Auth::user()->profile_pic)
                        <img src="{{ asset(Auth::user()->profile_pic) }}" alt="user-image" height="42"
                            class="rounded-circle shadow border border-primary">
                    @else
                        <img src="{{ asset('dashboard/assets/images/users/avatar-1.jpg') }}" alt="user-image"
                            height="42" class="rounded-circle shadow border border-primary">
                    @endif

                </div>
                <div class="flex-grow-1 ms-2">
                    <span class="fw-semibold fs-15 d-block text-capitalize">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}</span>
                    <span class="fs-13">
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
                    </span>


                </div>
                <div class="ms-auto">
                    <i class="ri-arrow-right-s-fill fs-20"></i>
                </div>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">
            @if (isset($user_permissions))
                <li class="side-nav-title mt-1"> Main</li>

                <li class="side-nav-item">
                    <a href="{{ route('dashboard') }}" class="side-nav-link">
                        <i class="ri-dashboard-2-fill"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @if ($user_permissions->contains('permission_id', 7))
                    {{-- 7 = viewCalender --}}
                    <li class="side-nav-item">
                        <a href="{{ route('calender') }}" class="side-nav-link">
                            <i class="ri-calendar-2-fill"></i>
                            <span> Event Calendar </span>
                        </a>
                    </li>
                @endif

                @if (Auth::check() && Auth::user()->role_id == 1)
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users"
                            class="side-nav-link">
                            <i class="ri-user-fill"></i>
                            <span> Users </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('createUser') }}">Add User</a>
                                </li>
                                <li>
                                    <a href="{{ route('viewUsers') }}">View Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if ($user_permissions->contains('permission_id', 1) || $user_permissions->contains('permission_id', 2))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false"
                            aria-controls="sidebarTasks" class="side-nav-link">
                            <i class="ri-list-check-3"></i>
                            <span> Tasks </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTasks">
                            <ul class="side-nav-second-level">

                                {{-- {{$user_permissions[1]}} --}}

                                @if ($user_permissions->contains('permission_id', 1))
                                    {{-- 1 = createTask --}}
                                    <li>
                                        <a href="{{ route('createTask') }}">Create Task</a>
                                    </li>
                                @endif

                                @if ($user_permissions->contains('permission_id', 2))
                                    {{-- 2 = viewTasks --}}
                                    <li>
                                        <a href="{{ route('viewTasks') }}">View Tasks</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </li>
                @endif

                @if ($user_permissions->contains('permission_id', 8) || $user_permissions->contains('permission_id', 12))

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#fbPosts" aria-expanded="false" aria-controls="fbPosts"
                            class="side-nav-link">
                            <i class="ri-list-check-3"></i>
                            <span> Social </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="fbPosts">
                            <ul class="side-nav-second-level">

                                @if ($user_permissions->contains('permission_id', 12))
                                    <li>
                                        <a href="{{ route('facebook.login.check') }}">Facebook Post</a>
                                    </li>
                                @endif
                                @if ($user_permissions->contains('permission_id', 8))
                                    <li>
                                        <a href="{{ route('instagram.post') }}">Instagram Post</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                @endif

                @if ($user_permissions->contains('permission_id', 9) || $user_permissions->contains('permission_id', 10))
                    {{-- 9 = uploadMedia, 10 = viewMedia --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#mediaGallery" aria-expanded="false"
                            aria-controls="mediaGallery" class="side-nav-link">
                            <i class="ri-list-check-3"></i>
                            <span> Media </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="mediaGallery">
                            <ul class="side-nav-second-level">
                                @if ($user_permissions->contains('permission_id', 9))
                                    <li>
                                        <a href="{{ route('uploadMedia') }}">Upload Media</a>
                                    </li>
                                @endif
                                @if ($user_permissions->contains('permission_id', 10))
                                    <li>
                                        <a href="{{ route('viewMedia') }}">View Media</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if ($user_permissions->contains('permission_id', 13))
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#AutoEnhanced" aria-expanded="false"
                            aria-controls="AutoEnhanced" class="side-nav-link">
                            <i class="ri-list-check-3"></i>
                            <span> AutoEnhanced AI </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="AutoEnhanced">
                            <ul class="side-nav-second-level">
                                {{-- <li>
                                    <a href="{{ route('autoenhanced.upload') }}">Upload Images</a>
                                </li> --}}
                                @if ($user_permissions->contains('permission_id', 13))
                                    <li>
                                        <a href="{{ route('autoenhanced.uploadjs') }}">Upload ImagesJS</a>
                                    </li>
                                @endif
                                {{-- <li>
                                    <a href="{{ route('viewMedia') }}">View Enhanced Media</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>
                @endif

                {{-- <li class="side-nav-item">
                    <a href="{{ route('chatgpt') }}" class="side-nav-link">
                        <i class="ri-dashboard-2-fill"></i>
                        <span> Image Generate </span>
                    </a>
                </li> --}}


                @if ($user_permissions->contains('permission_id', 14))
                    <li class="side-nav-item">
                        <a href="{{ route('propertyDetailsGenerator') }}" class="side-nav-link">
                            <i class="ri-dashboard-2-fill"></i>
                            <span>Property Detail Generate</span>
                        </a>
                    </li>
                @endif


                {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#ImageGen" aria-expanded="false" aria-controls="ImageGen"
                    class="side-nav-link">
                    <i class="ri-list-check-3"></i>
                    <span> Image Generate </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="ImageGen">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('uploadMedia') }}"></a>
                        </li>
                        <li>
                            <a href="{{ route('viewMedia') }}">View Media</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            @endif
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->

<div class="content-page">
    <div class="content">
