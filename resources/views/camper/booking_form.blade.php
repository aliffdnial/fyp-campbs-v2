@extends('layouts.mytemplate')

@section('pagetitle')
Camper Booking Form
@endsection

@section('content')

<div class="card">
    @section('pageheader')
    Booking Details
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Booking Form</li>
    @endsection
    <div class="card-body">
        @if($booking->lot_id)<!-- TO CHECK id ALREADY EXIST OR NOT -->
            <form action="{{ route('app.booking.update', $booking->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
        @else
            <form action="{{ route('app.booking.store', $booking->id) }}" method="post">
        @endif
        
        @csrf

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <!-- 1st column -->
                    <center><img src="{{ asset('uploads/map/map.jpg') }}" alt="anom campsite map" usemap="#image_map" class="map">
                    <map name="image_map">
                    @foreach ($lots as $lot)
                        @if ($lot->id <= 14)
                            <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}, Price: Rm{{ $lot->price }}"  href="" coords="{{ $lot->coordinates }}" shape="rect" id="lot-1" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                        @endif
                        @if ($lot->id >= 15)
                            <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}, Price: Rm{{ $lot->price }}" href="" coords="{{ $lot->coordinates }}" shape="polygon" id="lot-pakdin" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                        @endif
                    @endforeach
                </map>
               
                </div>
                <div class="col-sm">
                    <!-- 2nd column -->
                    <br><br><br><br><br><br>
                    <table class="table">
                        <tr>
                            <th>Lot Selection <span style="color: red">*</span></th>
                            <td>
                                <select class="form-control" name="lot_id" onchange="updateLotPrice(this)">
                                    @foreach($lots as $lot)
                                    @if($lot->status == 1)
                                        <option value="{{ $lot->id }}" data-price="{{ $lot->price }}">{{ $lot->name }}, Price Rm{{ $lot->price }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <input type="hidden" id="lotPrice" value="{{ $lots->first()->price }}">
                                @error('lot_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Number of Pax <span style="color: red">*</span> (1 = rm15)</th>
                            <td>
                                <input type="text" class="form-control" onchange="calcPax(this.value, {{ $lot->price }})"  name="pax" value="{{ old('pax', $booking->pax) }}">
                                @error('pax')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>
                                <input type="text" class="form-control" name="totalprice" id="totalprice" placeholder="0.00" readonly value="{{ old('totalprice', number_format($lots->first()->price, 2, '.', '')) }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Date From <span style="color: red">*</span></th>
                            <td>
                                <input type="date" class="form-control" id="start_date" onchange="calcNumDays(this.value)" name="start_date" value="{{ old('start_date', $booking->start_date) }}" min="{{ now()->format('Y-m-d') }}">
                                @error('start_date')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Date To <span style="color: red">*</span></th>
                            <td>
                                <input type="date" class="form-control" id="end_date" onchange="calcNumDays(this.value)" name="end_date" value="{{ old('end_date', $booking->end_date) }}" min="{{ now()->format('Y-m-d') }}">
                                @error('end_date')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Number of Days</th>
                            <td>
                                <input type="text" class="form-control" name="numdays" id="numdays" placeholder="Days" readonly value="{{ old('numdays', $booking->numdays) }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>
                                <input type="text" class="form-control" name="remark" value="{{ old('remark', $booking->remark) }}">
                                @error('remark')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                    </table>
                    
                        <a href="{{ route('app.booking.index') }}" class="btn btn-info">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('jquery.maphilight.min.js') }}"></script>
<script type="text/javascript">
    $('.map').maphilight();
</script>

<script>
function updateLotPrice(select) {
    var lotPrice = parseFloat(select.options[select.selectedIndex].getAttribute('data-price'));
    document.getElementById('lotPrice').value = lotPrice;
    document.getElementById('totalprice').value = lotPrice.toFixed(2); // Update total price with the selected lot price
}

function calcPax(val) {
    var lotPrice = parseFloat(document.getElementById('lotPrice').value);
    var depositPrice = 15.00; // Fixed deposit price
    var tot_price = (val * depositPrice) + lotPrice;
    document.getElementById('totalprice').value = tot_price.toFixed(2); // Update total price with the calculated value
}

function calcNumDays() {
    // Get the start_date and end_date values
    var startDateStr = document.getElementById('start_date').value;
    var endDateStr = document.getElementById('end_date').value;

    // Convert the string dates to JavaScript Date objects
    var startDate = new Date(startDateStr);
    var endDate = new Date(endDateStr);

    // Calculate the number of days
    var numDays = (endDate - startDate) / (1000 * 60 * 60 * 24);

    // Display the result
    var obj = document.getElementById('numdays');
    obj.value = numDays;
}
</script>
@endsection