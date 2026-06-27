@extends('layouts.app')

@section('content')

<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-6 text-green-800">
        Add Service
    </h1>

    <form method="POST"
          action="{{ route('services.store') }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">

        @csrf

        <input
            name="name"
            class="w-full border rounded p-2"
            placeholder="Service Name"
            required>

        <input
            type="number"
            step="0.01"
            name="price"
            class="w-full border rounded p-2"
            placeholder="Price"
            required>

        <textarea
            name="description"
            class="w-full border rounded p-2"
            placeholder="Description"></textarea>

        <button class="bg-green-700 text-white px-4 py-2 rounded">
            Save Service
        </button>

    </form>

</div>

@endsection