<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class TimeLog extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'note',
    ];

    // RELATIONSHIP
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}