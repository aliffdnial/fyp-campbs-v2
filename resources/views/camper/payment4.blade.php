<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FPX Payment Gateway</title>
    <link rel="stylesheet" href="{{ asset('assets/css/payment/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/bankicon/fpx.jpg') }}" />

    <style>
        .content-wrapper {
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
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <img class="float-center" style="width: 30%" src="{{ asset('img/bankicon/fpx.jpg') }}" alt="">
                        <div class="auth-form-light text-left p-0" style="background-color:#b0093d">
                            <p class="ms-3 mdi mdi-lock" style="color:white; font-size: 14px">  You are in a secure site</p>
                        </div>
                        <p style="color: black;"><b>FPX Step (3 of 4)</b></p>
                        
                        <form method="post" action="{{ route('app.booking.payment5', $booking->id) }}">
                          @csrf
                            <p class="float-end" style='color: black'>
                                at as <input style="border: none; background-color: transparent" type="text" name="pay_date" value="{{ now()->format('d-m-Y h:i:s A') }}">MYT
                            </p><br>
                            <div class="auth-form-light " style="background-color:white">
                                <div class="brand-logo">
                                </div>
                                <div class="auth-form-light text-left p-0" style="background-color:#b0093d">
                                    <p class="ms-3 " style="color:white; font-size: 14px"> Payment Details </p>
                                </div>

                                <p style="color: black;"><b>From Account*</b><br>Youth Saving - 112233445566 MYR 5000.00</p>
                                
                                <p style="color: black;"><b>Company Name</b><br>CampBS Sdn. Bhd.<br></p>

                                <p style="color: black;"><b>FPX Transaction ID</b><br><input style="border: none;" name="pay_transid" value="123456789"></p>
                                
                                <p style="color: black;"><b>Amount</b><br>MYR <input style="border: none" type="text" name="pay_amount" value="{{ number_format($booking->totalprice, 2, '.', '') }}" ></p>
                                <p style="color: red;"><b>*Indicates Mandatory Field</b><br></p>
                                 <center>
                                    <button class="btn btn-success" style="background-color: #b0093d, text-color:white" type="submit" name="submit">Pay</button>
                                    <a class="btn btn-danger" style="background-color: #b0093d, text-color:white" type="button" href="{{ route('app.booking.index') }}">Cancel</a><br><br>
                                </center>
                            </div>
                            
                        </form>
                        <div class="auth-form-light text-left p-3" style="background-color:#582625">
                            <p class="text-center" style="color:white; font-size: 12px">Bank Islam Malaysia Berhad (98127-X). All right reserved.</p>
                            <p class="text-center" style="color:white; font-size: 12px">The webpage is best viewed using IE 7.0 and above, Chrome 33.0 and above, Mozilla Firefox 26.0 and above, Safari 5.1.6 and above.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>