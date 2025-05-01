<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Appointment;

class AppointmentRequest extends FormRequest
{

    public function authorize()
    {
        $appointment = $this->route('appointment');
        return $this->user()->can('update', $appointment); 
    }


    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'appointment_time' => 'required|date',
        ];
    }
}
