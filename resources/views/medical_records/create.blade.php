@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Complete Visit Medical Report
        </h1>
        <p class="text-gray-500">
            Fill in the consultation findings below. Saving this report will mark the appointment as completed.
        </p>
    </div>

    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 mb-6">
        <h2 class="text-lg font-bold text-emerald-900 mb-4">Visit Summary</h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <p><strong>Pet:</strong> {{ $appointment->pet->name ?? 'N/A' }}</p>
            <p><strong>Owner:</strong> {{ $appointment->owner->name ?? 'N/A' }}</p>
            <p><strong>Veterinarian:</strong> {{ $appointment->vet->name ?? 'N/A' }}</p>
            <p><strong>Visit Date:</strong> {{ optional($appointment->scheduled_at)->format('d M Y') }}</p>
            <p><strong>Reason:</strong> {{ $appointment->reason ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $appointment->status }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('medical-records.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf

        <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <input type="hidden" name="vet_id" value="{{ $appointment->vet_id }}">

        <div>
            <label class="block mb-2 font-medium text-gray-700">Symptoms</label>
            <textarea name="symptoms" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('symptoms') }}</textarea>
            @error('symptoms') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Diagnosis</label>
            <textarea name="diagnosis" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('diagnosis') }}</textarea>
            @error('diagnosis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Treatment</label>
            <textarea name="treatment" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('treatment') }}</textarea>
            @error('treatment') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Veterinarian Notes</label>
            <textarea name="notes" rows="4" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('notes') }}</textarea>
            @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('appointments.index') }}" class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200">
                Cancel
            </a>

            <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
                Save Medical Report
            </button>
        </div>
    </form>

</div>
@endsection
