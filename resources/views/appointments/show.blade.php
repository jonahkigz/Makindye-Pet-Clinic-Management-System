@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Appointment Details</h1>
                <p class="text-green-100 mt-1">
                    Full appointment information, pet details, owner details, and visit status.
                </p>
            </div>

            <a href="{{ route('appointments.index') }}"
               class="bg-white text-emerald-700 px-5 py-2 rounded-xl font-semibold shadow">
                Back
            </a>
        </div>
    </div>

    @php
        $status = strtolower($appointment->status ?? 'pending');
        $isPetOwner = auth()->user()->role === 'Pet Owner';
    @endphp

    {{-- MAIN CARD --}}
    <div class="bg-white p-6 rounded-2xl shadow space-y-6">

        {{-- STATUS --}}
        <div class="flex justify-between items-center border-b pb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    🐾 {{ $appointment->pet->name ?? 'N/A' }}
                </h2>

                <p class="text-gray-500 text-sm">
                    Appointment Date:
                    {{ $appointment->scheduled_at
                        ? \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y, h:i A')
                        : 'Not Scheduled'
                    }}
                </p>
            </div>

            @if($status === 'completed')
                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                    Completed
                </span>
            @elseif($status === 'cancelled')
                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                    Cancelled
                </span>
            @elseif($status === 'in consultation')
                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                    In Consultation
                </span>
            @else
                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                    Pending
                </span>
            @endif
        </div>

        {{-- APPOINTMENT INFO --}}
        <div>
            <h3 class="text-lg font-bold text-emerald-700 mb-3">Appointment Information</h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Reason for Visit</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->reason ?? 'Not provided' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Assigned Veterinarian</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->vet->name ?? 'Unassigned' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Created On</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->created_at
                            ? $appointment->created_at->format('d M Y, h:i A')
                            : 'N/A'
                        }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Last Updated</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->updated_at
                            ? $appointment->updated_at->format('d M Y, h:i A')
                            : 'N/A'
                        }}
                    </p>
                </div>
            </div>
        </div>

        {{-- PET INFO --}}
        <div>
            <h3 class="text-lg font-bold text-emerald-700 mb-3">Pet Information</h3>

            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Pet Name</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->pet->name ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Gender</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->pet->gender ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Date of Birth</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->pet->date_of_birth
                            ? \Carbon\Carbon::parse($appointment->pet->date_of_birth)->format('d M Y')
                            : 'N/A'
                        }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Color</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->pet->color ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Weight</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->pet->weight ? $appointment->pet->weight . ' Kg' : 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- OWNER INFO --}}
        <div>
            <h3 class="text-lg font-bold text-emerald-700 mb-3">Owner Information</h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Full Name</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->owner->full_name ?? $appointment->pet->owner->full_name ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->owner->phone ?? $appointment->pet->owner->phone ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->owner->email ?? $appointment->pet->owner->email ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-sm text-gray-500">Address</p>
                    <p class="font-semibold text-gray-800">
                        {{ $appointment->owner->address ?? $appointment->pet->owner->address ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- MEDICAL RECORD --}}
        <div>
            <h3 class="text-lg font-bold text-emerald-700 mb-3">Medical Record</h3>

            @if($appointment->medicalRecord)
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Symptoms</p>
                        <p class="font-semibold text-gray-800">
                            {{ $appointment->medicalRecord->symptoms ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Diagnosis</p>
                        <p class="font-semibold text-gray-800">
                            {{ $appointment->medicalRecord->diagnosis ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Treatment</p>
                        <p class="font-semibold text-gray-800">
                            {{ $appointment->medicalRecord->treatment ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Vet Notes</p>
                        <p class="font-semibold text-gray-800">
                            {{ $appointment->medicalRecord->notes ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 text-yellow-700 p-4 rounded-xl">
                    Medical record has not yet been created for this appointment.
                </div>
            @endif
        </div>

        {{-- ACTIONS --}}
        <div class="flex flex-wrap gap-3 pt-4 border-t">

            @if(!$isPetOwner)

                @if($status !== 'completed')
                    <a href="{{ route('appointments.medical-record.create', $appointment) }}"
                       class="bg-emerald-600 text-white px-5 py-2 rounded-xl">
                        Complete Visit
                    </a>
                @endif

                <a href="{{ route('appointments.edit', $appointment) }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                    Edit Appointment
                </a>

            @endif

            @if($appointment->medicalRecord)
                <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
                   class="bg-green-700 text-white px-5 py-2 rounded-xl">
                    View Report
                </a>
            @endif

            @if($appointment->pet)
                <a href="{{ route('medical-records.history', $appointment->pet) }}"
                   class="bg-gray-100 text-gray-700 px-5 py-2 rounded-xl">
                    View History
                </a>
            @endif

            <button onclick="window.print()"
                    class="bg-gray-800 text-white px-5 py-2 rounded-xl">
                Print
            </button>

        </div>

    </div>

</div>
@endsection