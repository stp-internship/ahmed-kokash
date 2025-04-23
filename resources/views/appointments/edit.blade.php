@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">تعديل الموعد</h1>

    <form action="{{ route('appointments.update', $appointment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">عنوان الموعد</label>
            <input type="text" name="title" id="title" value="{{ old('title', $appointment->title) }}"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $appointment->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="appointment_time" class="block text-sm font-medium text-gray-700">وقت الموعد</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time"
                value="{{ \Carbon\Carbon::parse(old('appointment_time', $appointment->appointment_time))->format('Y-m-d\TH:i') }}"
                min="{{ now()->format('Y-m-d\TH:i') }}"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('appointment_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('appointments.index') }}" class="text-gray-600 hover:underline">رجوع</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                حفظ التعديلات
            </button>
        </div>
    </form>
</div>
@endsection
