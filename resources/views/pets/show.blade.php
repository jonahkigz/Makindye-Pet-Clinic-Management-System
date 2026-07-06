@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="bg-gradient-to-r from-emerald-600 to-green-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">🐾 {{ $pet->name }}</h1>
        <p class="text-green-100">Complete pet profile and clinic history</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pet Profile</h2>

            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Owner</p>
                    <p class="font-semibold">{{ $pet->owner->full_name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Species</p>
                    <p class="font-semibold">{{ $pet->species->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Breed</p>
                    <p class="font-semibold">{{ $pet->breed->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Gender</p>
                    <p class="font-semibold">{{ $pet->gender ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Colour</p>
                    <p class="font-semibold">{{ $pet->color ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Weight</p>
                    <p class="font-semibold">{{ $pet->weight ? $pet->weight . ' kg' : 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Date of Birth</p>
                    <p class="font-semibold">{{ $pet->date_of_birth ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Registered On</p>
                    <p class="font-semibold">{{ $pet->created_at?->format('d M Y') ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>

            <div class="space-y-3">
                <a href="{{ route('appointments.create') }}"
                   class="block text-center px-4 py-2 rounded-xl bg-emerald-600 text-white">
                    Book Appointment
                </a>

                <a href="{{ route('medical-records.index') }}?pet_id={{ $pet->id }}"
                   class="block text-center px-4 py-2 rounded-xl bg-blue-600 text-white">
                    Medical History
                </a>

                <a href="{{ route('pets.edit', $pet) }}"
                   class="block text-center px-4 py-2 rounded-xl bg-gray-100 text-gray-700">
                    Edit Profile
                </a>
            </div>
        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Appointments</h2>

            @forelse($pet->appointments->take(5) as $appointment)
                <div class="border-b py-3">
                    <p class="font-semibold">{{ $appointment->reason ?? 'Appointment' }}</p>
                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y, h:i A') }}
                    </p>
                    <p class="text-sm text-emerald-700">{{ $appointment->status ?? 'Scheduled' }}</p>
                </div>
            @empty
                <p class="text-gray-500">No appointments found for this pet.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Medical Summary</h2>

            @forelse($pet->medicalRecords->take(5) as $record)
                <div class="border-b py-3">
                    <p class="font-semibold">{{ $record->diagnosis ?? 'Medical Record' }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $record->created_at?->format('d M Y') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ Str::limit($record->treatment ?? $record->notes ?? 'No details provided.', 80) }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">No medical records found for this pet.</p>
            @endforelse
        </div>

    </div>

</div>
@endsection