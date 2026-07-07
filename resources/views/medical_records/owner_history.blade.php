@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-blue-600 to-emerald-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">
            Medical History - {{ $pet->name }}
        </h1>
        <p class="text-blue-100 mt-1">
            Previous appointments, treatment reports, and clinical notes.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Previous Appointments
        </h2>

        @forelse($appointments as $appointment)

            <div class="border rounded-2xl p-5 mb-4 bg-gray-50">

                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">
                            Appointment #{{ $appointment->id }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            Date:
                            {{ $appointment->scheduled_at 
                                ? \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y, h:i A') 
                                : 'N/A' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Vet: {{ $appointment->vet->name ?? 'Not assigned' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Status: {{ $appointment->status ?? 'N/A' }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-sm bg-emerald-100 text-emerald-700">
                        {{ $appointment->medicalRecord ? 'Report Available' : 'No Report Yet' }}
                    </span>
                </div>

                @if($appointment->medicalRecord)

                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-sm">

                        <div>
                            <p class="text-gray-500">Symptoms</p>
                            <p class="font-medium">
                                {{ $appointment->medicalRecord->symptoms ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Diagnosis</p>
                            <p class="font-medium">
                                {{ $appointment->medicalRecord->diagnosis ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Treatment</p>
                            <p class="font-medium">
                                {{ $appointment->medicalRecord->treatment ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Vet Notes</p>
                            <p class="font-medium">
                                {{ $appointment->medicalRecord->notes ?? 'N/A' }}
                            </p>
                        </div>

                    </div>

                    <div class="flex gap-3 mt-5">
                        <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                            View Report
                        </a>

                        <a href="{{ route('medical-records.print', $appointment->medicalRecord) }}"
                           target="_blank"
                           class="px-4 py-2 rounded-xl bg-gray-800 text-white text-sm">
                            Print Report
                        </a>
                    </div>

                @else

                    <p class="mt-4 text-sm text-gray-500">
                        No medical report has been added for this appointment yet.
                    </p>

                @endif

            </div>

        @empty

            <div class="text-center bg-gray-50 rounded-2xl p-6">
                <p class="text-gray-500">
                    No previous appointments found for {{ $pet->name }}.
                </p>
            </div>

        @endforelse

    </div>

</div>
@endsection