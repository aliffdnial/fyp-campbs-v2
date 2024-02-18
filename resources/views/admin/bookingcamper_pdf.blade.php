<html>
<head>
    <title>Booking Details</title>

    <style type="text/css">
        /* @page { margin: 50px 80px; } */
        @page { margin: 0px 0px; }
        @font-face {
            font-family: 'RobotoMedium';
            src: url({{ storage_path('fonts\Roboto-Medium.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'RobotoRegular';
            src: url({{ storage_path('fonts\Roboto-Regular.ttf') }}) format("truetype");
        }
        body, h1, h2, h3, h4, h5, h6, .bold {
            font-family: RobotoMedium;
            margin-top: 1.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }
        td, span, pre {
            font-family: RobotoRegular;
            font-size: 12px;
        }
        .hr {
            border: none;
            height: 1px;
            color: #CCC;
            background-color: #CCC;
        }
        .header {
           border: 1px solid #ffffff; 
            background-color: #ffffff;
            color: #FFF;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            text-align: center;
        }
        .header img {
            width: 100%;
            height: auto;
        }
        pre {
            white-space: pre-wrap;
        }

        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
        }
        table {
            page-break-inside: avoid !important;
        }
        .pagenum:before {
            content: 'Page ' counter(page);
        }
        .page-break {
            page-break-after: always;
        }
        .border {
            border: 1px solid #999;
        }
    </style>
</head>

<body>
    <table class="table" cellpadding="5" cellspacing="0" style="width:100%">
        <tr>
            <td class="border">Booking ID</td>
            <td class="border">{{ $booking->id }}</td>
        </tr>
        <tr>
            <td class="border">Date</td>
            <td class="border">{{ date('d-m-Y H:i:s', strtotime($booking->created_at)) }}</td>
        </tr>
        <tr>
            <td class="border">Camper Name</td>
            <td class="border">{{ $booking->user->name }}</td>
        </tr>
        <tr>
            <td class="border">Lot Name</td>
            <td class="border">{{ $booking->lot->name }} {{ $booking->lot->facilities }}</td>
        </tr>
        <tr>
            <td class="border">Bill Code</td>
            @if($booking->paymentstatus == 1)
            <td class="border">{{ $booking->billcode }}</td>
            @else
            <td class="border">Not Available</td>
            @endif
        </tr>
        <tr>
            <td class="border">Start Date</td>
            <td class="border">{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
        </tr>
        <tr> 
            <td class="border">End Date</td>
            <td class="border">{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
        </tr>
        <tr>
            <td class="border">Duration</td>
            <td class="border">{{ $booking->numdays }} day(s)</td>
        </tr>
        <tr>
            <td class="border">Number of Pax</td>
            <td class="border">{{ $booking->pax }}</td>
        </tr>   
        <tr>
            <td class="border">Total payment</td>
            <td class="border">RM {{ $booking->totalprice }}</td>
        </tr> 
        <tr>
            <td class="border">Paid At</td>
            <td class="border">{{ date('d-m-Y H:i:s', strtotime($booking->paid_at)) }}</td>
        </tr>   
        <tr>
            <td class="border">Payment Status</td>
            <td class="border">
                @if($booking->paymentstatus == "0")
                    <span style="color:red">Unpaid</a></td>
                @elseif($booking->paymentstatus == "1")
                    <span style="color:green">Paid</a></td>
                @else
                    <span style="color:orange">Unsuccessful</a></td>
                @endif
            </td>
        </tr>
        <tr>
            <td class="border">Remark</td>
            @isset($booking->remark)
                <td class="border">{{ $booking->remark }}</td>
            @else
                <td class="border">-</td>
            @endisset
        </tr>
        <tr>
            <td class="border">Status</td>
            <td class="border">
                @if($booking->status=="0")
                    <span style="color:orange">Pending</a></td>
                @elseif($booking->status=="1")
                    <span style="color:black">Under Review</a></td>
                @elseif($booking->status=="2")
                    <span style="color:green">Approved</a></td>
                @elseif($booking->status=="4")
                    <span style="color:grey">Past</a></td>
                @elseif($booking->status=="5")
                    <span style="color:blue">Cancel</a></td>
                @elseif($booking->status=="6")
                    <span style="color:blue">Cancel Approved</a></td>
                @else
                    <span style="color:red">Rejected</a></td>
                @endif
            </td>
        </tr>
        <tr>
            <td class="border">Cancellation Reason</td>
            @isset($booking->cancelreason)
            <td class="border">{{ $booking->cancelreason }}</td>
            @else
                <td class="border">-</td>
            @endisset
        </tr>
        <tr>
            <td class="border">Evidence</td>
            <td class="border">
                @if($booking->evidence)
                   {{ $booking->evidence }}
                @else
                -
                @endif
            </td>
        </tr>
    </table>
    <div class="footer">
        <center><p>Generated on {{ date('d/m/Y H:i:s') }}</p>
        © Anom Campsite 2023</center>
    </div>
    </body>
</html>