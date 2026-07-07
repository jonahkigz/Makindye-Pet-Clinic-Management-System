@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <h1 class="text-3xl font-bold">My Invoices</h1>
        <p class="text-green-100 mt-1">Invoices linked to your pet owner account.</p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        @forelse($invoices as $invoice)
            <div class="border rounded-2xl p-5 mb-4 bg-gray-50">

                <div class="flex justify-between">
                    <div>
                        <h3 class="font-bold text-lg">
                            {{ $invoice->invoice_number ?? 'Invoice #' . $invoice->id }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            Pet: {{ $invoice->appointment->pet->name ?? 'N/A' }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Date: {{ $invoice->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-2xl text-sm text-purple-900">
                        {{ ucfirst($invoice->status ?? 'unpaid') }}
                    </span>
                </div>

                <div class="grid md:grid-cols-3 gap-4 mt-4 text-sm">
                    <div>
                        <p class="text-gray-500">Total Amount</p>
                        <p class="font-bold text-emerald-700">
                            UGX {{ number_format($invoice->total_amount ?? 0) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Paid Amount</p>
                        <p class="font-bold">
                            UGX {{ number_format($invoice->paid_amount ?? 0) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Balance</p>
                        <p class="font-bold text-red-600">
                            UGX {{ number_format(($invoice->total_amount ?? 0) - ($invoice->paid_amount ?? 0)) }}
                        </p>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="{{ route('invoices.show', $invoice) }}"
                       class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                        View Invoice
                    </a>
                </div>

            </div>
        @empty
            <p class="text-gray-500">You currently have no invoices.</p>
        @endforelse

    </div>

</div>
@endsection