@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Products / Inventory</h1>
        <a href="{{ route('products.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Add Product</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Qty</th>
                    <th class="p-3 text-left">Reorder</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Expiry</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b">
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category }}</td>
                        <td class="p-3">
                            <span class="{{ $product->quantity <= $product->reorder_level ? 'text-red-600 font-bold' : '' }}">
                                {{ $product->quantity }}
                            </span>
                        </td>
                        <td class="p-3">{{ $product->reorder_level }}</td>
                        <td class="p-3">{{ number_format($product->unit_price) }}</td>
                        <td class="p-3">{{ $product->expiry_date }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-6 text-center text-gray-500">No products yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection