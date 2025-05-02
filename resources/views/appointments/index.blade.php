@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">


    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-md text-center transition-opacity duration-500"
        >
            {{ session('success') }}
        </div>
    @endif


    @if (session('info'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded-md text-center transition-opacity duration-500"
        >
            {{ session('info') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">مواعيدي</h1>

    @if($appointments->isEmpty())
        <p class="text-gray-500 text-center">لا توجد مواعيد بعد.</p>
    @else
        <ul>
            @foreach ($appointments as $appointment)
                @php
                    $isPast = \Carbon\Carbon::parse($appointment->appointment_time)->isPast();
                @endphp
                <li class="border-b py-6 px-4 flex justify-between items-center
                    {{ $isPast ? 'bg-gray-100 text-gray-500' : 'bg-white shadow-md' }} rounded-lg mb-4">

                    <div class="w-3/4">
                        <h2 class="font-semibold text-xl text-gray-800">{{ $appointment->title }}</h2>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d M Y H:i') }}</p>
                        @if($appointment->description)
                            <p class="text-sm text-gray-600 mt-2">{{ $appointment->description }}</p>
                        @else
                            <p class="text-sm text-gray-400 mt-2">لا يوجد وصف للموعد</p>
                        @endif
                    </div>

                    <div class="flex flex-col items-end space-y-2">
                        @if (!$isPast)
                            <div class="flex gap-4">
                                <a href="{{ route('appointments.edit', $appointment) }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                                    تعديل
                                </a>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-200">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        @endif
                        <a href="{{ route('appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-700 text-sm mt-2">
                            <i class="fas fa-info-circle"></i> عرض التفاصيل
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    @endif

    <div class="mt-8 text-right">
        <a href="{{ route('appointments.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-full shadow-md transition duration-200">
            إضافة موعد جديد
        </a>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('appointments.export') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-6 rounded-full shadow-md transition duration-200">
            <i class="fas fa-download"></i> تصدير المواعيد إلى Excel
        </a>
    </div>
</div>
@endsection
