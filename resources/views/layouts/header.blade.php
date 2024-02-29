<!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
</div> -->

<nav class="main-header navbar navbar-expand border-bottom-0 bg-white">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-default" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-default">@yield('directory')</a>
        </li>
        
    </ul>

   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <?php 
                $switchTo = 'en';
                if(session()->has('locale') && session()->get('locale') == 'en'){
                    $switchTo = 'kh';
                }
            ?>
            <a class="nav-link text-default pr-0" href="{{route('language.change', $switchTo)}}">
                @if(session()->has('locale'))
                <img src="{{asset('img/'.session()->get('locale').'.png')}}" alt="" width="25" height="25"
                    class="brand-image img-circle elevation-3">
                @else
                <img src="{{asset('img/kh.png')}}" alt="" width="25" height="25"
                    class="brand-image img-circle elevation-3">
                @endif
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link text-default" data-toggle="dropdown" href="#">
                
                <img src="{{asset('img/picture.jpg')}}" alt="" width="25" height="25"
                    class="brand-image img-circle elevation-3 mr-2">
               {{auth()->user()->name}} <i class="right fas fa-caret-down"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item">
                    <i class="fas fa-user mr-2 text-primary"></i> {{__('lb.My Profile')}}
                </a>
                <a href="" class="dropdown-item">
                    <i class="fas fa-key mr-2 text-primary"></i> {{__('lb.Change Password')}}
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" class="dropdown-item" method="post">
                    @csrf
                    <i class="fas fa-sign-out-alt mr-2 text-danger"></i>
                    <button class="btn" type="submit">{{__('lb.Logout')}}</button>
                </form>
            </div>
        </li>
    </ul>
</nav>