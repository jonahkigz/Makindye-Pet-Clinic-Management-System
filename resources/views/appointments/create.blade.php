@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Book Appointment</h1>
        <p class="text-gray-500">Create a new pet appointment.</p>
    </div>

    <form method="POST" action="{{ route('appointments.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf

        {{-- OWNER --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">Owner</label>

            @if($isPetOwner && $selectedOwner)
                <input type="hidden" name="owner_id" value="{{ $selectedOwner->id }}">

                <input type="text"
                       value="{{ $selectedOwner->full_name }}"
                       class="w-full rounded-xl border-gray-300 bg-gray-100"
                       readonly>
            @else
                <select id="owner_id" name="owner_id" class="w-full rounded-xl border-gray-300" required>
                    <option value="">Select Owner</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
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
            <label class="block mb-2 font-medium text-gray-700">Pet</label>

            <select id="pet_id" name="pet_id" class="w-full rounded-xl border-gray-300" required>
                <option value="">Select Pet</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
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
            <label class="block mb-2 font-medium text-gray-700">Vet</label>

            <select name="vet_id" class="w-full rounded-xl border-gray-300">
                <option value="">Select Vet</option>
                @foreach($vets as $vet)
                    <option value="{{ $vet->id }}" {{ old('vet_id') == $vet->id ? 'selected' : '' }}>
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
            <label class="block mb-2 font-medium text-gray-700">Scheduled Date / Time</label>
            <input type="datetime-local"
                   name="scheduled_at"
                   value="{{ old('scheduled_at') }}"
                   class="w-full rounded-xl border-gray-300"
                   required>

            @error('scheduled_at')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- REASON --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">Reason</label>
            <textarea name="reason" rows="3" class="w-full rounded-xl border-gray-300">{{ old('reason') }}</textarea>
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">Status</label>
            <select name="status" class="w-full rounded-xl border-gray-300">
                <option value="Scheduled" {{ old('status') == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Checked-In" {{ old('status') == 'Checked-In' ? 'selected' : '' }}>Checked-In</option>
                <option value="In Consultation" {{ old('status') == 'In Consultation' ? 'selected' : '' }}>In Consultation</option>
                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        {{-- NOTES --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">Notes</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border-gray-300">{{ old('notes') }}</textarea>
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

@if(!$isPetOwner)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ownerSelect = document.getElementById('owner_id');
        const petSelect = document.getElementById('pet_id');

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