@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-600 to-green-500 text-white p-6 rounded-xl shadow">
        <h1 class="text-3xl font-bold">My Pet Portal</h1>
        <p class="text-green-100">Manage your pets, appointments, and medical history</p>
    </div>

    {{-- ACTION CARDS --}}
    <div class="grid md:grid-cols-3 gap-4">

        <a href="{{ route('pets.create') }}"
           class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">Add New Pet</p>
            <h2 class="text-xl font-bold text-emerald-700">Register Pet</h2>
        </a>

        <a href="{{ route('appointments.create') }}"
           class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">Book Visit</p>
            <h2 class="text-xl font-bold text-green-700">Appointment</h2>
        </a>

        <a href="#"
           class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500">Medical Records</p>
            <h2 class="text-xl font-bold text-lime-700">View History</h2>
        </a>

    </div>

    {{-- MY PETS --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">My Pets</h2>

        @forelse($myPets as $pet)
            <div class="border-b py-2 flex justify-between">
                <div>
                    <p class="font-bold">{{ $pet->name }}</p>
                    <p class="text-sm text-gray-500">{{ $pet->type ?? 'Pet' }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have no registered pets</p>
        @endforelse

    </div>

    {{-- MY APPOINTMENTS --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">My Appointments</h2>

        @forelse($myAppointments as $appointment)
            <div class="border-b py-2">
                <p class="font-bold">{{ $appointment->pet->name ?? 'Pet' }}</p>
                <p class="text-sm text-gray-500">
                    {{ $appointment->scheduled_at }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">No appointments booked yet</p>
        @endforelse

    </div>

    {{-- MY INVOICES --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">My Invoices</h2>

        @forelse($myInvoices as $invoice)
            <div class="flex justify-between border-b py-2">

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
            <p class="text-gray-500">No invoices available</p>
        @endforelse

    </div>

</div>

@endsection