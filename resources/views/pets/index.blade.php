@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-emerald-700 to-green-500 text-white p-6 rounded-2xl shadow">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Pets</h1>
                <p class="text-green-100 mt-1">
                    Manage registered patients and their owner details.
                </p>
            </div>

            <a href="{{ route('pets.create') }}"
               class="bg-white text-emerald-700 px-5 py-2 rounded-xl font-semibold shadow">
                Add Pet
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- PET CARDS --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Patient Registry</h2>
                <p class="text-sm text-gray-500">Pets currently registered in the clinic</p>
            </div>

            <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $pets->count() }} Total
            </span>
        </div>

        <div class="grid md:grid-cols-2 gap-4">

            @forelse($pets as $pet)

                <div class="border rounded-2xl p-5 bg-gray-50 hover:bg-white hover:shadow transition">

                    <div class="flex justify-between items-start gap-4">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                🐾 {{ $pet->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Owner: {{ $pet->owner->full_name ?? 'N/A' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $pet->species->name ?? 'Species not set' }}
                                @if($pet->breed)
                                    • {{ $pet->breed->name }}
                                @endif
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-semibold">
                            Active
                        </span>

                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-4 text-sm">

                        <div>
                            <p class="text-gray-500">Gender</p>
                            <p class="font-semibold">{{ $pet->gender ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Weight</p>
                            <p class="font-semibold">
                                {{ $pet->weight ? $pet->weight . ' kg' : 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Colour</p>
                            <p class="font-semibold">{{ $pet->color ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">DOB</p>
                            <p class="font-semibold">
                                {{ $pet->date_of_birth
                                    ? \Carbon\Carbon::parse($pet->date_of_birth)->format('d M Y')
                                    : 'N/A' }}
                            </p>
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-5">

                        <a href="{{ route('pets.show', $pet) }}"
                           class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm">
                            View Profile
                        </a>

                        <a href="{{ route('pets.edit', $pet) }}"
                           class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
                            Edit
                        </a>

                        <a href="{{ route('medical-records.index') }}?pet_id={{ $pet->id }}"
                           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">
                            History
                        </a>

                        <form action="{{ route('pets.destroy', $pet) }}"
                              method="POST"
                              onsubmit="return confirm('Delete pet?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 rounded-xl bg-red-100 text-red-700 text-sm">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-2 text-center bg-gray-50 rounded-2xl p-8">
                    <p class="text-gray-500 mb-4">No pets registered yet.</p>

                    <a href="{{ route('pets.create') }}"
                       class="inline-block px-5 py-2 rounded-xl bg-emerald-600 text-white">
                        Register First Pet
                    </a>
                </div>

            @endforelse

        </div>

    </div>

</div>
@endsection