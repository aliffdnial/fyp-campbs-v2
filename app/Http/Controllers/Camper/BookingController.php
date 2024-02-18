<?php

namespace App\Http\Controllers\Camper;

use Auth;
use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camper = Auth::user();
        $lots = Lot::all();
        $booking = Booking::where('user_id', $camper->id)->first();
        $bookings = Booking::where('user_id', $camper->id)->paginate(7);

        return view("camper.booking_index", compact('booking','bookings', 'lots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = new Booking();
        $lots = Lot::all();
        return view('camper.booking_form', compact('booking', 'lots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lot_id' => 'required|exists:lots,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pax' => 'required|integer',
            'remark' => 'nullable|string',
            ]);

            // Fetch lot price based on the selected lot ID
            $lot = Lot::findOrFail($request->input('lot_id'));
            $lotPrice = $lot->price;
            
            // Calculate total price by summing lot price and deposit price multiplied by the number of pax
            $depositPrice = 15.00; // Fixed deposit price
            $totalPrice = $lotPrice + ($request->input('pax') * $depositPrice);
            $numdays =  $request->input('numdays');

            $booking = new Booking();
            $booking->fill($request->all());
            $booking->totalprice = $totalPrice;
            $booking->numdays = $numdays;
            $booking->lot_id = $request->input('lot_id');
            $booking->user_id = Auth::user()->id;
            // $booking->lot->status = 0; //LOT JADI UNAVAILABLE
            // $booking->lot->hex = 'ff0000'; //RED COLOR
            $booking->lot->save();
            $booking->save();
            
            return redirect()->route('app.booking.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $lots = Lot::all();
        //CHECK STATUS BOOKING & OTHER BOOKING ID
        if($booking->status > 0 && Auth()->user()->id){
            abort(404);
        }else{
            return view ("camper.booking_form", compact('booking','lots'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->validate($request, [
            'lot_id' => 'required|exists:lots,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pax' => 'required|integer',
            'remark' => 'nullable|string',
            ]);
            
            // Fetch lot price based on the selected lot ID
            $lot = Lot::findOrFail($request->input('lot_id'));
            $lotPrice = $lot->price;

            // Calculate total price by summing lot price and deposit price multiplied by the number of pax
            $depositPrice = 15.00; // Fixed deposit price
            $totalPrice = $lotPrice + ($request->input('pax') * $depositPrice);
            $numdays =  $request->input('numdays');
            $booking->fill($request->all());
            $booking->totalprice = $totalPrice;
            $booking->numdays = $numdays;
            $booking->lot_id = $request->input('lot_id');
            $booking->user_id = Auth::user()->id;
            
            $booking->save();
            return redirect()->route('app.booking.index');
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
        
        return redirect()->route('app.booking.index');
    }

    public function cancel(Booking $booking)
    {
        $lots = Lot::all();
        return view ("camper.cancel_form", compact('booking','lots'));
    }

    public function cancelprocess(Request $request, $booking)
    {
        $booking = Booking::findOrFail($booking);
        // Validate the cancellation reason
        $this->validate($request, [
            'cancelreason' => 'required|string|max:255',
            'evidence'=> 'required|mimes:jpeg,jpg,png|max:10000', //10mb MAX
        ]);

        $booking->fill($request->all());
        $cancelreason =  $request->input('cancelreason');
        $booking->cancelreason = $cancelreason;
        $booking->status = 5;
        
        if($request['evidence']){
            $directory =  $_SERVER['DOCUMENT_ROOT']."/uploads/bookings";
            if(!file_exists($directory)){
                mkdir($directory, 0755, true);
            }
            $filename = "cancelbooking_".$booking->id."_".time().".".$request->evidence->getClientOriginalExtension(); //RENAME TO NEW FILE
            $file = $request->file('evidence');
            $file->move($directory, $filename);

            $booking->evidence= $filename;
            $booking->save();
        }
        $booking->save();

        return redirect()->route('app.booking.index')->with('success', 'Your booking cancellation will be overview by the admin. Please check from time to time');
    }

    // CREATE BILL
    public function createBill(Request $request, Booking $booking)
    {
        // Retrieve booking details based on $id
        $booking = Booking::find($booking->id);

        $option = array(
            'userSecretKey' => config('toyyibpay.key'),
            'categoryCode' => config('toyyibpay.category'),
            'billName' => 'Booking Payment_'.$booking->id.'_'.$booking->user->name,
            'billDescription' => 'Booking_Number_'. $booking->id .'_'. $booking->user->name .'_'. $booking->updated_at,
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount' => $booking->totalprice * 100,
            'billReturnUrl' => route('app.booking.paymentStatus', $booking->id),
            'billCallbackUrl' => route('app.booking.callback', $booking->id),
            'billExternalReferenceNo' => 'CampBS'.'_'. $booking->id,
            'billTo' => $booking->user->name,
            'billEmail' => $booking->user->email,
            'billPhone' => $booking->user->phonenum,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => '0',
            'billContentEmail' => 'Hope your looking forward for your stay at our campsite. Have a nice day!',
            'billChargeToCustomer' => 2,
            'enableFPXB2B' => 1
          );

          $url = 'https://dev.toyyibpay.com/index.php/api/createBill';

          $response = Http::asForm()->post($url, $option);
          if(isset($response['0'])){
            $billCode = $response['0']['BillCode'];
            return redirect('https://dev.toyyibpay.com/' . $billCode);
            
          } else{
            // Handle the case where 'BillCode' is not present in the response
            // You might want to log an error or return a response indicating the issue
            return back()->withErrors(['message' => 'Failed to create bill. Please try again.']);
          }

    }

    //REDIRECT AFTER PAYMENT SUCCESS/FAILED
    public function paymentStatus(Booking $booking)
    {
        $booking = Booking::find($booking->id);
        $response = request()->all(['status_id', 'billcode', 'order_id']);
        
        $paymentStatus = request('status_id');
        if($paymentStatus == 1) {
            $booking->paymentstatus = 1;
            $booking->status = 1; //UNDER REVIEW
            $booking->lot->status = 0; //LOT JADI UNAVAILABLE
            $booking->lot->hex = 'ff0000'; //RED COLOR
            $booking->paid_at = Carbon::now();
            $booking->billcode = $response['billcode'];
            $booking->save();
            $booking->lot->save();

            return redirect()->route('app.booking.index')->with('success', 'Payment successful. Your booking is confirmed.');
        }else{
            // If the payment fails
            $booking->paymentstatus == 2; // Update payment status to indicate failure
            $booking->paid_at = Carbon::now();
            $booking->save();

            return redirect()->route('app.booking.index')->with('error', 'Payment failed. Please try again.');
        }
    }

    //CALLBACK
    // public function callback(Booking $booking, Payment $payment)
    // {
    //     $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']); //PROCESS NOT IN BROWSE
    //     Log::info($response); //CHECK THE PROCESS IN LOG
    // }

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

    //         // Process the $billTransactions array as needed
    //         // For example, you can store it in a variable and pass it to a view

    //         return view('camper.booking_receipt', compact('billTransactions'));
    //     } else {
    //         // Handle API request failure
    //         return redirect()->route('app.booking.index')->with('error', 'Failed to retrieve bill transactions.');
    //     }
    // }

    public function payment(Booking $booking)
    {
        $camper = Auth::user();
        return view('camper.booking_payment', compact('booking', 'camper'));
    }
    public function payment0(Booking $booking)
    {
        $camper = Auth::user();
        return view('camper.payment0', compact('booking', 'camper'));
    }
    public function payment1(Booking $booking)
    {
        $camper = Auth::user();
        return view('camper.payment1', compact('booking', 'camper'));
    }
    public function payment2(Booking $booking)
    {
        $camper = Auth::user();
        return view('camper.payment2', compact('booking', 'camper'));
    }
    public function payment3(Booking $booking)
    {
        $camper = Auth::user();
        return view('camper.payment3', compact('booking', 'camper'));
    }
    public function payment4(Booking $booking)
    {
        $camper = Auth::user();
        $lots = Lot::whereIn('id', $booking->pluck('lot_id'))->get();
        
        return view('camper.payment4', compact('booking', 'camper', 'lots'));
    }
    public function payment5(Booking $booking)
    {
        $camper = Auth::user();
        $lots = Lot::whereIn('id', $booking->pluck('lot_id'))->get();
        $billCode = Str::random(8); // Generate an 8-character random string
        $booking->paymentstatus = 1;
        $booking->status = 1;
        $booking->lot->status = 0; //LOT JADI UNAVAILABLE
        $booking->lot->hex = 'ff0000'; //RED COLOR
        $booking->paid_at = Carbon::now();
        $booking->billCode = $billCode; // Set the billCode
        $booking->save();
        $booking->lot->save();

        return view('camper.payment5', compact('booking', 'camper', 'lots'));
    }
    public function process_card(Booking $booking)
    {
        $camper = Auth::user();
        $lots = Lot::whereIn('id', $booking->pluck('lot_id'))->get();
        $billCode = Str::random(8); // Generate an 8-character random string
        $booking->paymentstatus = 1;
        $booking->status = 1;
        $booking->lot->status = 0; //LOT JADI UNAVAILABLE
        $booking->lot->hex = 'ff0000'; //RED COLOR
        $booking->paid_at = Carbon::now();
        $booking->billCode = $billCode; // Set the billCode
        $booking->save();
        $booking->lot->save();

        return view('camper.process_card', compact('booking', 'camper', 'lots'));
        // return redirect()->route('app.booking.index');
    }
}
