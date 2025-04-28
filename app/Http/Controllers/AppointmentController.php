<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AppointmentController extends Controller
{
    use AuthorizesRequests;

    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        $appointments = $this->appointmentService->getUserAppointments(Auth::id());
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(StoreAppointmentRequest $request)
    {
        $this->appointmentService->createAppointment([
            'title' => $request->title,
            'description' => $request->description,
            'appointment_time' => $request->appointment_time,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('appointments.index')->with('success', 'تم حفظ الموعد بنجاح');
    }

    public function edit(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        return view('appointments.edit', compact('appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {

    $this->authorize('update', $appointment);

        $this->appointmentService->updateAppointment($appointment, [
            'title' => $request->title,
            'description' => $request->description,
            'appointment_time' => $request->appointment_time,
        ]);

        return redirect()->route('appointments.index');
    }

    public function destroy(Appointment $appointment)
    {
        
        $this->authorize('delete', $appointment);

        $this->appointmentService->deleteAppointment($appointment);
        return redirect()->route('appointments.index');
    }

}
