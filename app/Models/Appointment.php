<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'appointment_time',
        'user_id'
    ];

    protected $dates = ['appointment_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
