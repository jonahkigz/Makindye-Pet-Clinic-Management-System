@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">
            Receptionist Dashboard 🧾
        </h1>
        <p class="text-green-100 mt-1">
            Front desk workspace for owners, pets, bookings, invoices, and payments.
        </p>
    </div>

    {{-- STATS --}}
    <div class="grid md:grid-cols-4 gap-4">

        <a href="{{ route('owners.index') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Registered Owners</p>
            <h2 class="text-3xl font-bold text-emerald-700 mt-2">
                {{ $stats['owners'] ?? 0 }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Client records</p>
        </a>

        <a href="{{ route('pets.index') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Registered Pets</p>
            <h2 class="text-3xl font-bold text-lime-700 mt-2">
                {{ $stats['pets'] ?? 0 }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Clinic patients</p>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Appointments</p>
            <h2 class="text-3xl font-bold text-blue-700 mt-2">
                {{ $stats['today_appointments'] ?? 0 }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Scheduled today</p>
        </a>

        <a href="{{ route('payments.index') }}"
           class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Monthly Revenue</p>
            <h2 class="text-2xl font-bold text-orange-700 mt-2">
                UGX {{ number_format($stats['monthly_revenue'] ?? 0) }}
            </h2>
            <p class="text-xs text-gray-400 mt-1">Payments received</p>
        </a>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="grid md:grid-cols-4 gap-4">

        <a href="{{ route('owners.create') }}"
           class="bg-emerald-50 border border-emerald-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">👤</p>
            <h3 class="font-bold text-emerald-800">Register Owner</h3>
            <p class="text-sm text-gray-500 mt-1">Add a new pet owner.</p>
        </a>

        <a href="{{ route('pets.create') }}"
           class="bg-lime-50 border border-lime-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">🐾</p>
            <h3 class="font-bold text-lime-800">Register Pet</h3>
            <p class="text-sm text-gray-500 mt-1">Create a pet profile.</p>
        </a>

        <a href="{{ route('appointments.create') }}"
           class="bg-blue-50 border border-blue-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">📅</p>
            <h3 class="font-bold text-blue-800">Book Appointment</h3>
            <p class="text-sm text-gray-500 mt-1">Schedule a clinic visit.</p>
        </a>

        <a href="{{ route('invoices.create') }}"
           class="bg-orange-50 border border-orange-100 p-5 rounded-2xl hover:shadow transition">
            <p class="text-2xl mb-2">🧾</p>
            <h3 class="font-bold text-orange-800">Create Invoice</h3>
            <p class="text-sm text-gray-500 mt-1">Bill owner for services.</p>
        </a>

    </div>

</div>
@endsection