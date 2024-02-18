<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Booking;
use Illuminate\Console\Command;

class CheckExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expiredBookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update statuses for expired bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $expiredBookings = Booking::where('end_date', '<', $now)->get();

        foreach ($expiredBookings as $booking) {
            if (!in_array($booking->status, [3,5,6])){
                Lot::where('id', $booking->lot_id)->update([
                    'status' => 1,
                    'hex' => '008000',
                ]);

                Booking::where('id', $booking->id)->whereNotIn('status', [3,5,6])->update([
                    'status' => 4,
                ]);
            }
        }
        $this->info('Expired bookings checked and updated successfully.');
    }
}
