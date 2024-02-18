<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Auth;

use DateTime;
use Carbon\Carbon;
use App\Models\Lot;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = null;
        $search1 = null;
        $search2 = null;

        if(isset($_GET["search"])){
            $search = $_GET['search'];

            $bookings = Booking::with('user', 'lot')
                ->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE','%'.$search.'%');
                })
                ->orWhereHas('lot', function($q) use ($search) {
                    $q->where('name', 'LIKE','%'.$search.'%');
                })
                ->paginate(5);
        } elseif(isset($_GET["search1"]) && !empty($_GET["search1"]) && isset($_GET["search2"]) && !empty($_GET["search2"])) {
            // INPUT TYPE DATE
            $search1 = isset($_GET['search1']) ? Carbon::createFromFormat('Y-m-d', $_GET['search1'])->toDateString() : null;
            $search2 = isset($_GET['search2']) ? Carbon::createFromFormat('Y-m-d', $_GET['search2'])->toDateString() : null;

            $bookings = Booking::with('user', 'lot')
                ->where(function($query) use ($search1, $search2) {
                    $query->whereBetween('start_date', [$search1, $search2])
                        ->whereBetween('end_date', [$search1, $search2]);
                })
                ->paginate(5);
        } else {
            $bookings = Booking::with('user', 'lot')
                ->orderBy('start_date', 'desc')
                ->paginate(6);
        }

        return view("admin.booking_index", compact('bookings', 'search', 'search1', 'search2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view("admin.booking_show", compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if($request['action'] == 'approve'){
            $daysUntilStartDate = Carbon::parse($booking->start_date)->diffInDays(Carbon::now());
            if ($daysUntilStartDate <= 5) {
                Lot::where('id', $booking->lot_id)->update(['status' => 0, 'hex' => 'ff0000']);
            }
            $booking->status='2'; // Booking status Approved
            Lot::where('id', $booking->lot_id)->update(['status' => 0, 'hex'=>'ff0000']);
        }elseif( $request['action'] == 'reject'){
            $booking->status='3'; //Booking status Reject
            Lot::where('id', $booking->lot_id)->update(['status' => 1, 'hex'=>'008000']);
        }elseif( $request['action'] == 'cancel'){
            $booking->status='6'; // Booking status CancelApproved
            Lot::where('id', $booking->lot_id)->update(['status' => 1, 'hex'=>'008000']);
        }
        $booking->save();
        return redirect()->route('app.admin.booking.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        $booking->lot->save();

        // Change the status of the lot to available
        $booking->lot->status = 1;
        $booking->lot->hex = '008000';
        $booking->lot->save();
        
        return redirect()->route('app.admin.booking.index');
    }

    public function pdf(){
        // set_time_limit(600); // Set execution time to 600 seconds
        $bookings = Booking::all();
        
        $pdf = PDF::loadView('admin.booking_pdf', compact('bookings'));

        // Set options for header and footer
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.booking_pdf', compact('bookings'));
        return $pdf->download('booking.pdf');
    }
    public function pdfcamper(Booking $booking){
        $pdf = PDF::loadView('admin.bookingcamper_pdf', compact('booking'));

        // Set options for header and footer
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);
        
        return $pdf->download('booking_camper.pdf');
    }

    // public function getBillTransactions($billCode, Booking $booking)
    // {
    //     $apiUrl = 'https://dev.toyyibpay.com/index.php/api/getBillTransactions';

    //     $requestData = [
    //         'billCode' => $billCode,
    //         'billpaymentStatus' => '1', // You can adjust this based on your needs
    //     ];
        
    //     $response = Http::asForm()->post($apiUrl, $requestData);

    //     if ($response->successful()) {
    //         $billTransactions = $response->json();

    //         return view('admin.booking_receipt', compact('billTransactions'));
    //     } else {
    //         return redirect()->route('app.admin.booking.index')->with('error', 'Failed to retrieve bill transactions.');
    //     }
    // }
}
