<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Booking;

class Lot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','size', 'capacity','status','coordinates','hex',
    ];
    public function booking()
    {
        return $this->hasMany(Booking::class, 'lot_id');
    }

    public function getTotalBooking()
    {
        return $this->booking()->whereHas('user', function($query){
            $query->whereNotIn('status', [0,3,5,6]); // Exclude booking with status 0[PENDING],3[REJECTED],5[CANCEL],6[CANCEL APPROVED]
        })->count();
    }

}
