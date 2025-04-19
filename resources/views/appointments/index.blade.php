@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">مواعيدي</h1>

    @if($appointments->isEmpty())
        <p class="text-gray-500">لا توجد مواعيد بعد.</p>
    @else
        <ul>
            @foreach ($appointments as $appointment)
                @php
                    $isPast = \Carbon\Carbon::parse($appointment->appointment_time)->isPast();
                @endphp
                <li class="border-b py-4 px-2 flex justify-between items-center 
                    {{ $isPast ? 'bg-gray-100 text-gray-500' : 'bg-white' }}">
                    
                    <div>
                        <h2 class="font-semibold text-lg">{{ $appointment->title }}</h2>
                        <p class="text-sm">{{ $appointment->appointment_time }}</p>
                        @if($appointment->description)
                            <p class="text-sm text-gray-600 mt-1">{{ $appointment->description }}</p>
                        @endif
                    </div>

                    @if (!$isPast)
                    <div class="flex gap-2">
                        <a href="{{ route('appointments.edit', $appointment) }}" class="text-blue-600 hover:underline">تعديل</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">حذف</button>
                        </form>
                    </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6 text-right">
        <a href="{{ route('appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            إضافة موعد
        </a>
    </div>
</div>
@endsection
