<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'appointment_time',
        'status',
        'user_id'
    ];

    protected $dates = [
        'appointment_time',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
        'status' => AppointmentStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
