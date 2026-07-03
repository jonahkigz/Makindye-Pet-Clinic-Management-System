@extends('layouts.app')

@section('content')
@php
    $appointment = $appointment ?? null;
@endphp

<div class="p-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            {{ $appointment ? 'Complete Visit Medical Report' : 'Add Medical Record' }}
        </h1>
        <p class="text-gray-500">
            {{ $appointment ? 'Fill in the consultation findings below. Saving this report will mark the appointment as completed.' : 'Create a medical record manually.' }}
        </p>
    </div>

    @if($appointment)
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-bold text-emerald-900 mb-4">Visit Summary</h2>

            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <p><strong>Pet:</strong> {{ $appointment->pet->name ?? 'N/A' }}</p>
                <p><strong>Owner:</strong> {{ $appointment->owner->full_name ?? $appointment->owner->name ?? 'N/A' }}</p>
                <p><strong>Veterinarian:</strong> {{ $appointment->vet->name ?? 'N/A' }}</p>
               <p><strong>Visit Date:</strong> {{ $appointment && $appointment->scheduled_at ? $appointment->scheduled_at->format('d M Y') : 'N/A' }}</p>
                <p><strong>Reason:</strong> {{ $appointment->reason ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $appointment->status ?? 'N/A' }}</p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('medical-records.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf

        @if($appointment)
            <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}">
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
            <input type="hidden" name="vet_id" value="{{ $appointment->vet_id }}">
        @else
            <div>
                <label class="block mb-2 font-medium text-gray-700">Pet</label>
                <select name="pet_id" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" required>
                    <option value="">Select Pet</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium text-gray-700">Appointment</label>
                <select name="appointment_id" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">No Appointment</option>
                    @foreach($appointments as $item)
                        <option value="{{ $item->id }}">
                          {{ $item && $item->scheduled_at ? $item->scheduled_at->format('d M Y') : 'No date' }} - {{ $item->pet->name ?? 'Pet' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium text-gray-700">Veterinarian</label>
                <select name="vet_id" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Select Vet</option>
                    @foreach($vets as $vet)
                        <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div>
            <label class="block mb-2 font-medium text-gray-700">Symptoms</label>
            <textarea name="symptoms" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('symptoms') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Diagnosis</label>
            <textarea name="diagnosis" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('diagnosis') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Treatment</label>
            <textarea name="treatment" rows="3" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('treatment') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Veterinarian Notes</label>
            <textarea name="notes" rows="4" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('notes') }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ $appointment ? route('appointments.index') : route('medical-records.index') }}" class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200">
                Cancel
            </a>

            <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
                {{ $appointment ? 'Save Medical Report' : 'Save Medical Record' }}
            </button>
        </div>
    </form>

</div>
@endsection
