@extends('layouts.app')

@section('content')
     
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="bg-black/45 backdrop-blur-md text-white p-6 rounded-2xl shadow-2xl border border-white/20">
            <h1 class="text-3xl font-bold">
                Receptionist Dashboard 🧾
            </h1>
            <p class="text-green-100 mt-1">
                Coordinate daily front desk operations, including client registration, appointments, billing, and payments.
            </p>
        </div>

        {{-- STATS --}}
        <div class="grid md:grid-cols-4 gap-4">

            <a href="{{ route('owners.index') }}"
               class="bg-white/95 backdrop-blur-sm p-5 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl mb-2">👥</p>
                <p class="text-gray-500 text-sm">Registered Owners</p>
                <h2 class="text-3xl font-bold text-emerald-700 mt-2">
                    {{ $stats['owners'] ?? 0 }}
                </h2>
                <p class="text-xs text-gray-400 mt-1">Client records</p>
            </a>

            <a href="{{ route('pets.index') }}"
               class="bg-white/95 backdrop-blur-sm p-5 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl mb-2">🐾</p>
                <p class="text-gray-500 text-sm">Registered Pets</p>
                <h2 class="text-3xl font-bold text-lime-700 mt-2">
                    {{ $stats['pets'] ?? 0 }}
                </h2>
                <p class="text-xs text-gray-400 mt-1">Clinic patients</p>
            </a>

            <a href="{{ route('appointments.index') }}"
               class="bg-white/95 backdrop-blur-sm p-5 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl mb-2">📅</p>
                <p class="text-gray-500 text-sm">Appointments Today</p>
                <h2 class="text-3xl font-bold text-blue-700 mt-2">
                    {{ $stats['today_appointments'] ?? 0 }}
                </h2>
                <p class="text-xs text-gray-400 mt-1">Scheduled today</p>
            </a>

            <a href="{{ route('payments.index') }}"
               class="bg-white/95 backdrop-blur-sm p-5 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl mb-2">💰</p>
                <p class="text-gray-500 text-sm">Daily Income</p>
                <h2 class="text-2xl font-bold text-orange-700 mt-2">
                    UGX {{ number_format($stats['daily_income'] ?? 0) }}
                </h2>
                <p class="text-xs text-gray-400 mt-1">Payments received today</p>
            </a>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="grid md:grid-cols-4 gap-4">

            <a href="{{ route('owners.create') }}"
               class="bg-white/90 backdrop-blur-sm border border-white/60 p-5 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-2xl mb-2">👤</p>
                <h3 class="font-bold text-emerald-800">Register Owner</h3>
                <p class="text-sm text-gray-500 mt-1">Add a new pet owner.</p>
            </a>

            <a href="{{ route('pets.create') }}"
               class="bg-white/90 backdrop-blur-sm border border-white/60 p-5 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-2xl mb-2">🐾</p>
                <h3 class="font-bold text-lime-800">Register Pet</h3>
                <p class="text-sm text-gray-500 mt-1">Create a pet profile.</p>
            </a>

            <a href="{{ route('appointments.create') }}"
               class="bg-white/90 backdrop-blur-sm border border-white/60 p-5 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-2xl mb-2">📅</p>
                <h3 class="font-bold text-blue-800">Book Appointment</h3>
                <p class="text-sm text-gray-500 mt-1">Schedule a clinic visit.</p>
            </a>

            <a href="{{ route('invoices.create') }}"
               class="bg-white/90 backdrop-blur-sm border border-white/60 p-5 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-2xl mb-2">🧾</p>
                <h3 class="font-bold text-orange-800">Create Invoice</h3>
                <p class="text-sm text-gray-500 mt-1">Bill for products & services.</p>
            </a>


    </div>

</div>

@endsection