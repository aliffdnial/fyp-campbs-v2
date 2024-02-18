<!-- Login page  to insert username-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FPX Payment Gateway</title>
    <!-- Dummy payment gateway css page -->
    <link rel="stylesheet" href="{{ asset('assets/css/payment/style.css') }}">
    <link rel="shortcut icon" href="bankicon/fpx.jpg" />

    <style>
    .content-wrapper{
      background-color: white;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      padding-top: 0px;
    }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" >
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto" >
                <center>
                <img class="float-center" style="width: 30%" src="{{ asset('img/bankicon/fpx.jpg') }}" alt="">
                <p class="float-end" style="color: black;"><b>FPX Step 1 of 4</b></p><br><br></center>

                <div class="auth-form-light text-left p-3" style="background-color:#b0093d">
                  <div class="brand-logo"></div>
                  <center><h6 style="color: white; font-family: arial; font-size:15px;" >WELCOME TO OUR INTERNET<br> BANKING PLATFORM</h6><br></center>
                    
                      <form class="p-6" id="" role="form" method="post" action="{{ route('app.booking.payment2', $booking->id) }}" aria-labelledby="nav-contact-tab">
                        @csrf
                          <center><h6 style="color: white; font-family: arial; font-size:15px;" >USER ID</h6>
                          <input class="input-group-text" style="width: 50%, height: 50%" name="dum_username" placeholder="Username" value="{{ ($booking->user->name) }}" required=""></center><br>

                          <center><button class="btn btn-success" type="submit" name="submit">Login</button>
                          <a href="{{ route('app.booking.index') }}" type="button" class="btn btn-danger" style="color: white;">Cancel Transaction</a>
                      </form>
                      <br><br>
                    
                </div>
                <div class="auth-form-light text-left p-3" style="background-color:#582625">
                    <center><p class="text-center" style="color:white; font-family: arial; font-size: 13px">Bank Islam Malaysia Berhad (98127-X). All right reserved.</p>
                    <p class="text-center" style="color:white; font-family: arial; font-size: 13px">The webpage is best viewed using IE 7.0 and above, Chrome 33.0 and above, Mozilla Firefox 26.0 and above, Safari 5.1.6 and above.</p></center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>