@extends('layouts.app')
@section('content')
@forelse($appointments ?? [] as $appointment)
    ...
@empty
    <p>No appointments found</p>
@endforelse



<div class="space-y-6">

    {{-- =========================================
        HERO SECTION
    ========================================== --}}
    <div class="rounded-2xl bg-gradient-to-r from-emerald-700 to-green-500 p-8 text-white shadow-lg">

        <h1 class="text-3xl font-bold">
            Administrator Dashboard
        </h1>

        <p class="mt-2 text-green-100">
            Welcome to Makindye Pet Clinic Management System
        </p>

    </div>

    {{-- =========================================
        KPI STATISTICS
    ========================================== --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Today's Appointments</p>
            <h2 class="text-3xl font-bold text-emerald-600">
                {{ $stats['today_appointments'] }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Registered Pets</p>
            <h2 class="text-3xl font-bold text-emerald-600">
                {{ $stats['registered_pets'] }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Pet Owners</p>
            <h2 class="text-3xl font-bold text-emerald-600">
                {{ $stats['owners'] }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Monthly Revenue</p>
            <h2 class="text-3xl font-bold text-emerald-600">
                UGX {{ number_format($stats['monthly_revenue']) }}
            </h2>
        </div>

    </div>

    {{-- =========================================
        CHARTS SECTION
    ========================================== --}}
    <div class="grid gap-6 lg:grid-cols-2">

        {{-- REVENUE CHART --}}
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-lg font-semibold mb-4">
                Revenue Trend
            </h2>

            <canvas id="revenueChart"></canvas>

        </div>

        {{-- APPOINTMENT CHART --}}
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-lg font-semibold mb-4">
                Appointment Trends
            </h2>

            <canvas id="appointmentChart"></canvas>

        </div>

    </div>

   {{-- =========================================
    TODAY'S CLINIC ACTIVITY
========================================== --}}
<div class="grid lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">

        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Today's Clinic Activity
                </h2>
                <p class="text-sm text-gray-500">
                    Latest appointments and patient visits
                </p>
            </div>

            <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">
                📅
            </div>
        </div>

        <div class="space-y-4">

            @forelse($appointments as $appointment)
                <div class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-emerald-50 to-white border border-emerald-100 hover:shadow-md transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xl shadow">
                            🐾
                        </div>

                        <div>
                            <p class="font-bold text-gray-800">
                                {{ $appointment->pet->name ?? 'Unknown Pet' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Owner: {{ $appointment->owner->full_name ?? $appointment->owner->name ?? 'Unknown Owner' }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $appointment->scheduled_at ?? 'No scheduled time' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if(($appointment->status ?? '') === 'completed')
                                bg-green-100 text-green-700
                            @elseif(($appointment->status ?? '') === 'cancelled')
                                bg-red-100 text-red-700
                            @elseif(($appointment->status ?? '') === 'pending')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-blue-100 text-blue-700
                            @endif
                        ">
                            {{ ucfirst($appointment->status ?? 'Scheduled') }}
                        </span>
                    </div>

                </div>
            @empty
                <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                    <div class="text-4xl mb-2">🐶</div>
                    <p class="font-semibold text-gray-700">No appointments yet</p>
                    <p class="text-sm text-gray-500">New clinic activity will appear here.</p>
                </div>
            @endforelse

        </div>

    </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">
                Quick Actions
            </h2>

            <div class="space-y-3">

                <a href="{{ route('pets.create') }}"
                   class="block text-center bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700">
                    Register Pet
                </a>

                <a href="{{ route('appointments.create') }}"
                   class="block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                    Book Appointment
                </a>

                <a href="{{ route('owners.index') }}"
                   class="block text-center bg-lime-600 text-white py-2 rounded hover:bg-lime-700">
                    Add Owner
                </a>

                <a href="{{ route('reports.index') }}"
                   class="block text-center bg-teal-600 text-white py-2 rounded hover:bg-teal-700">
                    View Reports
                </a>

            </div>

        </div>

    </div>

</div>

{{-- =========================================
    CHART JS (SAFE + FIXED)
========================================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const months = @json($months);
    const revenue = @json($revenueData);
    const appointments = @json($appointmentData);

    /*
    |--------------------------------------------------------------------------
    | REVENUE CHART
    |--------------------------------------------------------------------------
    */
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue (UGX)',
                data: revenue,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16,185,129,0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    /*
    |--------------------------------------------------------------------------
    | APPOINTMENT CHART
    |--------------------------------------------------------------------------
    */
    new Chart(document.getElementById('appointmentChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Appointments',
                data: appointments,
                backgroundColor: '#22c55e'
            }]
        }
    });

</script>

@endsection
