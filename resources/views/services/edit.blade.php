@extends('layouts.app')

@section('content')

<div class="p-6 max-w-xl">

    <h1 class="text-2xl font-bold mb-6 text-green-800">
        Edit Service
    </h1>

    <form method="POST"
          action="{{ route('services.update',$service) }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">

        @csrf
        @method('PUT')

        <input
            name="name"
            value="{{ $service->name }}"
            class="w-full border rounded p-2"
            required>

        <input
            type="number"
            step="0.01"
            name="price"
            value="{{ $service->price }}"
            class="w-full border rounded p-2"
            required>

        <textarea
            name="description"
            class="w-full border rounded p-2">{{ $service->description }}</textarea>

        <button class="bg-green-700 text-white px-4 py-2 rounded">
            Update Service
        </button>

    </form>

</div>

@endsection