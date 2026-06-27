@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Medical Records</h1>
        <a href="{{ route('medical-records.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Add Record</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Pet</th>
                    <th class="p-3 text-left">Vet</th>
                    <th class="p-3 text-left">Symptoms</th>
                    <th class="p-3 text-left">Diagnosis</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr class="border-b">
                        <td class="p-3">{{ $record->pet->name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $record->vet->name ?? 'N/A' }}</td>
                        <td class="p-3">{{ Str::limit($record->symptoms, 40) }}</td>
                        <td class="p-3">{{ Str::limit($record->diagnosis, 40) }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('medical-records.edit', $record) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('medical-records.destroy', $record) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3" onclick="return confirm('Delete record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-gray-500">No medical records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection