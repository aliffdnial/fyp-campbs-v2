<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Booking;
use Illuminate\Console\Command;

class CheckFutureBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:futureBookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update statuses for future bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get future bookings (example logic)
        $futureBookings = Booking::where('start_date', '>', Carbon::now())->get();

        foreach ($futureBookings as $booking) {
            // Check if the start date is within 3 days, and update lot status accordingly
            $daysUntilStartDate = Carbon::parse($booking->start_date)->diffInDays(Carbon::now());
            if ($daysUntilStartDate <= 5) {
                Lot::where('id', $booking->lot_id)->update(['status' => 0, 'hex' => 'ff0000']);
                Booking::where('id', $booking->id)->update(['status' => 2]);
            }
        }
        
        // Your logic to check and update future bookings
        $this->info('Future bookings checked and updated successfully.');
    }
}
