@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Pets</h1>
        <a href="{{ route('pets.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Add Pet</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Pet Name</th>
                    <th class="p-3 text-left">Owner</th>
                    <th class="p-3 text-left">Gender</th>
                    <th class="p-3 text-left">Species/Color</th>
                    <th class="p-3 text-left">Weight</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $pet)
                    <tr class="border-b">
                        <td class="p-3">{{ $pet->name }}</td>
                        <td class="p-3">{{ $pet->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $pet->gender }}</td>
                        <td class="p-3">{{ $pet->color }}</td>
                        <td class="p-3">{{ $pet->weight }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('pets.edit', $pet) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete pet?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No pets yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
