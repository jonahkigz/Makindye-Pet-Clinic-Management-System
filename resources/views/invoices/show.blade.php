@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl">
    <div class="bg-white shadow rounded-lg p-8">
        <div class="flex justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-green-800">MAKINDYE PET CLINIC</h1>
                <p class="text-gray-600">Invoice / Receipt</p>
            </div>

            <div class="text-right">
                <p><strong>Invoice:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Status:</strong> {{ strtoupper($invoice->status) }}</p>
                <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p><strong>Owner:</strong> {{ $invoice->owner->full_name ?? 'N/A' }}</p>
            <p><strong>Pet:</strong> {{ $invoice->appointment->pet->name ?? 'N/A' }}</p>
        </div>

        <table class="w-full mb-6">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Item</th>
                    <th class="p-3 text-left">Qty</th>
                    <th class="p-3 text-left">Unit Price</th>
                    <th class="p-3 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->item_name }}</td>
                        <td class="p-3">{{ $item->quantity }}</td>
                        <td class="p-3">{{ number_format($item->unit_price) }}</td>
                        <td class="p-3 text-right">{{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right text-lg">
            <p><strong>Total:</strong> UGX {{ number_format($invoice->total_amount) }}</p>
            <p><strong>Paid:</strong> UGX {{ number_format($invoice->paid_amount) }}</p>
            <p><strong>Balance:</strong> UGX {{ number_format($invoice->total_amount - $invoice->paid_amount) }}</p>
        </div>

        <div class="mt-6">
            <button onclick="window.print()" class="bg-green-700 text-white px-4 py-2 rounded-lg">
                Print Receipt
            </button>

            <a href="{{ route('invoices.index') }}" class="ml-3 text-blue-600">
                Back to Invoices
            </a>
        </div>
    </div>
</div>
@endsection