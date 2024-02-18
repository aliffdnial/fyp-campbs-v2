@extends('layouts.mytemplate')

@section('pagetitle')
Camper Booking Payment
@endsection

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
        -webkit-user-select: none;
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
                <div class="col-sm"> <!-- 1st Column -->
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
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->lot->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
                                <td>{{ $booking->numdays }} day(s)</td>
                                <td>{{ $booking->pax }} person(s)</td>
                                <td>RM {{ $booking->totalprice }}</td>
                            </tr> 
                            <tr style="background-color: #e0e0d1">
                                <td align="right" colspan="7"><b>Total</b></td>
                                <td><b>RM {{ $booking->totalprice }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm"> <!-- 2nd Column -->
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
                                <input type="radio" id="bank1" name="bank" value="bank1" checked>
                                <label for="bank1">
                                <img src="{{ asset('img/bankicon/affinbank.png') }}" />
                                </label>
                            </div>
                            <div class="bank-container">
                                <input type="radio" id="bank2" name="bank" value="bank2">
                                <label for="bank2">
                                    <img src="{{ asset('img/bankicon/ambank.png') }}" />
                                </label>
                            </div>
                            <div class="bank-container">
                                <input type="radio" id="bank3" name="bank" value="bank3">
                                <label for="bank3">
                                    <img src="{{ asset('img/bankicon/cimb.png') }}" />
                                </label>
                            </div>
                        </div>
                        <div style="display: flex; margin-top: 10px">
                            <div class="bank-container">
                                <input type="radio" id="bank4" name="bank" value="bank4">
                                <label for="bank4">
                                    <img src="{{ asset('img/bankicon/citibank.png') }}" />
                                </label>
                            </div>
                            <div class="bank-container">
                                <input type="radio" id="bank5" name="bank" value="bank5">
                                <label for="bank5">
                                <img src="{{ asset('img/bankicon/hlbbank.png') }}" />
                                </label>
                            </div>
                            <div class="bank-container">
                                <input type="radio" id="bank6" name="bank" value="bank6">
                                <label for="bank6">
                                    <img src="{{ asset('img/bankicon/maybank.png') }}" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="card" style="margin-top: 10px; display: none;">
                        <label>Please fill all card details</label>
                        <input type="text" class="form-control" name="card1" placeholder="Card Number">
                        <input type="text" class="form-control" name="card2" placeholder="VVT">
                        <input type="text" class="form-control" name="card3" placeholder="Expiry">
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('app.booking.payment0', $booking->id) }}" class="btn btn-primary" id="pay-ob" style="display: none">Pay by Online Banking</a>
                        <form method="POST" action="{{ route('app.booking.process_card', $booking->id) }}">
                            @csrf
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="pay-card" style="display: none">Pay by Card</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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