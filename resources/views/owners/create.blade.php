@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Add Pet Owner</h1>

    <form method="POST" action="{{ route('owners.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Full Name</label>
            <input name="full_name" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1">Phone</label>
            <input name="phone" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input name="email" type="email" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Address</label>
            <input name="address" class="w-full border rounded p-2">
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">
            Save Owner
        </button>
    </form>
</div>
@endsection