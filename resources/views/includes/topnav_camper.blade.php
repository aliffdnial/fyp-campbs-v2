<ul class="d-flex align-items-center">
    @guest
    @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
    @endif
    
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif
    @else
    <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"> 
            @if(Auth::user()->usertype == 1) 
                CampBS {{ Auth::user()->name }}
            @endif
            
            @if(Auth::user()->usertype == 0) 
                Camper {{ Auth::user()->name }}
            @endif
            </span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                <h6>
                @if(Auth::user()->usertype == 1) 
                    CampBS {{ Auth::user()->name }}
                @endif
                
                @if(Auth::user()->usertype == 0) 
                    Camper {{ Auth::user()->name }}
                @endif
                </h6>
                <span>{{ Auth::user()->address }}</span>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
            </li>
        @endguest
        </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

</ul>