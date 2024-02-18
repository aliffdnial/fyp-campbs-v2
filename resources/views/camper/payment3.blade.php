<!-- Insert password page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FPX Payment Gateway</title>
    <link rel="stylesheet" href="{{ asset('assets/css/payment/style.css') }}">
    <link rel="shortcut icon" href="bankicon/fpx.jpg" />
  </head>
  <style>
    .content-wrapper{
  background-color: white;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding-top: 0px;
}
  </style>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" >
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto" >
                <img class="float-center" style="width: 30%" src="{{ asset('img/bankicon/fpx.jpg') }}" alt="">
                <p class="float-end"  style="color: black;"><b>FPX Step (3 of 4)</b></p><br><br></center>
                
                <div class="auth-form-light text-left p-3" style="background-color:#b0093d">
                  <div class="brand-logo"></div>
                  <center>
                    <p style="color: white; font-family: arial; font-size: 15px;">WELCOME TO OUR INTERNET BANKING PLATFORM</p>
                  </center>
                  
                  <center>
                    <p style="color: white; font-family: arial; font-size: 15px;" >Hi,<b> Camper {{ $booking->user->name }} </b></p>
                  </center>
                  
                  <center>
                    <img style="width: 15%" src="{{ asset('img/bankicon/goal.png') }}" alt="">
                  </center>
                  
                  <center>
                    <p style="color: white; font-family: arial; font-size: 15px;" >Private Word: Skadoosh </p>
                  </center>

                  <form class="p-6" id="" role="form" method="post" action="{{ route('app.booking.payment4', $booking->id) }}" aria-labelledby="nav-contact-tab">
                    @csrf
                    <center><h6 style="color: white; font-family: arial;" >PASSWORD</h6>
                    <input class="input-group-text " type="password" style="width: 50%, height: 50%" name="dum_password" placeholder="Password" value="{{ ($booking->user->password) }}"></center><br>
                  
                    <center> 
                      <button class="btn btn-success" type="submit" name="submit">Login</button>
                      <a class="btn btn-danger" type="button" href="{{ route('app.booking.payment1', $booking->id) }}" style="color: white;">Cancel</a><br>
                    </center>
                  </form>
                 
                </div>
                <div class="auth-form-light text-left p-3" style="background-color:#582625">
                    <center><p class="text-center" style="color:white; font-size: 15px">Bank Islam Malaysia Berhad (98127-X). All right reserved.</p>
                    <p class="text-center" style="color:white; font-size: 15px">The webpage is best viewed using IE 7.0 and above, Chrome 33.0 and above, Mozilla Firefox 26.0 and above, Safari 5.1.6 and above.</p></center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</html>