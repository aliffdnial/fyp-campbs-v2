<!-- Confirmation username page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FPX Payment Gateway</title>
    <link href="{{ asset('assets/css/payment/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="bankicon/fpx.jpg" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" >
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto" >
                <img class="float-center" style="width: 30%" src="{{ asset('img/bankicon/fpx.jpg') }}" alt="">
                <p class="float-end"  style="color: black;"><b>FPX Step (2 of 4)</b></p><br><br></center>
                
                    <div class="auth-form-light text-left p-3" style="background-color:#b0093d">
                      <div class="brand-logo"></div>
                      <center>
                        <p style="color: white; font-family: arial; font-size: 15px;">WELCOME TO OUR INTERNET <br> BANKING PLATFORM</p>
                      </center>
                      
                      <center>
                        <p style="color: white; font-family: arial; font-size: 15px;" > Hi, Camper {{ $booking->user->name }}  </p>
                      </center>
                      
                      <center>
                        <img style="width: 15%" src="{{ asset('img/bankicon/goal.png') }}" alt="">
                      </center>
                      
                      <center>
                        <p style="color: white; font-family: arial; font-size: 15px;" >Private Word: Skadoosh </p>
                      </center>
                      
                      <center>
                        <p style="color: white; font-family: arial; font-size: 15px;" >Is this your Private Image and Private Word?</p>
                      </center>
                      
                      <center>
                        <p style="color: white; font-family: arial; font-size: 15px;" >If this is not the chosen Private Image and Private Word, do not login, Please call Bank Islam Contact Center at 603-26 900 900</p><br>
                      </center>
                   
                  <center>
                    <a class="btn btn-success" type="button" href="{{ route('app.booking.payment3', $booking->id) }}">Yes</a>
                    <a class="btn btn-danger" type="button" href="{{ route('app.booking.payment1', $booking->id) }}">No</a><br>
                  </center>
                  
                </div>
                <div class="auth-form-light text-left p-3" style="background-color:#582625">
                    <center><p class="text-center" style="color:white; font-family: arial; font-size: 15px">Bank Islam Malaysia Berhad (98127-X). All right reserved.</p>
                    <p class="text-center" style="color:white; font-family: arial; font-size: 15px">The webpage is best viewed using IE 7.0 and above, Chrome 33.0 and above, Mozilla Firefox 26.0 and above, Safari 5.1.6 and above.</p></center>
                </div>        
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>