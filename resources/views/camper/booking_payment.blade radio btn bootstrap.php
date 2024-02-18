@extends('layouts.mytemplate')
<head>

<style>
    .form-check {
        height: 50px;
        width: 50px;
        background-color: #ffffff;
        box-shadow: 0 0 25px rgba(17, 1, 68, 0.08);
        border-radius: 8px;
        position: relative;
        cursor: pointer;
        margin-left: 10px;
    }

    .bank-check {
        -webkit-appearance: none;
        position: relative;
        width: 100%;
        cursor: pointer;
    }

    .bank-check:after {
        position: absolute;
        font-family: 'Nunito', sans-serif; /* Use Nunito or the desired font-family from your template */
        font-weight: 400;
        content: "\f111";
        font-size: 18px;
        color: #478bfb;
        right: 10px;
        top: -5px;
    }

    .bank-check:checked:after {
        font-weight: 900;
        content: "\f058";
        color: #478bfb;
    }

    .form-check img {
        width: 60px;
        position: absolute;
        margin: auto;
        left: 0;
        right: 20px;
        top: 0;
        bottom: 0;
        cursor: pointer;
    }

    @media screen and (min-width: 950px) {
        .form-check {
            height: 100px;
            width: 150px;
        }

        .bank-check:after {
            font-size: 22px;
        }
    }
</style>
</head>
@section('pagetitle')
Camper Booking Payment
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    My Booking Details
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Booking Payment</li>
    @endsection
    <div class="card-body mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Camper Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> day(s)</td>
                                <td> person(s)</td>
                                <td>RM </td>
                            </tr> 
                            <tr style="background-color: #e0e0d1">
                                <td align="right" colspan="6"><b>Total</b></td>
                                <td><b>RM </b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm">
                    <div class="card-header">
                        <h4>Make a Payment</h4>
                        <select name="pmethod" class="form-control" onchange="paymentMethod(this.value)" required="">
                            <option value selected >Select Payment Method</option>
                            <option value="Online Banking">Online Banking</option>
                            <option value="Card">Card</option>
                        </select>
                    </div>
                    <div class="card-body" id="online" style="margin-top: 20px; display: none;">
                        <div style="display: flex;">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank1" value="bank1" name="bank" checked>
                                <label for="bank1">
                                <img src="img/bankicon/affinbank.png" />
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank2" value="bank2" name="bank">
                                <label for="bank2">
                                    <img src="img/bankicon/ambank.png" />
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank3" value="bank3" name="bank">
                                <label for="bank3">
                                    <img src="img/bankicon/cimb.png" />
                                </label>
                            </div>
                        </div>
                        <div style="display: flex; margin-top: 10px">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank4" value="bank4" name="bank">
                                <label for="bank4">
                                    <img src="img/bankicon/citibank.png" />
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank5" value="bank5" name="bank">
                                <label for="bank5">
                                <img src="img/bankicon/hlbbank.png" />
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="bank6" value="bank" name="bank">
                                <label for="bank6">
                                    <img src="img/bankicon/maybank.png" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="card" style="margin-top: 10px; display: none;">
                        <label>Please fill all card detail</label>
                        <input type="text" class="form-control" name="card1" placeholder="Card Number">
                        <input type="text" class="form-control" name="card2" placeholder="VVT">
                        <input type="text" class="form-control" name="card3" placeholder="Expiry">
                    </div>
                    <div class="card-footer">
                        <a href="payment/payment0.php" class="btn btn-primary" id="pay-ob" style="display: none">Pay by Online Banking</a>
                        <a href="buyer_order_process_card.php" class="btn btn-primary" id="pay-card" style="display: none">Pay by Card</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('jquery.maphilight.min.js') }}"></script>
<script type="text/javascript">
    function paymentMethod(method){
        if(method == "Online Banking"){
            $("#online").show();
            $("#pay-ob").show();
            $("#card").hide();
            $("#pay-card").hide();

        }else{
            $("#card").show();
            $("#pay-card").show();
            $("#online").hide();
            $("#pay-ob").hide();
        }
    }
</script>
@endsection