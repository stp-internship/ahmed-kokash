@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">إضافة موعد جديد</h1>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        {{-- العنوان --}}
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">عنوان الموعد</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- الوصف (اختياري) --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- وقت الموعد --}}
        <div class="mb-4">
            <label for="appointment_time" class="block text-sm font-medium text-gray-700">وقت الموعد</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time"
                value="{{ old('appointment_time') }}"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('appointment_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- زر الحفظ --}}
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('appointments.index') }}" class="text-gray-600 hover:underline">رجوع</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                حفظ الموعد
            </button>
        </div>
    </form>
</div>
@endsection
