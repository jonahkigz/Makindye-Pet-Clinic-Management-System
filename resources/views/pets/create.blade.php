@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Register Pet</h1>
        <p class="text-gray-500">Register a new pet into the clinic.</p>
    </div>

    <form method="POST" action="{{ route('pets.store') }}" class="bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf

        {{-- OWNER --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Owner
            </label>

            @if($isPetOwner && $selectedOwner)

                <input type="hidden"
                       name="owner_id"
                       value="{{ $selectedOwner->id }}">

                <input type="text"
                       value="{{ $selectedOwner->full_name }}"
                       class="w-full rounded-xl border-gray-300 bg-gray-100"
                       readonly>

            @else

                <select name="owner_id"
                        class="w-full rounded-xl border-gray-300"
                        required>

                    <option value="">Select Owner</option>

                    @foreach($owners as $owner)

                        <option value="{{ $owner->id }}"
                            {{ old('owner_id') == $owner->id ? 'selected' : '' }}>

                            {{ $owner->full_name }}

                        </option>

                    @endforeach

                </select>

            @endif

            @error('owner_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

        {{-- PET NAME --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Pet Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full rounded-xl border-gray-300"
                required>

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- SPECIES --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Species
            </label>

            <select name="species_id"
                    class="w-full rounded-xl border-gray-300">

                <option value="">Select Species</option>

                @foreach($species as $item)

                    <option value="{{ $item->id }}"
                        {{ old('species_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- BREED --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Breed
            </label>

            <select name="breed_id"
                    class="w-full rounded-xl border-gray-300">

                <option value="">Select Breed</option>

                @foreach($breeds as $breed)

                    <option value="{{ $breed->id }}"
                        {{ old('breed_id') == $breed->id ? 'selected' : '' }}>

                        {{ $breed->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- GENDER --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Gender
            </label>

            <select name="gender"
                    class="w-full rounded-xl border-gray-300">

                <option value="">Select Gender</option>

                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                    Male
                </option>

                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                    Female
                </option>

            </select>

        </div>

        {{-- DATE OF BIRTH --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Date of Birth
            </label>

            <input
                type="date"
                name="date_of_birth"
                value="{{ old('date_of_birth') }}"
                class="w-full rounded-xl border-gray-300">

        </div>

        {{-- COLOUR --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Colour
            </label>

            <input
                type="text"
                name="color"
                value="{{ old('color') }}"
                class="w-full rounded-xl border-gray-300">

        </div>

        {{-- WEIGHT --}}
        <div>
            <label class="block mb-2 font-medium text-gray-700">
                Weight (kg)
            </label>

            <input
                type="number"
                step="0.01"
                name="weight"
                value="{{ old('weight') }}"
                class="w-full rounded-xl border-gray-300">

        </div>

        <div class="flex justify-end gap-3">

            <a href="{{ route('pets.index') }}"
               class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700">
                Cancel
            </a>

            <button
                class="px-5 py-2 rounded-xl bg-green-700 text-white">
                Register Pet
            </button>

        </div>

    </form>

</div>
@endsection