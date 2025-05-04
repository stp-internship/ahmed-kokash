<?php

namespace App\Observers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentObserver
{
    public function created(Appointment $appointment)
    {
        Log::info("تم إنشاء موعد جديد: {$appointment->id} بواسطة المستخدم {$appointment->user_id}");
    }

    public function updated(Appointment $appointment)
    {
        Log::info("تم تعديل الموعد رقم {$appointment->id}");
    }

    public function deleted(Appointment $appointment)
    {
        Log::warning("تم حذف الموعد رقم {$appointment->id} بواسطة المستخدم {$appointment->user_id}");
    }
}
