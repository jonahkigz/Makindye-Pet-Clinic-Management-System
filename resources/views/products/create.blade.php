@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Add Product</h1>

    <form method="POST" action="{{ route('products.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <input name="name" class="w-full border rounded p-2" placeholder="Product name" required>
        <input name="category" class="w-full border rounded p-2" placeholder="Category">
        <input name="quantity" type="number" class="w-full border rounded p-2" placeholder="Quantity" required>
        <input name="reorder_level" type="number" class="w-full border rounded p-2" placeholder="Reorder level" value="5" required>
        <input name="unit_price" type="number" step="0.01" class="w-full border rounded p-2" placeholder="Unit price" required>
        <input name="expiry_date" type="date" class="w-full border rounded p-2">

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Save Product</button>
    </form>
</div>
@endsection