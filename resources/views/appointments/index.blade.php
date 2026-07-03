@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg">Book Appointment</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">Date/Time</th>
                    <th class="p-3 text-left">Owner</th>
                    <th class="p-3 text-left">Pet</th>
                    <th class="p-3 text-left">Vet</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr class="border-b">
                        <td class="p-3">{{ $appointment->scheduled_at }}</td>
                        <td class="p-3">{{ $appointment->owner->full_name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $appointment->pet->name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $appointment->vet->name ?? 'N/A' }}</td>
                        <td class="p-3">{{ $appointment->status }}</td>
                        <td class="p-3 text-right">

    @if($appointment->status != 'Completed')

        <a href="{{ route('appointments.medical-record.create', $appointment) }}"
           class="text-emerald-600 font-semibold mr-3">
            Complete Visit
        </a>

    @elseif($appointment->medicalRecord)

        <a href="{{ route('medical-records.show', $appointment->medicalRecord) }}"
           class="text-green-700 font-semibold mr-3">
            View Report
        </a>

    @endif

    <a href="{{ route('appointments.edit', $appointment) }}"
       class="text-blue-600">
        Edit
    </a>

    <form action="{{ route('appointments.destroy', $appointment) }}"
          method="POST"
          class="inline">

        @csrf
        @method('DELETE')

        <button class="text-red-600 ml-3"
                onclick="return confirm('Delete appointment?')">
            Delete
        </button>

    </form>

</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-gray-500">No appointments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
