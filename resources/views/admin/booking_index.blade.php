@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Booking
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    List of All Bookings
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Manage Booking</li>
    @endsection
    <div class="card-body mt-4">
        <table>
            <tr>
                <td><input type="text" class="form-control" name="search" id="search" value="{{ $search }}" placeholder="Search by Name, Lot Name ..." title="Search by Name, Lot Name ..."></td>
                <td><button type="button" class="btn btn-primary" name="search" id="search"  onclick="search()">Search</button></td>

                <td><input type="date" class="form-control" name="search1" id="search1" value="{{ $search1 ? date('d-m-Y', strtotime($search1)) : '' }}" title="Search Date From ..."></td>
                <td><input type="date" class="form-control" name="search2" id="search2" value="{{ $search2 ? date('d-m-Y', strtotime($search2)) : '' }}" title="Search Date To ..."></td>
                <td><button type="button" class="btn btn-info" name="search1" id="search1"  onclick="search1()">Search</button></td>

                <td><a href="{{ route('app.admin.booking.pdf') }}" class="btn btn-secondary" name="">Download PDF</a></td>
            </tr>
        </table>
        
        <table class="table">
            <tr>
                <th>No</th><th>Date</th><th>Camper Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th><th>Payment Status</th><th>Bill Code</th><th>Remark</th><th>Status</th><th>Action</th>
            </tr>
            @php($i=1)
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ date('d-m-Y', strtotime($booking->created_at)) }}</td>
                <td><a href="{{ route('app.admin.booking.show', $booking->id) }}">{{ $booking->user->name }}</a></td>
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
                <td> @if($booking->paymentstatus == 1){{ $booking->billcode }}@else Not Available @endif</td>
                <td>@isset($booking->remark) 
                    {{ $booking->remark }}
                    @else
                        -
                    @endif</td>
                @csrf
                <td>
                    @if($booking->status == 0)
                        <span class="badge bg-warning">Pending</a></td>
                    @elseif($booking->status == 1)
                        <span class="badge bg-dark">Under Review</a></td>
                    @elseif($booking->status == 2)
                        <span class="badge bg-success">Approved</a></td>
                    @elseif($booking->status == 4)
                        <span class="badge bg-secondary">Past</a></td>
                    @elseif($booking->status == 5)
                        <span class="badge bg-info">Cancel Booking</a></td>
                    @elseif($booking->status == 6)
                        <span class="badge bg-primary">Cancel Aproved</a></td>
                    @else
                        <span class="badge bg-danger">Rejected</a></td>
                    @endif
                </td>
                <td>
                    <form action="{{ route('app.admin.booking.update', $booking->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <!-- Disable Admin to Approve Button if start_date greater than current_date -->
                        @if(strtotime($booking->start_date) > strtotime('+2 days', strtotime(now()))) 
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm" disabled>Approved</button>
                            <button type="submit" name="action" value="cancel" class="btn btn-warning btn-sm" disabled>Cancel</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" disabled>Rejected</button>
                            <a href="{{ route('app.admin.booking.pdfcamper', $booking->id) }}" class="btn btn-secondary" name="">PDF</a>
                        @elseif($booking->status == 2 || $booking->status == 3 || $booking->status == 4 || $booking->status == 6) <!-- Status Approve,Reject,Past,Cancel Approved -->
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm" disabled>Approved</button>
                            <button type="submit" name="action" value="cancel" class="btn btn-warning btn-sm" disabled>Cancel</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" disabled>Rejected</button>
                            <a href="{{ route('app.admin.booking.pdfcamper', $booking->id) }}" class="btn btn-secondary" name="">PDF</a>
                        @else
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm" onclick="showApproveAlert()">Approved</button>
                            <button type="submit" name="action" value="cancel" class="btn btn-warning btn-sm" onclick="showCancelApproveAlert()">Cancel</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" onclick="showRejectAlert()">Rejected</button>
                            <a href="{{ route('app.admin.booking.pdfcamper', $booking->id) }}" class="btn btn-secondary" name="">PDF</a>
                        @endif
                    </form>
                    
                        <form action="{{ route('app.admin.booking.destroy', $booking->id) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                        </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $bookings->appends($_GET)->render() !!}
    </div>
</div>

<script type="text/javascript">
function search(){
    var search = document.getElementById('search').value;
    self.location = '{{ route('app.admin.booking.index') }}?search='+search;
}

function search1(){
    var startDate = document.getElementById('search1').value;
    var endDate = document.getElementById('search2').value;

    // // Convert input values to 'd-m-Y' format
    // var formattedStartDate = new DateTime(startDate).format('d-m-Y');
    // var formattedEndDate = new DateTime(endDate).format('d-m-Y');
    self.location = '{{ route('app.admin.booking.index') }}?search1='+startDate+'&search2='+endDate;
}

function showApproveAlert() {
    alert("Please note that you are about to approve this booking.");
}
function showRejectAlert() {
    alert("Please note that you are about to reject this booking.");
}
function showCancelApproveAlert() {
    alert("Please note that you are about to approve this cancel booking.");
}

function showDeleteAlert() {
    alert("Please note that you are about to delete this booking.");
}
</script>
@endsection