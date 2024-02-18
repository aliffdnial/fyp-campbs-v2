<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lot;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $lots = Lot::all();
        $total_booking = Booking::count();
        $total_pending = Booking::where('status', 0)->count();
        $total_approve = Booking::where('status', 2)->count();
        $total_reject = Booking::where('status', 3)->count();

        $weeklyProfits = Booking::selectRaw('YEAR (start_date) as profit_year,WEEK(start_date) as profit_week, SUM(totalprice) as total_profit_week')
        ->whereNotIn('status', [0,1,3,5,6]) // Exclude booking with status 0[PENDING],3[REJECTED],5[CANCEL],6[CANCEL APPROVED]
        ->groupBy('profit_year', 'profit_week')->orderBy('profit_year', 'asc')->get();

        // Monthly profit overview
        $monthlyProfits = Booking::selectRaw('YEAR (start_date) as profit_year,MONTH(start_date) as profit_month, SUM(totalprice) as total_profit_month')
        ->whereNotIn('status', [0,1,3,5,6]) // Exclude booking with status 0[PENDING],3[REJECTED],5[CANCEL],6[CANCEL APPROVED]
        ->groupBy('profit_year', 'profit_month')->orderBy('profit_year', 'asc')->get();

        // Yearly profit overview
        $yearlyProfits = Booking::selectRaw('YEAR(start_date) as profit_year, SUM(totalprice) as total_profit_year')
        ->whereNotIn('status', [0,1,3,5,6]) // Exclude booking with status 0[PENDING],3[REJECTED],5[CANCEL],6[CANCEL APPROVED]
        ->groupBy('profit_year')->orderBy('profit_year', 'asc')->get();

        return view("admin.dashboard", compact('lots', 'total_booking', 'total_pending', 'total_approve', 'total_reject', 'weeklyProfits'
        ,'monthlyProfits','yearlyProfits'));
    }
}