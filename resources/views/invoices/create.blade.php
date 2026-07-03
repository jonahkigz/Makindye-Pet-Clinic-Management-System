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
    <div class="grid grid-cols-4 gap-3 item-row">
        <select name="item_type[]" class="border rounded p-2 item-type" required onchange="loadItems(this)">
            <option value="">Type</option>
            <option value="service">Service</option>
            <option value="product">Product</option>
        </select>

        <select name="item_id[]" class="border rounded p-2 item-select" required onchange="setPrice(this)">
            <option value="">Select Item</option>
        </select>

        <input name="quantity[]" type="number" value="1" min="1" class="border rounded p-2" required>

        <input name="unit_price[]" type="number" step="0.01" class="border rounded p-2 unit-price" placeholder="Unit price" readonly required>
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
const services = @json($services);
const products = @json($products);

function loadItems(typeSelect) {
    const row = typeSelect.closest('.item-row');
    const itemSelect = row.querySelector('.item-select');
    const priceInput = row.querySelector('.unit-price');

    itemSelect.innerHTML = '<option value="">Select Item</option>';
    priceInput.value = '';

    let items = typeSelect.value === 'service' ? services : products;

    items.forEach(item => {
        let price = typeSelect.value === 'service'
            ? item.price
            : item.selling_price;

        itemSelect.innerHTML += `
            <option value="${item.id}" data-price="${price}">
                ${item.name}
            </option>
        `;
    });
}

function setPrice(itemSelect) {
    const row = itemSelect.closest('.item-row');
    const priceInput = row.querySelector('.unit-price');
    const selected = itemSelect.options[itemSelect.selectedIndex];

    priceInput.value = selected.dataset.price || '';
}

function addItem() {
    document.getElementById('items').insertAdjacentHTML('beforeend', `
        <div class="grid grid-cols-4 gap-3 item-row">
            <select name="item_type[]" class="border rounded p-2 item-type" required onchange="loadItems(this)">
                <option value="">Type</option>
                <option value="service">Service</option>
                <option value="product">Product</option>
            </select>

            <select name="item_id[]" class="border rounded p-2 item-select" required onchange="setPrice(this)">
                <option value="">Select Item</option>
            </select>

            <input name="quantity[]" type="number" value="1" min="1" class="border rounded p-2" required>

            <input name="unit_price[]" type="number" step="0.01" class="border rounded p-2 unit-price" placeholder="Unit price" readonly required>
        </div>
    `);
}
</script>
@endsection
