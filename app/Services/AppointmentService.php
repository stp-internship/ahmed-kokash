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
    $data['appointment_time'] = \Carbon\Carbon::parse($data['appointment_time'])->format('Y-m-d H:i:00');


    if (isset($data['status']) && is_object($data['status'])) {
        $data['status'] = $data['status']->value;
    }


    $appointment->fill($data);

    if (!$appointment->isDirty()) {
        return false;
    }

    $appointment->save();

    return true;
}

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $appointment->delete();
    }

    public function getUserAppointments(int $userId)
    {
        return Appointment::where('user_id', $userId)->paginate(10);
    }

    public function getUserAppointmentsQuery(int $userId)
    {
        return Appointment::with('user')->where('user_id', $userId);
    }
}
