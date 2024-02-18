@extends('layouts.mytemplate_system')
@section('pagetitle')
Admin Booking Receipt
@endsection
@section('content')
    <div class="card">
        @section('pageheader')
            @foreach($billTransactions as $index => $transaction)
                Booking Receipt for {{ $transaction['billDescription'] }}
            @endforeach
        @endsection

        @section('breadcrumb')
            <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Camper Booking Receipt</li>
        @endsection

        <div class="card-body mt-4">
        <table class="table">
                @foreach($billTransactions as $index => $transaction)
                <tr>
                    <td>Name</td>
                    <td>{{ $transaction['billName'] }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $transaction['billDescription'] }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $transaction['billEmail'] }}</td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td>
                        @if($transaction['billpaymentStatus'] == 1)
                            <span class="badge bg-success">Success</a></td>
                        @elseif($transaction['billpaymentStatus'] == 2)
                            <span class="badge bg-warning">Pending</a></td>
                        @elseif($transaction['billpaymentStatus'] == 3)
                            <span class="badge bg-danger">Unsuccessful</a></td>
                        @else
                            <span class="badge bg-secondary">Pending</a></td>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Payment Channel</td>
                    <td>{{ $transaction['billpaymentChannel'] }}</td>
                </tr>
                <tr>
                    <td>Payment Amount (RM)</td>
                    <td>{{ $transaction['billpaymentAmount'] }}</td>
                </tr>
                <tr>
                    <td>Invoice No</td>
                    <td>{{ $transaction['billpaymentInvoiceNo'] }}</td>
                </tr>
                <tr>
                    <td>Payment Made On</td>
                    <td>{{ $transaction['billPaymentDate'] }}</td>
                </tr>
                <tr>
                    <td>External Reference Number</td>
                    <td>{{ $transaction['billExternalReferenceNo'] }}</td>
                </tr>
            </table>
            @endforeach
        </div>

        <div class="text-center">
            <a class="btn btn-warning" href="{{ route('app.admin.booking.index') }}">Back</a>
        </div>
    </div>
@endsection