@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-green-800 mb-2">Veterinarian Dashboard</h1>
    <p class="text-gray-500 mb-6">Clinical workspace for consultations and patient care.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('appointments.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Appointments</p>
            <h2 class="text-3xl font-bold">{{ $stats['appointments'] }}</h2>
        </a>

        <a href="{{ route('medical-records.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Medical Records</p>
            <h2 class="text-3xl font-bold">{{ $stats['medical_records'] }}</h2>
        </a>

        <a href="{{ route('pets.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Registered Pets</p>
            <h2 class="text-3xl font-bold">{{ $stats['pets'] }}</h2>
        </a>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h2 class="font-bold text-green-800 mb-4">Recent Appointments</h2>
        @foreach($recentAppointments as $appointment)
            <div class="border-b py-2">
                {{ $appointment->pet->name ?? 'Pet' }} - {{ $appointment->owner->full_name ?? 'Owner' }} - {{ $appointment->status }}
            </div>
        @endforeach
    </div>
</div>
@endsection