@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg">

        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">إضافة موعد جديد</h1>

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">عنوان الموعد</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded-md @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="appointment_time" class="block text-gray-700 font-semibold">وقت الموعد</label>
                <input type="datetime-local" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}" class="w-full px-4 py-2 border rounded-md @error('appointment_time') border-red-500 @enderror" required>
                @error('appointment_time')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">وصف الموعد</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-semibold">حالة الموعد</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-md @error('status') border-red-500 @enderror">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>ملغى</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-full shadow-md transition duration-200">
                    حفظ الموعد
                </button>
            </div>
        </form>
    </div>
@endsection
