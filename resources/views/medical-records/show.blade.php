@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">Medical Report</h1>
        <p class="text-green-100 mt-1">
            Report No: MR-{{ str_pad($medicalRecord->id, 5, '0', STR_PAD_LEFT) }}
        </p>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ url()->previous() }}"
           class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700">
            Back
        </a>

        <a href="{{ route('medical-records.print', $medicalRecord) }}"
           target="_blank"
           class="px-5 py-2 rounded-xl bg-gray-800 text-white">
            Print Report
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold text-emerald-700 mb-4">
            🐾 Pet & Owner Information
        </h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <p><strong>Pet Name:</strong> {{ $medicalRecord->pet->name ?? 'N/A' }}</p>
            <p><strong>Owner:</strong> {{ $medicalRecord->pet->owner->full_name ?? 'N/A' }}</p>
            <p><strong>Species:</strong> {{ $medicalRecord->pet->species->name ?? 'N/A' }}</p>
            <p><strong>Breed:</strong> {{ $medicalRecord->pet->breed->name ?? 'N/A' }}</p>
            <p><strong>Gender:</strong> {{ $medicalRecord->pet->gender ?? 'N/A' }}</p>
            <p><strong>Colour:</strong> {{ $medicalRecord->pet->color ?? 'N/A' }}</p>
            <p><strong>Date of Birth:</strong>
                {{ $medicalRecord->pet->date_of_birth
                    ? \Carbon\Carbon::parse($medicalRecord->pet->date_of_birth)->format('d M Y')
                    : 'N/A' }}
            </p>
            <p><strong>Weight:</strong> {{ $medicalRecord->pet->weight ?? 'N/A' }} kg</p>
            <p><strong>Owner Phone:</strong> {{ $medicalRecord->pet->owner->phone ?? 'N/A' }}</p>
            <p><strong>Owner Email:</strong> {{ $medicalRecord->pet->owner->email ?? 'N/A' }}</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold text-emerald-700 mb-4">
            📅 Consultation Details
        </h2>

        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <p><strong>Appointment ID:</strong> #{{ $medicalRecord->appointment->id ?? 'N/A' }}</p>

            <p><strong>Appointment Date:</strong>
                {{ $medicalRecord->appointment?->scheduled_at
                    ? \Carbon\Carbon::parse($medicalRecord->appointment->scheduled_at)->format('d M Y, h:i A')
                    : 'N/A' }}
            </p>

            <p><strong>Veterinarian:</strong> {{ $medicalRecord->vet->name ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $medicalRecord->appointment->status ?? 'N/A' }}</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold text-emerald-700 mb-4">
            🩺 Clinical Examination
        </h2>

        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-semibold text-gray-700 mb-1">Presenting Symptoms</p>
                <p class="text-gray-600">{{ $medicalRecord->symptoms ?? 'N/A' }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-semibold text-gray-700 mb-1">Diagnosis</p>
                <p class="text-gray-600">{{ $medicalRecord->diagnosis ?? 'N/A' }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-semibold text-gray-700 mb-1">Treatment Administered</p>
                <p class="text-gray-600">{{ $medicalRecord->treatment ?? 'N/A' }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <p class="font-semibold text-gray-700 mb-1">Veterinarian Notes</p>
                <p class="text-gray-600">{{ $medicalRecord->notes ?? 'N/A' }}</p>
            </div>
        </div>

    </div>

</div>
@endsection