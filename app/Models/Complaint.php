<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'description','status','suggestion',
      ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function complaint():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
