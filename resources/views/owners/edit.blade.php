@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Pet Owner</h1>

    <form method="POST" action="{{ route('owners.update', $owner) }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Full Name</label>
            <input name="full_name" value="{{ $owner->full_name }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Phone</label>
            <input name="phone" value="{{ $owner->phone }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input name="email" type="email" value="{{ $owner->email }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Address</label>
            <input name="address" value="{{ $owner->address }}" class="w-full border rounded p-2">
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">
            Update Owner
        </button>
    </form>
</div>
@endsection