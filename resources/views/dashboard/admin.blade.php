@extends('layouts.app')
@php
    $appointments = $appointments ?? collect();
    $stats = $stats ?? [];
    $months = $months ?? [];
    $revenueData = $revenueData ?? [];
    $appointmentData = $appointmentData ?? [];
@endphp
@section('content')



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
        RECENT ACTIVITY
    ========================================== --}}
    <div class="grid lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">
                Recent Activity
            </h2>

            <div class="space-y-3">

                @forelse($appointments as $appointment)
                    <div class="border p-3 rounded">
                        <p class="font-bold">
                            {{ $appointment->pet->name ?? 'Pet' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $appointment->owner->name ?? 'Owner' }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">No recent appointments</p>
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
