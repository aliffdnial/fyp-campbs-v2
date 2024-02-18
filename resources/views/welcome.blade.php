<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?Premium=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>CampBS Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-villa-agency.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/swiper@7/swiper-bundle.min.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/CampBS_Logo.png') }}" />

    <style>
    .square {
      height: 50px;
      width: 50px;
      background-color: #008000;
    }
    </style>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <div class="sub-header">
    @include('includes.subhead_landing')
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
              @include('includes.nav_landing')
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
          <span class="category">Shah Alam, <em>Selangor</em></span>
          <h2>CAMPING AT CAMPBS! Spend your weekend here</h2>
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Shah Alam, <em>Selangor</em></span>
          <h2>Be Quick!<br>Get the best Lot Spot in CampBS</h2>
        </div>
      </div>
      <div class="item item-3">
        <div class="header-text">
          <span class="category">Shah Alam, <em>Selangor</em></span>
          <h2>Act Now!<br>Enjoy The Nature</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="16" data-speed="1000"></h2>
                   <p class="count-text ">Lots Available<br>in CampBS</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="7" data-speed="1000"></h2>
                  <p class="count-text ">Years<br>In Industry</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="10" data-speed="1000"></h2>
                  <p class="count-text ">Start-up<br>Awards Won on 2023</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Lots Maps</h6>
            <h2>Layouts of Lots that are available in CampBS</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-6">
          <div class="item">
            
            <img src="{{ asset('uploads/map/map.jpg') }}" alt="anom campsite map" usemap="#image_map" class="map">
              <map name="image_map">
              @foreach ($lots as $lot)
                @if ($lot->id === 1)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="351,394,419,456" shape="rect" id="lot-1" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 2)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="492,395,559,455" shape="rect" id="lot-2" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 3)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="638,377,707,437" shape="rect" id="lot-3" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 4)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="723,277,791,337" shape="rect" id="lot-4" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 5)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="712,491,782,551" shape="rect" id="lot-5" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 6)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="669,623,738,684" shape="rect" id="lot-6" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 7)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="404,628,473,689" shape="rect" id="lot-7" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 8)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="102,935,172,999" shape="rect" id="lot-8" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 9)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="259,924,327,985" shape="rect" id="lot-9" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 10)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="415,929,484,990" shape="rect" id="lot-10" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 11)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="565,926,636,987" shape="rect" id="lot-11" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 12)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="725,925,793,987" shape="rect" id="lot-12" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 13)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="859,926,927,988" shape="rect" id="lot-13" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 14)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="1002,927,1070,987" shape="rect" id="lot-13" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 15)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="55,655,229,653,329,750,305,767,296,797,293,831,57,832" shape="polygon" id="lot-pakdin" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
                @if ($lot->id === 16)
                    <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="1060,451,988,475,947,536,942,592,951,656,962,685,994,714,1046,717,1075,745,1116,733" shape="polygon" id="lot-anom" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                @endif
              @endforeach
            </map>
        </div>
      </div>
    </div>
  </div>

  <div class="properties section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Lots Available</h6>
            <h2>Variety of Lots Been Provide To Serve The Campers</h2>
          </div>
        </div>
      </div>
      
      <div class="row">
        
      <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-1.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 1)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✔</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-2.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 2)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✔</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-3.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 3)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✔</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-4.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 4)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✔</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-5.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 5)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✔</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-6.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 6)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-7.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 7)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-8.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 8)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-9.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 9)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-10.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 10)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-11.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 11)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-12.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 12)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-12.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 13)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-12.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 14)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✖</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-pakdin.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 15)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            </h5><ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="item">
            <a><img src="assets/images/lot-anom.jpg" alt=""></a>
            @foreach($lots as $lot)
            @if ($lot->id === 16)
            <h6>RM {{ $lot->price }}</h6>
            <h4>{{ $lot->name }}</a></h4><h5>Facilities</h5>
            <ul>
              <li>Plug Point 1: <span>✔</span></li>
              <li>Plug Point 2: <span>✔</span></li>
              <li>Sungai Kecil: <span>✖</span></li>
              <li>Size: <span> {{ $lot->size }} Person</span></li>
              <li>Capacity: <span>{{ $lot->capacity }}</span></li>
            </ul>
            @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    @include('includes.footer_landing')
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/counter.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="{{ asset('jquery.maphilight.min.js') }}"></script>
  <script type="text/javascript">
      $('.map').maphilight();
  </script>

  </body>
</html>