@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Payments</h1>
        <a href="{{ route('payments.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Receive Payment</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Invoice</th>
                    <th class="p-3 text-left">Owner</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Method</th>
                    <th class="p-3 text-left">Reference</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr class="border-b">
                        <td class="p-3">{{ $payment->invoice->invoice_number ?? 'N/A' }}</td>
                        <td class="p-3">{{ $payment->invoice->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-3">UGX {{ number_format($payment->amount) }}</td>
                        <td class="p-3">{{ $payment->method }}</td>
                        <td class="p-3">{{ $payment->reference }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('payments.show', $payment) }}" class="text-blue-600">Receipt</a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete payment?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No payments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection