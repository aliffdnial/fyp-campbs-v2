@extends('layouts.mytemplate')

@section('pagetitle')
Camper Booking
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of My Booking
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Booking</li>
    @endsection
    <div class="card-body mt-4">
        <a href="{{ route('app.booking.create') }}" class="btn btn-primary">Create New Booking</a><br>
        <table class="table">
            <tr>
                <th>No</th><th>Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th>
            </tr>
            @php($i=1)
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $booking->lot->name }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
                <td>{{ $booking->numdays }} day(s)</td>
                <td>{{ $booking->pax }}</td>
                <td>RM {{ $booking->totalprice }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('jquery.maphilight.min.js') }}"></script>
@endsection