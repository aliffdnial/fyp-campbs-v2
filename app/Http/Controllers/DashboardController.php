<?php

namespace App\Http\Controllers;

use Auth;

use Carbon\Carbon;

use App\Models\Lot;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $search1 = null;
        $search2 = null;

        if(Auth::user()->usertype == '1'){
            return redirect()->route('app.admin.dashboard');
        }
        else{
            $camper = Auth::user();
            
            if(isset($_GET["search1"]) && !empty($_GET["search1"]) && isset($_GET["search2"]) && !empty($_GET["search2"])){
                // INPUT TYPE DATE
                $search1 = isset($_GET['search1']) ? Carbon::createFromFormat('Y-m-d', $_GET['search1'])->toDateString() : null;
                $search2 = isset($_GET['search2']) ? Carbon::createFromFormat('Y-m-d', $_GET['search2'])->toDateString() : null;
                
                $bookings = Booking::where('user_id', $camper->id)
                    ->where(function ($query) use ($search1, $search2) {
                        $query->whereBetween('start_date', [$search1, $search2])
                            ->orWhereBetween('end_date', [$search1, $search2]);
                    })
                    ->orderBy('start_date', 'desc')
                    ->paginate(6);
            } else {
                $bookings = Booking::where('user_id', $camper->id)
                    ->orderBy('start_date', 'desc')
                    ->paginate(6);
            }

            return view("camper.dashboard", compact('bookings', 'search1', 'search2'));
        }
    }
}