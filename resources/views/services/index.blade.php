@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Services</h1>

        <a href="{{ route('services.create') }}"
           class="bg-green-700 text-white px-4 py-2 rounded-lg">
            Add Service
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Service</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($services as $service)
                <tr class="border-b">
                    <td class="p-3">{{ $service->name }}</td>
                    <td class="p-3">{{ number_format($service->price) }}</td>
                    <td class="p-3">{{ $service->description }}</td>

                    <td class="p-3 text-right">

                        <a href="{{ route('services.edit',$service) }}"
                           class="text-blue-600">
                            Edit
                        </a>

                        <form action="{{ route('services.destroy',$service) }}"
                              method="POST"
                              class="inline">

                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 ml-3"
                                    onclick="return confirm('Delete service?')">
                                Delete
                            </button>

                        </form>

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="text-center p-6">
                        No services found.
                    </td>
                </tr>

            @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection