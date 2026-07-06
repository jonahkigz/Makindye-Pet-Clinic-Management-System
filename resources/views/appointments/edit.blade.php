@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Appointment</h1>

    <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        {{-- OWNER --}}
        <div>
            <label class="block mb-1">Owner</label>

            @if($isPetOwner && $selectedOwner)
                <input type="hidden" name="owner_id" value="{{ $selectedOwner->id }}">

                <input type="text"
                       value="{{ $selectedOwner->full_name }}"
                       class="w-full border rounded p-2 bg-gray-100"
                       readonly>
            @else
                <select id="owner_id" name="owner_id" class="w-full border rounded p-2" required>
                    <option value="">Select Owner</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('owner_id', $appointment->owner_id) == $owner->id)>
                            {{ $owner->full_name }}
                        </option>
                    @endforeach
                </select>
            @endif

            @error('owner_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PET --}}
        <div>
            <label class="block mb-1">Pet</label>

            <select id="pet_id" name="pet_id" class="w-full border rounded p-2" required>
                <option value="">Select Pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" @selected(old('pet_id', $appointment->pet_id) == $pet->id)>
                        {{ $pet->name }}
                    </option>
                @endforeach
            </select>

            @error('pet_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- VET --}}
        <div>
            <label class="block mb-1">Veterinarian</label>

            <select name="vet_id" class="w-full border rounded p-2">
                <option value="">Unassigned</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}" @selected(old('vet_id', $appointment->vet_id) == $vet->id)>
                        {{ $vet->name }}
                    </option>
                @endforeach
            </select>

            @error('vet_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DATE --}}
        <div>
            <label class="block mb-1">Scheduled Date/Time</label>

            <input name="scheduled_at"
                   type="datetime-local"
                   value="{{ old('scheduled_at', \Carbon\Carbon::parse($appointment->scheduled_at)->format('Y-m-d\TH:i')) }}"
                   class="w-full border rounded p-2"
                   required>

            @error('scheduled_at')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- REASON --}}
        <div>
            <label class="block mb-1">Reason</label>
            <input name="reason"
                   value="{{ old('reason', $appointment->reason) }}"
                   class="w-full border rounded p-2">
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block mb-1">Status</label>

            <select name="status" class="w-full border rounded p-2">
                <option value="Scheduled" @selected(old('status', $appointment->status) == 'Scheduled')>Scheduled</option>
                <option value="Checked-In" @selected(old('status', $appointment->status) == 'Checked-In')>Checked-In</option>
                <option value="In Consultation" @selected(old('status', $appointment->status) == 'In Consultation')>In Consultation</option>
                <option value="Completed" @selected(old('status', $appointment->status) == 'Completed')>Completed</option>
                <option value="Cancelled" @selected(old('status', $appointment->status) == 'Cancelled')>Cancelled</option>
            </select>
        </div>

        {{-- NOTES --}}
        <div>
            <label class="block mb-1">Notes</label>
            <textarea name="notes" rows="3" class="w-full border rounded p-2">{{ old('notes', $appointment->notes) }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('appointments.index') }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700">
                Cancel
            </a>

            <button class="bg-green-700 text-white px-4 py-2 rounded-lg">
                Update Appointment
            </button>
        </div>
    </form>
</div>

@if(!$isPetOwner)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ownerSelect = document.getElementById('owner_id');
        const petSelect = document.getElementById('pet_id');
        const currentPetId = "{{ old('pet_id', $appointment->pet_id) }}";

        ownerSelect.addEventListener('change', function () {
            const ownerId = this.value;

            petSelect.innerHTML = '<option value="">Loading pets...</option>';

            if (!ownerId) {
                petSelect.innerHTML = '<option value="">Select Pet</option>';
                return;
            }

            fetch(`/owners/${ownerId}/pets`)
                .then(response => response.json())
                .then(pets => {
                    petSelect.innerHTML = '<option value="">Select Pet</option>';

                    if (pets.length === 0) {
                        petSelect.innerHTML = '<option value="">No pets registered for this owner</option>';
                        return;
                    }

                    pets.forEach(pet => {
                        const option = document.createElement('option');
                        option.value = pet.id;
                        option.textContent = pet.name;

                        if (String(pet.id) === String(currentPetId)) {
                            option.selected = true;
                        }

                        petSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    petSelect.innerHTML = '<option value="">Failed to load pets</option>';
                });
        });
    });
</script>
@endif
@endsection