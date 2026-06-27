@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Invoices</h1>
        <a href="{{ route('invoices.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Create Invoice</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Invoice No</th>
                    <th class="p-3 text-left">Owner</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Paid</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr class="border-b">
                        <td class="p-3">{{ $invoice->invoice_number }}</td>
                        <td class="p-3">{{ $invoice->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-3">{{ number_format($invoice->total_amount) }}</td>
                        <td class="p-3">{{ number_format($invoice->paid_amount) }}</td>
                        <td class="p-3">{{ ucfirst($invoice->status) }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('invoices.show', $invoice) }}" class="text-blue-600">View</a>

                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete invoice?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No invoices yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection