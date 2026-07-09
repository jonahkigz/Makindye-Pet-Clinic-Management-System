@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold">Appointments</h1>
                <p class="text-green-100 mt-1">
                    Manage consultations, visits, and patient care schedules.
                </p>
            </div>

            <a href="{{ route('appointments.create') }}"
               class="bg-white text-emerald-700 px-5 py-2 rounded-xl font-semibold shadow">
                Book Appointment
            </a>

        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- APPOINTMENTS --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-5">

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Appointment List
                </h2>

                <p class="text-sm text-gray-500">
                    Recent and upcoming appointments
                </p>
            </div>

            <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $appointments->count() }} Total
            </span>

        </div>

        <div class="space-y-4">

            @forelse($appointments as $appointment)

                <div class="border rounded-2xl p-5 bg-gray-50 hover:bg-white hover:shadow transition">

                    <div class="flex justify-between items-start">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800">
                                🐾 {{ $appointment->pet->name ?? 'N/A' }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-2">
                                <strong>Owner:</strong>
                                {{ $appointment->owner->full_name ?? $appointment->pet->owner->full_name ?? 'N/A' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                <strong>Veterinarian:</strong>
                                {{ $appointment->vet->name ?? 'Unassigned' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                <strong>Appointment Date:</strong>

                                {{ $appointment->scheduled_at
                                    ? \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y h:i A')
                                    : 'Not Scheduled'
                                }}
                            </p>

                        </div>

                        {{-- STATUS --}}
                        <div>

                            @php
                                $status = strtolower($appointment->status ?? 'pending');
                            @endphp

                            @if($status == 'completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Completed
                                </span>

                            @elseif($status == 'cancelled')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Cancelled
                                </span>

                            @elseif($status == 'in consultation')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    In Consultation
                                </span>

                            @else

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Pending
                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="flex flex-wrap gap-2 mt-5">

                        {{-- PET OWNER --}}
                        @if(auth()->user()->role == 'Pet Owner')

                            @if($status == 'completed' && $appointment->medicalRecord)

                                <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
                                   class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                    View Report
                                </a>

                            @endif

                            @if($appointment->pet)

                                <a href="{{ route('medical-records.history', $appointment->pet) }}"
                                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm">
                                    History
                                </a>

                            @endif

                        {{-- STAFF --}}
                        @else

                            @if($status != 'completed')

                                <a href="{{ route('appointments.medical-record.create', $appointment) }}"
                                   class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm">
                                    Complete Visit
                                </a>

                            @elseif($appointment->medicalRecord)

                                <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
                                   class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm">
                                    View Report
                                </a>

                            @endif

                            <a href="{{ route('appointments.edit', $appointment) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
                                Edit
                            </a>

                            @if($appointment->pet)

                                <a href="{{ route('medical-records.history', $appointment->pet) }}"
                                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm">
                                    History
                                </a>

                            @endif

                            <form action="{{ route('appointments.destroy', $appointment) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this appointment?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm">
                                    Delete
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center py-10">

                    <p class="text-gray-500 mb-4">
                        No appointments found.
                    </p>

                    <a href="{{ route('appointments.create') }}"
                       class="bg-emerald-600 text-white px-5 py-2 rounded-xl">
                        Book Appointment
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>
@endsection