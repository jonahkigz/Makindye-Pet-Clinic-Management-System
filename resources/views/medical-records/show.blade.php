@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8 border border-gray-100">

        <div class="text-center border-b pb-5 mb-6">
            <h1 class="text-2xl font-bold text-emerald-800">
                MAKINDYE PET CLINIC
            </h1>
            <p class="text-gray-500">Pet Medical Visit Report</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="font-bold text-gray-800 mb-2">Pet Information</h2>
                <p><strong>Name:</strong> {{ $record->pet->name ?? 'N/A' }}</p>
                <p><strong>Species:</strong> {{ $record->pet->species ?? 'N/A' }}</p>
                <p><strong>Breed:</strong> {{ $record->pet->breed ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-bold text-gray-800 mb-2">Owner Information</h2>
                <p><strong>Name:</strong> {{ $record->pet->owner->name ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $record->pet->owner->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="bg-emerald-50 rounded-xl p-5 mb-6">
            <h2 class="font-bold text-emerald-900 mb-2">Visit Information</h2>
            <p><strong>Visit Date:</strong> {{ optional($record->appointment->scheduled_at)->format('d M Y') }}</p>
            <p><strong>Veterinarian:</strong> {{ $record->vet->name ?? 'N/A' }}</p>
            <p><strong>Reason:</strong> {{ $record->appointment->reason ?? 'N/A' }}</p>
            <p><strong>Status:</strong> Completed</p>
        </div>

        <div class="space-y-5">
            <div>
                <h2 class="font-bold text-gray-800">Symptoms</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $record->symptoms ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-bold text-gray-800">Diagnosis</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $record->diagnosis ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-bold text-gray-800">Treatment Provided</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $record->treatment ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-bold text-gray-800">Veterinarian Notes</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $record->notes ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t">
            <p class="font-semibold text-gray-700">Veterinarian Signature</p>
            <div class="mt-8 border-b w-64"></div>
        </div>

        <div class="mt-6 flex justify-end gap-3 print:hidden">
            <button onclick="window.print()" class="px-5 py-2 rounded-xl bg-gray-800 text-white hover:bg-gray-900">
                Print Report
            </button>

            <a href="{{ route('medical-records.index') }}" class="px-5 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">
                Back to Records
            </a>
        </div>

    </div>

</div>
@endsection
