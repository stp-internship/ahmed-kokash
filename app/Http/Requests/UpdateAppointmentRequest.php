<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اسمح للجميع (أو تحقق من الصلاحيات هنا إذا تحب)
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'appointment_time' => 'required|date|after:now',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
