<?php

namespace App\Services;

use App\Models\Appointment;

class AppointmentService
{
    public function createAppointment(array $data): Appointment
    {
        return Appointment::create($data);
    }

    public function updateAppointment(Appointment $appointment, array $data): bool
    {
        return $appointment->update($data);
    }

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $appointment->delete();
    }

    // في AppointmentService
public function getUserAppointments(int $userId)
{
    return Appointment::where('user_id', $userId)->paginate(10);
}



}



