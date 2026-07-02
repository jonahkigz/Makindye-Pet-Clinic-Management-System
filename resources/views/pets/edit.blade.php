@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Pet</h1>

    <form method="POST" action="{{ route('pets.update', $pet) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Owner</label>
            <select name="owner_id" class="w-full border rounded p-2" required>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}" @selected($pet->owner_id == $owner->id)>
                        {{ $owner->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Pet Name</label>
            <input name="name" value="{{ $pet->name }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Gender</label>
            <select name="gender" class="w-full border rounded p-2">
                <option value="">Select Gender</option>
                <option @selected($pet->gender == 'Male')>Male</option>
                <option @selected($pet->gender == 'Female')>Female</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Species/Color</label>
            <input name="color" value="{{ $pet->color }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Weight</label>
            <input name="weight" type="number" step="0.01" value="{{ $pet->weight }}" class="w-full border rounded p-2">
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Update Pet</button>
    </form>
</div>
@endsection
