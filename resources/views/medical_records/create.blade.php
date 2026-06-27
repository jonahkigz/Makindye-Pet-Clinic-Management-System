@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Add Medical Record</h1>

    <form method="POST" action="{{ route('medical-records.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Pet</label>
            <select name="pet_id" class="w-full border rounded p-2" required>
                <option value="">Select Pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Appointment</label>
            <select name="appointment_id" class="w-full border rounded p-2">
                <option value="">None</option>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}">{{ $appointment->scheduled_at }} - {{ $appointment->pet->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Vet</label>
            <select name="vet_id" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                @endforeach
            </select>
        </div>

        <textarea name="symptoms" class="w-full border rounded p-2" placeholder="Symptoms"></textarea>
        <textarea name="diagnosis" class="w-full border rounded p-2" placeholder="Diagnosis"></textarea>
        <textarea name="treatment" class="w-full border rounded p-2" placeholder="Treatment"></textarea>
        <textarea name="notes" class="w-full border rounded p-2" placeholder="Notes"></textarea>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Save Record</button>
    </form>
</div>
@endsection