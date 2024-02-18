@extends('layouts.mytemplate')
<style>
.bank-container {
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
            font-family: "Font Awesome 5 Free";
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
        .bank-container img {
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
            .bank-container {
                height: 100px;
                width: 150px;
            }
            .bank-check:after {
                font-size: 22px;
            }
        }
</style>
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
                                <th>No</th><th>Camper Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th>
                            </tr>
                        </thead>
                        @php($i=1)
                        
                        <tbody>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> day(s)</td>
                                <td> person(s)</td>
                                <td>RM </td>
                                <tr style="background-color: #e0e0d1">
                                    <td align="right" colspan="7"><b>Total</b></td>
                                    <td><b>RM </b></td>
                                </tr>
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
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank1" name="bank" style="background-color: unset;" />
                                        <label for="bank1">
                                        <img src="img/bankicon/maybank.jpg" />
                                        </label>
                                    </div>
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank2" name="bank" style="background-color: unset;" checked="" />
                                        <label for="bank2">
                                            <img src="img/bankicon/bislam.png" />
                                        </label>
                                    </div>
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank3" name="bank" style="background-color: unset;" />
                                        <label for="bank3">
                                            <img src="img/bankicon/cimb.png" />
                                        </label>
                                    </div>
                                </div>
                                <div style="display: flex; margin-top: 10px">
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank4" name="bank" style="background-color: unset;" />
                                        <label for="bank4">
                                            <img src="img/bankicon/pb.png" />
                                        </label>
                                    </div>
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank5" name="bank" style="background-color: unset;" />
                                        <label for="bank5">
                                        <img src="img/bankicon/ambank.jpg" />
                                        </label>
                                    </div>
                                    <div class="bank-container">
                                        <input type="radio" class="bank-check" id="bank6" name="bank" style="background-color: unset;" />
                                        <label for="bank6">
                                            <img src="img/bankicon/alliance.png" />
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