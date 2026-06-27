@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-green-800 mb-2">Pet Owner Portal</h1>
    <p class="text-gray-500 mb-6">View pets, appointments, medical history and invoices.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('pets.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Pets</p>
            <h2 class="text-3xl font-bold">{{ $stats['pets'] }}</h2>
        </a>

        <a href="{{ route('appointments.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Appointments</p>
            <h2 class="text-3xl font-bold">{{ $stats['appointments'] }}</h2>
        </a>

        <a href="{{ route('invoices.index') }}" class="bg-white p-5 rounded shadow">
            <p class="text-gray-500">Invoices</p>
            <h2 class="text-3xl font-bold">{{ $stats['pending_invoices'] }}</h2>
        </a>
    </div>
</div>
@endsection