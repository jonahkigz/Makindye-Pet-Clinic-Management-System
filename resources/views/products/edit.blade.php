@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $product->name }}" class="w-full border rounded p-2" required>
        <input name="category" value="{{ $product->category }}" class="w-full border rounded p-2">
        <input name="quantity" type="number" value="{{ $product->quantity }}" class="w-full border rounded p-2" required>
        <input name="reorder_level" type="number" value="{{ $product->reorder_level }}" class="w-full border rounded p-2" required>
        <input name="unit_price" type="number" step="0.01" value="{{ $product->unit_price }}" class="w-full border rounded p-2" required>
        <input name="expiry_date" type="date" value="{{ $product->expiry_date }}" class="w-full border rounded p-2">

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Update Product</button>
    </form>
</div>
@endsection