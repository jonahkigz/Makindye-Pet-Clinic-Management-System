@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold text-green-800 mb-2">
        Veterinarian Dashboard
    </h1>

    <p class="text-gray-500 mb-6">
        Clinical workspace for consultations and patient care.
    </p>

    {{-- ================= STATS CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <a href="{{ route('appointments.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Appointments Today</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['today_appointments'] ?? 0 }}
            </h2>
        </a>

        <a href="{{ route('medical-records.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Medical Records</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['total_records'] ?? 0 }}
            </h2>
        </a>

        <a href="{{ route('pets.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Registered Pets</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['total_patients'] ?? 0 }}
            </h2>
        </a>

    </div>

    {{-- ================= RECENT APPOINTMENTS ================= --}}
    <div class="bg-white p-5 rounded shadow">

        <h2 class="font-bold text-green-800 mb-4">
            Recent Appointments
        </h2>

        @forelse($appointments ?? [] as $appointment)
            <div class="border-b py-2">
                {{ $appointment->pet->name ?? 'Pet' }}
                -
                {{ $appointment->owner->name ?? 'Owner' }}
                -
                <span class="text-sm text-gray-500">
                    {{ $appointment->status ?? 'Pending' }}
                </span>
            </div>
        @empty
            <p class="text-gray-500">No recent appointments</p>
        @endforelse

    </div>

</div>
@endsection