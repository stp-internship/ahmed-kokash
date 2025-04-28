<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment; 

class AppointmentPolicy
{

    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }


    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }
}
