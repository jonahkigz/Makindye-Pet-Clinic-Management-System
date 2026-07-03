@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Book Appointment</h1>
        <p class="text-gray-500">Create a new pet appointment.</p>
    </div>

    <form method="POST" action="{{ route('appointments.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf

        <div>
            <label class="block mb-2 font-medium text-gray-700">Owner</label>
            <select name="owner_id" class="w-full rounded-xl border-gray-300" required>
                <option value="">Select Owner</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->full_name ?? $owner->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Pet</label>
            <select name="pet_id" class="w-full rounded-xl border-gray-300" required>
                <option value="">Select Pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Vet</label>
            <select name="vet_id" class="w-full rounded-xl border-gray-300">
                <option value="">Select Vet</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Scheduled Date / Time</label>
            <input type="datetime-local" name="scheduled_at" class="w-full rounded-xl border-gray-300" required>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Reason</label>
            <textarea name="reason" rows="3" class="w-full rounded-xl border-gray-300"></textarea>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Status</label>
            <select name="status" class="w-full rounded-xl border-gray-300">
                <option value="Scheduled">Scheduled</option>
                <option value="Checked-In">Checked-In</option>
                <option value="In Consultation">In Consultation</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-700">Notes</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border-gray-300"></textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('appointments.index') }}" class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700">
                Cancel
            </a>

            <button type="submit" class="px-5 py-2 rounded-xl bg-green-700 text-white">
                Save Appointment
            </button>
        </div>

    </form>
</div>
@endsection
