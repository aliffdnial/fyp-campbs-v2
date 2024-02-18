<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public function booking():HasOne
    {
        return $this->hasOne(Booking::class,'payid');
    }

    public function user():HasOne
    {
        return $this->hasOne(User::class,'user_id');
    }
    
}
