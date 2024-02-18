<?php

namespace App\Http\Controllers;

// use App\Models\Booking;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ToyyibpayController extends Controller
{
    // CREATE BILL
    public function createBill(Request $request, Booking $booking)
    {
        $booking = Booking::findOrFail($booking);
        dd($booking);
        $option = array(
            'userSecretKey' => config('toyyibpay.key'),
            'categoryCode' => config('toyyibpay.category'),
            'billName' => 'Booking Payment',
            'billDescription' => 'Booking Number. ' .'$booking->id',
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount' => $booking->totalprice * 100,
            'billReturnUrl' => route('app.toyyibpay-status'),
            'billCallbackUrl' => route('app.toyyibpay-callback'),
            'billExternalReferenceNo' => 'CampBS-0001',
            'billTo' => '$booking->user->name',
            'billEmail' => '$booking->user->email',
            'billPhone' => '$booking->user->phonenum',
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => '0',
            'billContentEmail' => 'Hope your looking forward for your stay at our campsite. Have a nice day!',
            'billChargeToCustomer' => 2,
            'billExpiryDate' => '17-12-2020 17:00:00',
            'billExpiryDays' => 3
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
    public function paymentStatus()
    {
        $response = request()->all(['status_id', 'billcode', 'order_id']);
        return $response;
    }

    //CALLBACK
    public function callback()
    {
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']); //PROCESS NOT IN BROWSER
        Log::info($response); //CHECK THE PROCESS IN LOG
    }
}
