@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Booking
@endsection

@section('content')
<div class="card">
    @section('pageheader')
    Booking Details
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Camper Booking Details</li>
    @endsection
    <div class="card-body mt-4">
        <table class="table">
            <tr>
               <td>Booking ID</td>
               <td>{{ $booking->id }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>{{ date('d-m-Y H:i:s', strtotime($booking->created_at)) }}</td>
            </tr>
            <tr>
                <td>Camper Name</td>
                <td>{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <td>Lot Name</td>
                <td>{{ $booking->lot->name }} {{ $booking->lot->facilities }}</td>
            </tr>
            <tr>
                <td>Bill Code</td>
                @if($booking->paymentstatus == 1)
                    <td>{{ $booking->billcode }}</td>
                @else
                    <td>Not Available</td>
                @endif
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
            </tr>
            <tr> 
                <td>End Date</td>
                <td>{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>{{ $booking->numdays }} day(s)</td>
            </tr>
            <tr>
                <td>Number of Pax</td>
                <td>{{ $booking->pax }}</td>
            </tr>   
            <tr>
                <td>Total payment</td>
                <td>RM {{ $booking->totalprice }}</td>
            </tr> 
            <tr>
                <td>Paid At</td>
                <td> 
                    @isset($booking->paid_at)
                        {{ date('d-m-Y H:i:s', strtotime($booking->paid_at)) }}
                    @else
                        -
                    @endisset
                </td>
            </tr>   
            <tr>
                <td>Total payment</td>
                <td>RM {{ $booking->totalprice }}</td>
            </tr>   
            <tr>
                <td>Payment Status</td>
                <td>
                    @if($booking->paymentstatus == "0")
                        <span class="badge bg-warning">Unpaid</a></td>
                    @elseif($booking->paymentstatus == "1")
                        <span class="badge bg-success">Paid</a></td>
                    @else
                        <span class="badge bg-danger">Unsuccessful</a></td>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Remark</td>
                <td>
                    @isset( $booking->remark )
                        {{ $booking->remark }}
                    @else
                        -
                    @endisset{{ $booking->remark }}
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    @if($booking->status == 0)
                        <span class="badge bg-warning">Pending</a></td>
                    @elseif($booking->status == 1)
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
                        <span class="badge bg-primary">Cancel Aproved</a></td>
                    @else
                        <span class="badge bg-danger">Rejected</a></td>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Cancellation Reason</td>
                <td>
                @isset( $booking->cancelreason )
                        {{ $booking->cancelreason }}
                    @else
                        -
                    @endisset{{ $booking->cancelreason }}
                </td>
            </tr>
            <tr>
                <td>Evidence</td>
                <td>
                    @if($booking->evidence)
                        <img src="{{ asset('uploads/bookings/'.$booking->evidence) }}" style="width:700px;">
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
        </div>
        <div class="text-center">
            <a class="btn btn-warning " href="{{ route('app.admin.booking.index') }}">Back</a>
        </div>
    </div>
</div>
</div>

@endsection