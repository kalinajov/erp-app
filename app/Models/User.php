<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\TimeLog;
use App\Models\Task;
use App\Models\Holiday;
use App\Models\Shift;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // TIME LOGS
    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    // TASKS (UPDATED)
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_assignments')
                    ->withPivot('logged_hours')
                    ->withTimestamps();
    }

    // HOLIDAYS
    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    // SHIFTS
    public function shifts()
    {
        return $this->belongsToMany(Shift::class, 'shift_assignments')
                    ->withTimestamps();
    }
}