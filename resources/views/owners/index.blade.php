@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Pet Owners</h1>
        <a href="{{ route('owners.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">
            Add Owner
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Address</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($owners as $owner)
                    <tr class="border-b">
                        <td class="p-3">{{ $owner->full_name }}</td>
                        <td class="p-3">{{ $owner->phone }}</td>
                        <td class="p-3">{{ $owner->email }}</td>
                        <td class="p-3">{{ $owner->address }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('owners.edit', $owner) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete owner?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">No owners yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection