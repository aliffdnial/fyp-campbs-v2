<nav class="main-nav">
    <!-- ***** Logo Start ***** -->
    <a href="{{ route('welcome') }}" class="logo">
        <h1>{{ env('APP_NAME') }}</h1>
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav">
        <li><a href="{{ route('welcome') }}">Home</a></li>
        <li><a href="{{ route('policy') }}">Policy</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
        <li>
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/app/dashboard') }}">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login') }}">Log in</a></li>

                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}"> Register</a></li>
                @endif
                @endauth
            @endif
        </li>
        <li></li>
    </ul>   
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>