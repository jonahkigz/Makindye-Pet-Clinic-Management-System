@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Pet</h1>

    <form method="POST" action="{{ route('pets.update', $pet) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Owner</label>

            @if($isPetOwner && $selectedOwner)
                <input type="hidden" name="owner_id" value="{{ $selectedOwner->id }}">

                <input type="text"
                       value="{{ $selectedOwner->full_name }}"
                       class="w-full border rounded p-2 bg-gray-100"
                       readonly>
            @else
                <select name="owner_id" class="w-full border rounded p-2" required>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('owner_id', $pet->owner_id) == $owner->id)>
                            {{ $owner->full_name }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <div>
            <label class="block mb-1">Pet Name</label>
            <input name="name" value="{{ old('name', $pet->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Species</label>
            <select name="species_id" class="w-full border rounded p-2">
                <option value="">Select Species</option>
                @foreach($species as $item)
                    <option value="{{ $item->id }}" @selected(old('species_id', $pet->species_id) == $item->id)>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Breed</label>
            <select name="breed_id" class="w-full border rounded p-2">
                <option value="">Select Breed</option>
                @foreach($breeds as $breed)
                    <option value="{{ $breed->id }}" @selected(old('breed_id', $pet->breed_id) == $breed->id)>
                        {{ $breed->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Gender</label>
            <select name="gender" class="w-full border rounded p-2">
                <option value="">Select Gender</option>
                <option value="Male" @selected(old('gender', $pet->gender) == 'Male')>Male</option>
                <option value="Female" @selected(old('gender', $pet->gender) == 'Female')>Female</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Date of Birth</label>
            <input name="date_of_birth" type="date" value="{{ old('date_of_birth', $pet->date_of_birth) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Colour</label>
            <input name="color" value="{{ old('color', $pet->color) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Weight</label>
            <input name="weight" type="number" step="0.01" value="{{ old('weight', $pet->weight) }}" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('pets.index') }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700">
                Cancel
            </a>

            <button class="bg-green-700 text-white px-4 py-2 rounded-lg">
                Update Pet
            </button>
        </div>
    </form>
</div>
@endsection