<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'billcode','start_date', 'end_date', 'pax', 'phonenum', 'remark','reason','paid_at'
    ]; 

    public function lot():BelongsTo
    {
        return $this->belongsTo(Lot::class,'lot_id');
    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
