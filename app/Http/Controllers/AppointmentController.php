<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Exports\AppointmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);


        return view('appointments.show', compact('appointment'));
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

        $updated = $this->appointmentService->updateAppointment($appointment, [
            'title' => $request->title,
            'description' => $request->description,
            'appointment_time' => $request->appointment_time,
        ]);

        if (!$updated) {
            return redirect()->route('appointments.index')->with('info', 'لم يتم تعديل أي شيء، البيانات كما هي.');
        }

        return redirect()->route('appointments.index')->with('success', 'تم تعديل الموعد بنجاح');
    }




    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    //     public function export()
    // {
    //     $query = $this->appointmentService->getUserAppointmentsQuery(Auth::id());
    //     // $export = new AppointmentsExport($appointments);
    //     $export = new AppointmentsExport($query);
    //     return Excel::download($export, 'appointments_' . now()->format('Y_m_d_H_i_s') . '.xlsx');
    // }


    public function export()
    {
        try {
            DB::beginTransaction();
            $query = $this->appointmentService->getUserAppointmentsQuery(Auth::id());
            $export = new AppointmentsExport($query);
            // return Excel::download($export, 'appointments_' . now() . '.xlsx');
            $fileName = 'appointments_' . now()->format('Y_m_d_H_i_s') . '.xlsx';
            $result = Excel::download($export, $fileName);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error exporting appointments: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'فشل في تصدير المواعيد.');
        }
    }
}
