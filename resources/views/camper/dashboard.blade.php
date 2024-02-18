@extends('layouts.mytemplate')

@section('pagetitle')
Camper Dashboard
@endsection

@section('content')
<div class="row">
    @section('pageheader')
    Dashboard
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    @endsection

    <!-- Arrive On Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Arrive On</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bxs-plane-land"></i>
                    </div>
                    <div class="ps-3">
                    @foreach($bookings as $booking)
                        @if($booking->status == 2)
                        <h6>{{ date('d-m-Y', strtotime($booking->start_date)) }}</h6>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Arrive On Card -->
    
    <!-- Departure On Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Departure On</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bxs-plane-take-off"></i>
                    </div>
                    <div class="ps-3">
                    @foreach($bookings as $booking)
                        @if($booking->status == 2)
                    <h6>{{ date('d-m-Y', strtotime($booking->end_date)) }}</h6>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Departure On Card -->
    
    <!-- Booking Status Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Booking Status</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div class="ps-3">
                    @foreach($bookings as $booking)
                        @if($booking->status == 2)
                        <h6>
                            @if ($booking->status == 0)
                                Pending
                            @elseif ($booking->status == 1)
                                Under Review
                            @elseif ($booking->status == 2)
                                Approved
                            @elseif ($booking->status == 3)
                                Rejected
                            @elseif ($booking->status == 5)
                                Cancel Under Review
                            @elseif ($booking->status == 6)
                                Cancel Approved
                            @else
                            {{ $booking->status }}
                            @endif
                        </h6>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Booking Status Card -->
    
    <!-- Lot Name Card -->
    <div class="col-xxl-3 col-xl-12">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Lot Name</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo"></i>
                    </div>
                    <div class="ps-3">
                    @foreach($bookings as $booking)
                        @if($booking->status == 2)
                        <h6>{{ $booking->lot->name }}</h6>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Lot Name Card -->
</div>
<div class="card">
    <h5 class="card-header">Past Booking for Camper {{ Auth::user()->name }}</h5>
    <div class="card-body mt-4">
    <table>
            <tr>
                <td><input type="date" class="form-control" name="search1" id="search1" value="{{ $search1 ? date('d-m-Y', strtotime($search1)) : '' }}" title="Search Date From ..."></td>
                <td><input type="date" class="form-control" name="search2" id="search2" value="{{ $search2 ? date('d-m-Y', strtotime($search2)) : '' }}" title="Search Date To ..."></td>
                <td><button type="button" class="btn btn-info" name="search1" id="search1"  onclick="search1()">Search</button></td>
            </tr>
        </table>

        <table class="table">
            <br>
            <tr>
                <th>No</th><th>Date</th><th>Camper Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th><th>Payment Status</th><th>Remark</th><th>Status</th>
            </tr>
            @php($i=1)
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->created_at)) }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->lot->name }} {{ $booking->lot->facilities }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
                <td>{{ $booking->numdays }} day(s)</td>
                <td>{{ $booking->pax }}</td>
                <td>RM {{ $booking->totalprice }}</td>
                <td>
                    @if($booking->paymentstatus=="0")
                        <span class="badge bg-warning">Unpaid</a></td>
                    @elseif($booking->paymentstatus=="1")
                        <span class="badge bg-success">Paid</a></td>
                    @else
                        <span class="badge bg-danger">Unsuccessful</a></td>
                    @endif
                </td>
                <td>{{ $booking->remark }}</td>
                <td>
                    @if($booking->status == 1)
                        <span class="badge bg-dark">Under Review</a></td>
                    @elseif($booking->status == 2)
                        <span class="badge bg-success">Approved</a></td>
                    @elseif($booking->status == 3)
                        <span class="badge bg-danger">Rejected</a></td>
                    @elseif($booking->status == 4)
                        <span class="badge bg-secondary">Past</a></td>
                    @elseif($booking->status == 5)
                        <span class="badge bg-info">Cancel</a></td>
                    @elseif($booking->status == 6)
                        <span class="badge bg-info">Cancel Approved</a></td>
                    @else
                        <span class="badge bg-warning">Pending</a></td>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {!! $bookings->appends($_GET)->render() !!}
    </div>
</div>

<script type="text/javascript">
    function search1(){
        var startDate = document.getElementById('search1').value;
        var endDate = document.getElementById('search2').value;

        // // Convert input values to 'd-m-Y' format
        // var formattedStartDate = new DateTime(startDate).format('d-m-Y');
        // var formattedEndDate = new DateTime(endDate).format('d-m-Y');
        self.location = '{{ route('app.dashboard') }}?search1='+startDate+'&search2='+endDate;
    }
</script>
@endsection