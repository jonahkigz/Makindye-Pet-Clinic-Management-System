@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
    <h1 class="text-3xl font-bold text-green-800">
        Clinic Operations Overview
    </h1>

    <p class="text-gray-500 mt-2">
        Real-time operational, financial and clinical insights for Makindye Pet Clinic Management System.
    </p>
</div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Owners</p>
            <h2 class="text-3xl font-bold">{{ $stats['owners'] }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Pets</p>
            <h2 class="text-3xl font-bold">{{ $stats['pets'] }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Appointments</p>
            <h2 class="text-3xl font-bold">{{ $stats['appointments'] }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Revenue</p>
            <h2 class="text-2xl font-bold">UGX {{ number_format($stats['total_revenue']) }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Products</p>
            <h2 class="text-3xl font-bold">{{ $stats['products'] }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Pending Invoices</p>
            <h2 class="text-3xl font-bold text-orange-600">{{ $stats['pending_invoices'] }}</h2>
        </div>

        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-gray-500">Low Stock</p>
            <h2 class="text-3xl font-bold text-red-600">{{ $stats['low_stock'] }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-5">
            <h2 class="font-bold text-green-800 mb-4">Recent Payments</h2>
            <table class="w-full">
                @foreach($recentPayments as $payment)
                    <tr class="border-b">
                        <td class="p-2">{{ $payment->invoice->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-2">UGX {{ number_format($payment->amount) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <h2 class="font-bold text-green-800 mb-4">Recent Appointments</h2>
            <table class="w-full">
                @foreach($recentAppointments as $appointment)
                    <tr class="border-b">
                        <td class="p-2">{{ $appointment->pet->name ?? 'N/A' }}</td>
                        <td class="p-2">{{ $appointment->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-2">{{ $appointment->status }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5 mt-6">
        <h2 class="font-bold text-red-700 mb-4">Low Stock Products</h2>
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2 text-left">Quantity</th>
                    <th class="p-2 text-left">Reorder Level</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lowStockProducts as $product)
                    <tr class="border-b">
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2 text-red-600 font-bold">{{ $product->quantity }}</td>
                        <td class="p-2">{{ $product->reorder_level }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-3 text-gray-500">No low stock products.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection