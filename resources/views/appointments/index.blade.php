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

    {{-- APPOINTMENT CARDS --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Appointment List</h2>
                <p class="text-sm text-gray-500">Recent and upcoming clinic appointments</p>
            </div>

            <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $appointments->count() }} Total
            </span>
        </div>

        <div class="space-y-4">

            @forelse($appointments as $appointment)

                <div class="border rounded-2xl p-5 bg-gray-50 hover:bg-white hover:shadow transition">

                    <div class="flex justify-between items-start gap-4">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                🐾 {{ $appointment->pet->name ?? 'N/A' }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Owner:
                                {{ $appointment->owner->full_name ?? $appointment->pet->owner->full_name ?? 'N/A' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Vet:
                                {{ $appointment->vet->name ?? 'Unassigned' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Date:
                                {{ $appointment->scheduled_at
                                    ? \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y, h:i A')
                                    : 'Not scheduled' }}
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if(($appointment->status ?? '') === 'Completed')
                                bg-green-100 text-green-700
                            @elseif(($appointment->status ?? '') === 'Cancelled')
                                bg-red-100 text-red-700
                            @elseif(($appointment->status ?? '') === 'In Consultation')
                                bg-blue-100 text-blue-700
                            @else
                                bg-yellow-100 text-yellow-700
                            @endif">
                            {{ $appointment->status ?? 'Pending' }}
                        </span>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-5">

                        @if($appointment->status != 'Completed')
                            <a href="{{ route('appointments.medical-record.create', $appointment) }}"
                               class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm">
                                Complete Visit
                            </a>
                        @elseif($appointment->medicalRecord)
                            <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
                               class="px-4 py-2 rounded-xl bg-green-700 text-white text-sm">
                                View Report
                            </a>
                        @endif

                        <a href="{{ route('appointments.edit', $appointment) }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                            Edit
                        </a>

                        @if($appointment->pet)
                            <a href="{{ route('medical-records.history', $appointment->pet) }}"
                               class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">
                                History
                            </a>
                        @endif

                        <form action="{{ route('appointments.destroy', $appointment) }}"
                              method="POST"
                              onsubmit="return confirm('Delete appointment?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 rounded-xl bg-red-100 text-red-700 text-sm">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="text-center bg-gray-50 rounded-2xl p-8">
                    <p class="text-gray-500 mb-4">No appointments yet.</p>

                    <a href="{{ route('appointments.create') }}"
                       class="inline-block px-5 py-2 rounded-xl bg-emerald-600 text-white">
                        Book First Appointment
                    </a>
                </div>

            @endforelse

        </div>

    </div>

</div>
@endsection