@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Receive Payment</h1>

    <form method="POST" action="{{ route('payments.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Invoice</label>
            <select name="invoice_id" class="w-full border rounded p-2" required>
                <option value="">Select Invoice</option>
                @foreach($invoices as $invoice)
                    <option value="{{ $invoice->id }}">
                        {{ $invoice->invoice_number }} -
                        {{ $invoice->owner->full_name ?? 'N/A' }} -
                        Balance: UGX {{ number_format($invoice->total_amount - $invoice->paid_amount) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Amount Paid</label>
            <input name="amount" type="number" step="0.01" min="1" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Payment Method</label>
            <select name="payment_method" class="w-full border rounded p-2" required>
                <option value="">Select Method</option>
                <option value="Cash">Cash</option>
                <option value="Mobile Money">Mobile Money</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Card">Card</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Reference</label>
            <input name="reference" class="w-full border rounded p-2" placeholder="Transaction ID / Receipt Ref">
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Save Payment</button>
    </form>
</div>
@endsection