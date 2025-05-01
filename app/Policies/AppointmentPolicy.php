<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }
}
