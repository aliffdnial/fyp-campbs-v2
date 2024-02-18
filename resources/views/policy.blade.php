<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>CampBS Policy Page</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-villa-agency.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/swiper@7/swiper-bundle.min.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/CampBS_Logo.png') }}" />
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

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a>  /  Policy</span>
          <h3>Policy</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="policy-page section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h6>| CampBS Policy</h6>
                    <h2>Our Policies for Campers</h2>
                </div>
                <p>At CampBS, we strive to provide a safe and enjoyable camping experience for all our campers. Please take a moment to review our campsite policies to ensure a pleasant stay.</p>
                
                <br><h4>1. Reservation and Booking</h4>
                <p><strong>•</strong> Campsite reservations can be made through our online booking system or by contacting our office at <strong>03-5171 8319</strong>. We recommend booking in advance to secure your spot.</p>
                <p><strong>•</strong> Once a booking has been paid for, cancellations are not allowed. However, if you need to cancel, please contact us at <strong>03-5171 8319</strong> as soon as possible. Our CampBS team will assist you in processing the cancellation and refund.</p>
                <p><strong>•</strong> Let say if your bookings is on next week, but you wanted to booked early, you can do so. Your booking status will be updated <strong>5 day(s)</strong> before to avoid the lots to be locked until the day(s) of the start date that are on further months. This will give other campers opportunity before your booking start date that are on further months.</p>
                <!-- Add more policy points as needed -->
                
                <br><h4>2. Campfire Safety</h4>
                <p><strong>•</strong> Campfires are allowed only in designated areas. Please follow proper safety guidelines and extinguish fires completely before leaving the site.</p>
                <p><strong>•</strong> Do not expose extension wires to water, as it may lead to electric shock.</p>
                
                <br><h4>3. Waste Management</h4>
                <p><strong>•</strong>  Help us keep the campsite clean by disposing of waste in designated bins. Recycling bins are available for environmentally friendly campers.</p>
                <p><strong>•</strong> Failure to dispose of waste before check-out may result in additional fees.</p>
                <!-- Add more policy points as needed -->
                
                <br><h4>4. Check-In and Check-Out</h4>
                <p><strong>•</strong> Check-in time is after 2:00 PM, and check-out time is before 11:00 AM. Late check-outs may be subject to additional fees.</p>
                
                <br><h4>5. Quiet Hours</h4>
                <p><strong>•</strong> Respect quiet hours from 10:00 PM to 7:00 AM. Keep noise levels to a minimum during this time to ensure a peaceful environment for all campers.</p>
                <!-- Add more policy points as needed -->
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

  </body>
</html>