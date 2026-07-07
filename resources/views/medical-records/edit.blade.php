@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Medical Record</h1>

    <form method="POST" action="{{ route('medical-records.update', $record) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Pet</label>
            <select name="pet_id" class="w-full border rounded p-2" required>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" @selected($record->pet_id == $pet->id)>{{ $pet->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Vet</label>
            <select name="vet_id" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}" @selected($record->vet_id == $vet->id)>{{ $vet->name }}</option>
                @endforeach
            </select>
        </div>

        <textarea name="symptoms" class="w-full border rounded p-2">{{ $record->symptoms }}</textarea>
        <textarea name="diagnosis" class="w-full border rounded p-2">{{ $record->diagnosis }}</textarea>
        <textarea name="treatment" class="w-full border rounded p-2">{{ $record->treatment }}</textarea>
        <textarea name="notes" class="w-full border rounded p-2">{{ $record->notes }}</textarea>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Update Record</button>
    </form>
</div>
@endsection