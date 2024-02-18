<html>
<head>
    <title>List of Bookings</title>

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
    <div class="header">
        <img src="{{ public_path('uploads/pdf/header.png') }}" alt=""/>
    </div>
   
    <table cellpadding="5" cellspacing="0" style="width:25%">
        <tr>
            <th class="bold border">No</th>
            <th class="bold border">Date</th>
            <th class="bold border">Camper Name</th>
            <th class="bold border">Lot Name</th>
            <th class="bold border">Start Date</th>
            <th class="bold border">End Date</th>
            <th class="bold border">Number of Pax</th>
            <th class="bold border">Total Payment</th>
            <th class="bold border">Paid At</th>
            <th class="bold border">Bill Code</th>
            <th class="bold border">Remark</th>
            <th class="bold border">Status</th>
        </tr>
        @foreach($bookings as $booking)
        <tr>
            <td class="border">{{ $booking->id }}</td>
            <td class="border">{{ date('d-m-Y H:i:s', strtotime($booking->created_at)) }}</td>
            <td class="border">{{ $booking->user->name }}</td>
            <td class="border">{{ $booking->lot->name }}</td>
            <td class="border">{{ date('d-m-Y', strtotime($booking->start_date)) }}</td>
            <td class="border">{{ date('d-m-Y', strtotime($booking->end_date)) }}</td>
            <td class="border">{{ $booking->pax }} person(s)</td>
            <td class="border">RM {{ $booking->totalprice }}</td>
            <td class="border">
                @isset($booking->paid_at)
                    {{ date('d-m-Y H:i:s', strtotime($booking->paid_at)) }}
                @else
                   -
                @endisset
            <td class="border">
                @isset($booking->billcode)
                    {{ $booking->billcode }}
                @else
                    Not Available
                @endisset
            </td>
            <td class="border">
                @isset( $booking->remark )
                    {{ $booking->remark }}
                @else
                   -
                @endisset
            </td>
            <td class="border">
                @if($booking->status=="0")
                    <span style="color:orange;">Pending</a></td>
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
        @endforeach
    </table>

    <div class="footer">
        <center><p>Generated on {{ date('d/m/Y H:i:s') }}</p>
        © Anom Campsite 2023</center>
    </div>
    </body>
</html>