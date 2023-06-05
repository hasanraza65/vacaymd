<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

<div class="overlay"></div>
<div class="search-overlay"></div>

<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item">
                    <a href="/">
                   
                        <img width="60%" height="auto" src="/src/assets/logos/logo.png" class="" alt="logo">
                    </a>
                </div>

                <!---
                <div class="nav-item theme-text">
                    <a href="/" class="nav-link"> CORK </a>
                </div> --->
            </div>
            <!---
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                </div>
            </div> --->
        </div>

        <div class="profile-info">
            <div class="user-info">
                <div class="profile-img">
                   <?php
                      $url='/src/assets/img/default_pic.webp';
                      if(Auth::user()->profile_pic!=null){
                        $url=Auth::user()->profile_pic;
                         }
                    ?>
                    <img src="{{$url}}" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">{{Auth::user()->name}}</h6>
                    <p class="">
                        @if(Auth::user()->user_role == 1)
                        Admin
                        @elseif(Auth::user()->user_role == 2)
                        Doctor
                        @elseif(Auth::user()->user_role == 3)
                        Pharamacy Manager 
                        @elseif(Auth::user()->user_role == 4)
                        Patient
                        @endif

                    </p>
                </div>
            </div>
        </div>
                        
        <div class="shadow-bottom"></div>
        @include('layouts.includes.components.menu')
        
    </nav>

</div>
<!--  END SIDEBAR  -->

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">

            @yield('content')