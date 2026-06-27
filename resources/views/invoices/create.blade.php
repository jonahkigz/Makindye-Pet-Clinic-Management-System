@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Create Invoice</h1>

    <form method="POST" action="{{ route('invoices.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Owner</label>
            <select name="owner_id" class="w-full border rounded p-2" required>
                <option value="">Select Owner</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Appointment</label>
            <select name="appointment_id" class="w-full border rounded p-2">
                <option value="">None</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}">
                        {{ $appointment->scheduled_at }} - {{ $appointment->pet->name ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <h2 class="font-bold text-green-800 mt-4">Invoice Items</h2>

        <div id="items" class="space-y-3">
            <div class="grid grid-cols-3 gap-3">
                <input name="item_name[]" class="border rounded p-2" placeholder="Item name" required>
                <input name="quantity[]" type="number" value="1" min="1" class="border rounded p-2" required>
                <input name="unit_price[]" type="number" step="0.01" class="border rounded p-2" placeholder="Unit price" required>
            </div>
        </div>

        <button type="button" onclick="addItem()" class="bg-gray-700 text-white px-4 py-2 rounded-lg">
            Add Item
        </button>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">
            Save Invoice
        </button>
    </form>
</div>

<script>
function addItem() {
    document.getElementById('items').insertAdjacentHTML('beforeend', `
        <div class="grid grid-cols-3 gap-3">
            <input name="item_name[]" class="border rounded p-2" placeholder="Item name" required>
            <input name="quantity[]" type="number" value="1" min="1" class="border rounded p-2" required>
            <input name="unit_price[]" type="number" step="0.01" class="border rounded p-2" placeholder="Unit price" required>
        </div>
    `);
}
</script>
@endsection