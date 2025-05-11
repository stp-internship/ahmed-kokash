@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">

        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">تفاصيل الموعد</h1>

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">العنوان</h3>
            <p class="text-gray-700">{{ $appointment->title }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">وقت الموعد</h3>
            <p class="text-gray-700">{{ $appointment->appointment_time->translatedFormat('l d F Y - h:i A') }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">الوصف</h3>
            <p class="text-gray-700">{{ $appointment->description ?? '—' }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">الحالة</h3>
            <p class="text-gray-700">
                {{ $appointment->status->label() }}
            </p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded-full shadow-md transition duration-200">
                العودة إلى القائمة
            </a>
        </div>

    </div>
@endsection
