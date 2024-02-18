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
                <th>No</th><th>Date</th><th>Name</th><th>Lot Name</th><th>Start Date</th><th>End Date</th><th>Duration</th><th>Number of Pax</th><th>Total payment</th><th>Payment Status</th><th>Bill Code</th><th>Paid At</th><th>Remark</th><th>Status</th><th>Action</th>
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
                    @if($booking->paymentstatus == 0)
                        <span class="badge bg-warning">Unpaid</a></td>
                    @elseif($booking->paymentstatus == 1)
                        <span class="badge bg-success">Paid</a></td>
                    @else
                        <span class="badge bg-danger">Unsuccessful</a></td>
                    @endif
                </td>
                <td> @isset($booking->billcode) 
                        {{ $booking->billcode }}
                    @else
                        -
                    @endisset
                </td>
                <td> 
                    @isset($booking->paid_at)
                        {{ date('d-m-Y H:i:s', strtotime($booking->paid_at)) }}
                    @else
                        Currently Not Available
                    @endisset
                </td>
                <td>@isset($booking->remark) 
                    {{ $booking->remark }}
                    @else
                        -
                    @endif
                </td>
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
                        <span class="badge bg-info">Cancel Booking</a></td>
                    @elseif($booking->status == 6)
                        <span class="badge bg-info">Cancel Aproved</a></td>
                    @else
                        <span class="badge bg-warning">Pending</a></td>
                    @endif
                </td>
                <td>
                    @if(strtotime($booking->start_date) > strtotime('+2 days', strtotime(now())) || $booking->status > 0 || $booking->paymentstatus == 1) <!-- Disabled Btn when Approved,Reject,Past,Cancellation -->
                        <a href="{{ route('app.booking.edit', $booking->id) }}" class="btn btn-primary btn-sm btn-lg disabled" role="button" aria-disabled="true">Edit</a>
                        
                        <a href="{{ route('app.booking.cancel', $booking->id) }}" class="btn btn-warning btn-sm btn-lg disabled" role="button" aria-disabled="true">Cancel</a>
                        
                        <a href="{{ route('app.booking.payment', $booking->id) }}" class="btn btn-success btn-sm btn-lg disabled" role="button" aria-disabled="true">Pay</a>
                        
                    <form action="{{ route('app.booking.destroy', $booking->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                    </form>
                    @else
                        <a class="btn btn-primary btn-sm" onclick="editFx('{{ $booking->id }}')">Edit</a>

                        <a class="btn btn-warning btn-sm" onclick="cancelFx('{{ $booking->id }}')">Cancel</a>
                        
                        <a class="btn btn-success btn-sm" onclick="payFx('{{ $booking->id }}')">Pay</a>
                        
                        <form action="{{ route('app.booking.destroy', $booking->id) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="showDeleteAlert()">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        {!! $bookings->appends($_GET)->render() !!}
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{ asset('jquery.maphilight.min.js') }}"></script>
<script type="text/javascript">
    function editFx(id){
    if (confirm("Are you sure to edit your booking?")) {
        window.location.href = "{{ url('app/booking') }}/" + id + "/edit";
    } else {
        window.location.href = "{{ route('app.booking.index') }}";
    }
  }

  function cancelFx(id) {
    if (confirm("Are you sure to cancel your booking?")) {
        window.location.href = "{{ url('app/booking/cancel') }}/" + id;
    } else {
        window.location.href = "{{ route('app.booking.index') }}";
    }
  }

  function payFx(id){
    if (confirm("Are you sure to pay your booking?")) {
        window.location.href = "{{ url('app/booking/payment') }}/" + id;
    } else {
        window.location.href = "{{ route('app.booking.index') }}";
    }
  }

  function showDeleteAlert() {
    alert("Please note that you are about to delete your booking.");
  }
</script>
@endsection