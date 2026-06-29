@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold text-green-800 mb-2">
        Receptionist Dashboard
    </h1>

    <p class="text-gray-500 mb-6">
        Front desk workspace for bookings, owners, pets and payments.
    </p>

    {{-- ================= STATS GRID ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <a href="{{ route('owners.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Owners</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['owners'] ?? 0 }}
            </h2>
        </a>

        <a href="{{ route('pets.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Pets</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['pets'] ?? 0 }}
            </h2>
        </a>

        <a href="{{ route('appointments.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Today's Appointments</p>
            <h2 class="text-3xl font-bold">
                {{ $stats['today_appointments'] ?? 0 }}
            </h2>
        </a>

        <a href="{{ route('payments.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Revenue</p>
            <h2 class="text-2xl font-bold">
                UGX {{ number_format($stats['monthly_revenue'] ?? 0) }}
            </h2>
        </a>

    </div>

</div>
@endsection