<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();
        return view('appointments.index', compact('appointments'));
    }
    


    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'appointment_time' => 'required|date|after:now',
        ]);

        Appointment::create([
            'title' => $request->title,
            'description' => $request->description,
            'appointment_time' => $request->appointment_time,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.index');
        }

        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.index');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'appointment_time' => 'required|date|after:now',
        ]);

        $appointment->update([
            'title' => $request->title,
            'description' => $request->description,
            'appointment_time' => $request->appointment_time,
        ]);

        return redirect()->route('appointments.index');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.index');
        }

        $appointment->delete();
        return redirect()->route('appointments.index');
    }
}
