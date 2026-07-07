@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-600 to-green-500 text-white p-6 h-30 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">
            Welcome back, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-green-100 mt-1">
            View your registered pets, appointments, medical history, and bills.
        </p>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="grid md:grid-cols-3 gap-4">

        <a href="{{ route('pets.create') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">Add New Pet</p>
            <h2 class="text-xl font-bold text-emerald-700">Register Pet</h2>
        </a>

        <a href="{{ route('appointments.create') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">Book Visit</p>
            <h2 class="text-xl font-bold text-green-700">Appointment</h2>
        </a>

        <a href="{{ route('pets.index') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">My Registered Pets</p>
            <h2 class="text-xl font-bold text-lime-700">View Pets</h2>
        </a>

    </div>

    {{-- MY PETS --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">My Pets</h2>
                <p class="text-sm text-gray-500">Pets registered under your account</p>
            </div>

            <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $myPets->count() }} Registered
            </span>
        </div>

        <div class="grid md:grid-cols-2 gap-4">

            @forelse($myPets as $pet)

                <div class="border rounded-2xl p-5 hover:shadow-md transition bg-gray-50">

                    <div class="flex items-start justify-between">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                🐾 {{ $pet->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $pet->species->name ?? 'Species not set' }}
                                @if($pet->breed)
                                    • {{ $pet->breed->name }}
                                @endif
                            </p>
                        </div>

                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            Active
                        </span>

                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-4 text-sm">

                        <div>
                            <p class="text-gray-500">Gender</p>
                            <p class="font-semibold">{{ $pet->gender ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Weight</p>
                            <p class="font-semibold">
                                {{ $pet->weight ? $pet->weight . ' kg' : 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Colour</p>
                            <p class="font-semibold">{{ $pet->color ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">DOB</p>
                            <p class="font-semibold">{{ $pet->date_of_birth ?? 'N/A' }}</p>
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-5">

                        <a href="{{ route('pets.show', $pet) }}"
                           class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm">
                            View Profile
                        </a>

                        <a href="{{ route('medical-records.index') }}?pet_id={{ $pet->id }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                            Medical History
                        </a>

                        <a href="{{ route('appointments.create') }}"
                           class="px-4 py-2 rounded-xl bg-green-100 text-green-700 text-sm">
                            Book Appointment
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-2 bg-gray-50 border rounded-2xl p-6 text-center">
                    <p class="text-gray-500 mb-4">You have no registered pets yet.</p>

                    <a href="{{ route('pets.create') }}"
                       class="inline-block px-5 py-2 rounded-xl bg-emerald-600 text-white">
                        Register Your First Pet
                    </a>
                </div>

            @endforelse

        </div>

    </div>

    {{-- MY APPOINTMENTS --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-semibold mb-4">My Appointments</h2>

        @forelse($myAppointments as $appointment)

            <div class="border-b py-3 flex justify-between">

                <div>
                    <p class="font-bold">{{ $appointment->pet->name ?? 'Pet' }}</p>
                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y, h:i A') }}
                    </p>
                </div>

                <span class="text-sm bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full">
                    {{ $appointment->status ?? 'Scheduled' }}
                </span>

            </div>

        @empty
            <p class="text-gray-500">No appointments booked yet.</p>
        @endforelse

    </div>

    {{-- MY INVOICES --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-semibold mb-4">My Invoices</h2>

        @forelse($myInvoices as $invoice)

            <div class="flex justify-between border-b py-3">

                <div>
                    <p class="font-bold">Invoice #{{ $invoice->id }}</p>
                    <p class="text-sm text-gray-500">{{ $invoice->status }}</p>
                </div>

                <div class="text-right">
                    <p class="font-bold text-emerald-700">
                        UGX {{ number_format($invoice->total_amount ?? 0) }}
                    </p>
                </div>

            </div>

        @empty
            <p class="text-gray-500">No invoices available.</p>
        @endforelse

    </div>

</div>

@endsection