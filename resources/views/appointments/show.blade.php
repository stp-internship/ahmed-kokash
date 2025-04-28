@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">تفاصيل الموعد</h1>

    <div class="mb-4">
        <h2 class="font-semibold text-lg">{{ $appointment->title }}</h2>
        <p class="text-sm">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d M Y H:i') }}</p>
        <p class="text-sm text-gray-600 mt-1">{{ $appointment->description ?? 'لا يوجد وصف للموعد' }}</p>
    </div>

    <div class="flex gap-2 mt-6">
        <a href="{{ route('appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">
            العودة إلى المواعيد
        </a>

        @if(\Carbon\Carbon::parse($appointment->appointment_time)->isFuture()) <!-- تحقق من أن الموعد ليس في الماضي -->
            <a href="{{ route('appointments.edit', $appointment) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                تعديل
            </a>
            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                    حذف
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
