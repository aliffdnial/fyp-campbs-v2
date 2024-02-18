<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->date();
        $endDate = $this->faker->date();

        // return [
        //     'campid' => $this->faker->randomNumber(),
        //     'lotid' => $this->faker->randomNumber(),
        //     'billcode' => $this->faker->unique()->nullable()->word,
        //     'approved_by' => $this->faker->randomNumber(),
        //     'pax' => $this->faker->randomNumber(),
        //     'totalprice' => function (array $attributes) {
        //         return $attributes['pax'] * 15;
        //     },
        //     'paymentstatus' => $this->faker->randomElement([0, 1, 2]),
        //     'paid_at' => $this->faker->dateTimeBetween($startDate, $endDate),
        //     'start_date' => $startDate,
        //     'end_date' => $endDate,
        //     'numdays' => function (array $attributes) {
        //         return \Carbon\Carbon::parse($attributes['end_date'])
        //             ->diffInDays(\Carbon\Carbon::parse($attributes['start_date']));
        //     },
        //     'cancelreason' => $this->faker->text,
        //     'evidence' => $this->faker->text,
        //     'remark' => $this->faker->text,
        //     'status' => $this->faker->randomElement([0, 1, 2, 3, 4, 5]),
        //     'softDeletes' => null,
        //     'timestamps' => now(),
        // ];

        // return [
        //     'campid' => $this->faker->randomNumber(),
        //     'lotid' => $this->faker->randomNumber(),
        //     'billcode' => $this->faker->unique()->nullable()->word,
        //     'approved_by' => $this->faker->randomNumber(),
        //     'pax' => $this->faker->randomNumber(),
        //     'totalprice' => function (array $attributes) {
        //         return $attributes['pax'] * 15;
        //     },
        //     'paymentstatus' => $this->faker->randomElement([0, 1, 2]),
        //     'paid_at' => $this->faker->dateTimeBetween($startDate, $endDate),
        //     'start_date' => $startDate,
        //     'end_date' => $endDate,
        //     'numdays' => function (array $attributes) {
        //         return \Carbon\Carbon::parse($attributes['end_date'])
        //             ->diffInDays(\Carbon\Carbon::parse($attributes['start_date']));
        //     },
        //     'cancelreason' => $this->faker->text,
        //     'evidence' => $this->faker->text,
        //     'remark' => $this->faker->text,
        //     'status' => $this->faker->randomElement([0, 1, 2, 3, 4, 5]),
        //     'softDeletes' => null,
        //     'timestamps' => now(),
        // ];

        return [
            'campid' => $this->faker->numberBetween(1, 10), // Assuming you have 10 camps
            'lotid' => $this->faker->numberBetween(1, 50), // Assuming you have 50 lots
            'billcode' => $this->faker->unique()->regexify('[A-Z0-9]{5}-[A-Z0-9]{5}'),
            'approved_by' => $this->faker->randomElement([null, $this->faker->numberBetween(1, 10)]), // Assuming you have 10 users who can approve
            'pax' => $this->faker->numberBetween(1, 2),
            // 'totalprice' => $this->faker->randomNumber(3) * 15, // Calculate totalprice based on pax
            'totalprice' => $this->faker->numberBetween(1, 2) * 15, // Calculate totalprice based on pax
            'paymentstatus' => $this->faker->randomElement([0, 1, 2]),
            'paid_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'start_date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'end_date' => $this->faker->dateTimeBetween('+3 days', '+6 months'), // Ensure end_date is after start_date
            'numdays' => function (array $booking) {
                $start = Carbon::parse($booking['start_date']);
                $end = Carbon::parse($booking['end_date']);
                return $end->diffInDays($start);
            },
            'cancelreason' => $this->faker->optional()->text(),
            'evidence' => $this->faker->optional()->text(),
            'remark' => $this->faker->optional()->text(),
            'status' => $this->faker->randomElement([0, 1, 2, 3, 4, 5])
        ];
    }
}
