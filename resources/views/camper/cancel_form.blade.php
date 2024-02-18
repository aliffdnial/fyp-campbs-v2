@extends('layouts.mytemplate')

@section('pagetitle')
Camper Cancel Form
@endsection

@section('content')

<div class="card">
    <div class="card-header"></div>
    @section('pageheader')
    Booking Cancel Form
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Cancel Booking Form</li>
    @endsection
    <div class="card-body mt-4">
        @csrf

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <!-- 1st column -->
                    <center><img src="{{ asset('uploads/map/map.jpg') }}" alt="anom campsite map" usemap="#image_map" class="map">
                    <map name="image_map">
                    @foreach ($lots as $lot)
                        @if ($lot->id <= 14)
                            <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="{{ $lot->coordinates }}" shape="rect" id="lot-1" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                        @endif
                        @if ($lot->id >= 15)
                            <area title="{{ $lot->name }}, Capacity : {{ $lot->capacity }}, Facilities: {{ $lot->facilities }}" href="" coords="{{ $lot->coordinates }}" shape="polygon" id="lot-pakdin" data-maphilight='{"stroke":true,"fillColor":"{{ $lot->hex }}","fillOpacity":0.5,"alwaysOn":true}'>
                        @endif
                    @endforeach
                </map>
               
                </div>
                <div class="col-sm">
                    <!-- 2nd column -->
                   
                    <table class="table">
                        <br><br>
                        <tr>
                            <th>Lot Selection <span style="color: red">*</span></th>
                            <td>
                                <select class="form-control" name="lot_id" disabled>
                                    @foreach($lots as $lot)
                                    @if($lot->status == 1)
                                    <option value="{{ $lot->lot_id }}">{{ $lot->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('lot_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Number of Pax <span style="color: red">*</span></th>
                            <td>
                                <input type="text" class="form-control" onchange="calcPax(this.value)"  name="pax" value="{{ old('pax', $booking->pax) }}" disabled>
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
                                <input type="text" class="form-control" name="totalprice" id="totalprice" placeholder="0.00" disabled value="{{ old('totalprice', number_format($booking->totalprice, 2, '.', '')) }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Date From <span style="color: red">*</span></th>
                            <td>
                                <input type="date" class="form-control" id="start_date" onchange="calcNumDays(this.value)" name="start_date" value="{{ old('start_date', $booking->start_date) }}" min="{{ now()->format('Y-m-d') }}" disabled>
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
                                <input type="date" class="form-control" id="end_date" onchange="calcNumDays(this.value)" name="end_date" value="{{ old('end_date', $booking->end_date) }}" min="{{ now()->format('Y-m-d') }}" disabled>
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
                                <input type="text" class="form-control" name="numdays" id="numdays" placeholder="Days" disabled value="{{ old('numdays', $booking->numdays) }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td>
                                <input type="text" class="form-control" name="remark" value="{{ old('remark', $booking->remark) }}" disabled>
                                @error('remark')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        
                        @if($booking->status == 1 || $booking->status == 2 || $booking->status == 3 || $booking->status == 4)
                            <div class="alert alert-warning" role="alert">
                                This booking is already approved, rejected, or in the past. You cannot edit it.
                            </div>
                        @else
                            <form action="{{ route('app.booking.cancel', $booking->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="booking" value="{{ $booking->id }}">
                                
                                <th>Cancellation Reason<span style="color: red">*</span></th>
                                <td>
                                    <textarea class="form-control" id="cancelreason" name="cancelreason" rows="3" required>
                                    </textarea>
                                    @error('cancelreason')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>

                                <tr>
                                    <th>Evidence<span style="color: red">*</span></th>
                                    <td>
                                        <input type="file" class="form-control" name="evidence">
                                        @error('evidence')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>
                    </table>
                        <a href="{{ route('app.booking.index') }}" class="btn btn-info">Go Back</a>
                        <button type="submit" class="btn btn-warning">Cancel Booking</button>
                    </form>
                        @endif
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
function calcPax(val) {
    var tot_price = val * 15.00;
    /*display the result*/
    var obj = document.getElementById('totalprice');
    obj.value = tot_price.toFixed(2);
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