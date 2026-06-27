@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="bg-white shadow rounded-lg p-8">
        <div class="flex justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-green-800">MAKINDYE PET CLINIC</h1>
                <p class="text-gray-600">Payment Receipt</p>
            </div>

            <div class="text-right">
                <p><strong>Date:</strong> {{ $payment->created_at->format('d M Y') }}</p>
                <p><strong>Invoice:</strong> {{ $payment->invoice->invoice_number ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p><strong>Owner:</strong> {{ $payment->invoice->owner->full_name ?? 'N/A' }}</p>
            <p><strong>Amount Paid:</strong> UGX {{ number_format($payment->amount) }}</p>
            <p><strong>Method:</strong> {{ $payment->method }}</p>
            <p><strong>Reference:</strong> {{ $payment->reference ?? 'N/A' }}</p>
        </div>

        <div class="border-t pt-4 text-right">
            <p><strong>Invoice Total:</strong> UGX {{ number_format($payment->invoice->total_amount ?? 0) }}</p>
            <p><strong>Total Paid:</strong> UGX {{ number_format($payment->invoice->paid_amount ?? 0) }}</p>
            <p><strong>Balance:</strong> UGX {{ number_format(($payment->invoice->total_amount ?? 0) - ($payment->invoice->paid_amount ?? 0)) }}</p>
        </div>

        <div class="mt-6">
            <button onclick="window.print()" class="bg-green-700 text-white px-4 py-2 rounded-lg">
                Print Receipt
            </button>

            <a href="{{ route('payments.index') }}" class="ml-3 text-blue-600">
                Back to Payments
            </a>
        </div>
    </div>
</div>
@endsection