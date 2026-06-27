@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Appointment</h1>

    <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Owner</label>
            <select name="owner_id" class="w-full border rounded p-2" required>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}" @selected($appointment->owner_id == $owner->id)>
                        {{ $owner->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Pet</label>
            <select name="pet_id" class="w-full border rounded p-2" required>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" @selected($appointment->pet_id == $pet->id)>
                        {{ $pet->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Veterinarian</label>
            <select name="vet_id" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}" @selected($appointment->vet_id == $vet->id)>
                        {{ $vet->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Scheduled Date/Time</label>
            <input name="scheduled_at" type="datetime-local"
                   value="{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i') }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Reason</label>
            <input name="reason" value="{{ $appointment->reason }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="scheduled" @selected($appointment->status == 'scheduled')>Scheduled</option>
                <option value="checked-in" @selected($appointment->status == 'checked-in')>Checked In</option>
                <option value="completed" @selected($appointment->status == 'completed')>Completed</option>
                <option value="cancelled" @selected($appointment->status == 'cancelled')>Cancelled</option>
            </select>
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Update Appointment</button>
    </form>
</div>
@endsection