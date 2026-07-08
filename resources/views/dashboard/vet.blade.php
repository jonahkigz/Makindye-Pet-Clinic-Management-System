@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat p-6"
     style="background-image: url('{{ asset('images/golden_retriever.png') }}');">
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">
            Veterinarian Dashboard 🩺
        </h1>
        <p class="text-green-100 mt-1">
            Clinical workspace for consultations, patient care, and treatment follow-up.
        </p>
    </div>

    {{-- STATS --}}
    <div class="grid md:grid-cols-3 gap-4">

        <a href="{{ route('appointments.index') }}"
   class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
    <p class="text-gray-500 text-sm">Appointments</p>
    <h2 class="text-3xl font-bold text-emerald-700 mt-2">
        {{ $stats['all_appointments'] ?? 0 }}
    </h2>
    <p class="text-xs text-gray-400 mt-1">
        Includes all assigned and unassigned appointments
    </p>
</a>

<a href="{{ route('appointments.index', ['filter' => 'my']) }}"
   class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
    <p class="text-gray-500 text-sm">My Appointments</p>
    <h2 class="text-3xl font-bold text-blue-700 mt-2">
        {{ $stats['my_appointments'] ?? 0 }}
    </h2>
    <p class="text-xs text-gray-400 mt-1">
        Appointments assigned to you
    </p>
</a>

<a href="{{ route('appointments.index', ['filter' => 'unassigned']) }}"
   class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
    <p class="text-gray-500 text-sm">Unassigned</p>
    <h2 class="text-3xl font-bold text-orange-700 mt-2">
        {{ $stats['unassigned_appointments'] ?? 0 }}
    </h2>
    <p class="text-xs text-gray-400 mt-1">
        Available consultations awaiting assignment
    </p>
</a>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="grid md:grid-cols-3 gap-4">

        <a href="{{ route('appointments.index') }}"
           class="bg-emerald-50 border border-emerald-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">📅</p>
            <h3 class="font-bold text-emerald-800">View Consultations</h3>
            <p class="text-sm text-gray-500 mt-1">Review today’s appointments and patient queue.</p>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="bg-blue-50 border border-blue-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">📝</p>
            <h3 class="font-bold text-blue-800">Add Medical Report</h3>
            <p class="text-sm text-gray-500 mt-1">Record symptoms, diagnosis, treatment, and notes.</p>
        </a>

        <a href="{{ route('pets.index') }}"
           class="bg-lime-50 border border-lime-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">🐾</p>
            <h3 class="font-bold text-lime-800">Patient Records</h3>
            <p class="text-sm text-gray-500 mt-1">Access pet profiles and previous treatment history.</p>
        </a>

    </div>

    {{-- MAIN SECTION --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- APPOINTMENT QUEUE --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">

            <div class="flex justify-between items-center mb-5">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Consultation Queue</h2>
                    <p class="text-sm text-gray-500">Recent and upcoming patient appointments</p>
                </div>

                <a href="{{ route('appointments.index') }}"
                   class="text-sm text-emerald-700 font-semibold">
                    View All
                </a>
            </div>

            @forelse($appointments ?? [] as $appointment)

                <div class="border rounded-2xl p-4 mb-3 bg-gray-50 hover:bg-white hover:shadow transition">

                    <div class="flex justify-between items-start gap-4">

                        <div>
                            <h3 class="font-bold text-gray-800">
                                🐾 {{ $appointment->pet->name ?? 'Pet' }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Owner:
                                {{ $appointment->owner->full_name ?? $appointment->pet->owner->full_name ?? 'Owner not set' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Time:
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
                            @else
                                bg-yellow-100 text-yellow-700
                            @endif">
                            {{ $appointment->status ?? 'Pending' }}
                        </span>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-4">

                        <a href="{{ route('appointments.show', $appointment) }}"
                           class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm">
                            View Appointment
                        </a>

                        <a href="{{ route('medical-records.create') }}?appointment_id={{ $appointment->id }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                            Start Report
                        </a>

                        @if($appointment->pet)
                            <a href="{{ route('medical-records.history', $appointment->pet) }}"
                               class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">
                                History
                            </a>
                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center bg-gray-50 rounded-2xl p-6">
                    <p class="text-gray-500">No appointments currently assigned.</p>
                </div>

            @endforelse

        </div>

        {{-- CLINICAL SUMMARY --}}
        <div class="bg-white p-6 rounded-2xl shadow">

            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Clinical Summary
            </h2>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-emerald-50">
    <p class="text-sm text-gray-500">Completed Cases</p>
    <p class="text-2xl font-bold text-emerald-700">
        {{ $stats['completed_cases'] ?? 0 }}
    </p>
</div>

<div class="p-4 rounded-xl bg-blue-50">
    <p class="text-sm text-gray-500">Completed Consultations</p>
    <p class="text-2xl font-bold text-blue-700">
        {{ $stats['completed_consultations'] ?? 0 }}
    </p>
</div>

<div class="p-4 rounded-xl bg-orange-50">
    <p class="text-sm text-gray-500">Records This Month</p>
    <p class="text-2xl font-bold text-orange-700">
        {{ $stats['monthly_records'] ?? 0 }}
    </p>
</div>
            </div>

        </div>

    </div>
    </div>

</div>
@endsection