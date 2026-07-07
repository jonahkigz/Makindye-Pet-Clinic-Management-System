@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4">Medical Report</h1>

    <p><strong>Pet:</strong> {{ $medicalRecord->pet->name ?? 'N/A' }}</p>
    <p><strong>Symptoms:</strong> {{ $medicalRecord->symptoms ?? 'N/A' }}</p>
    <p><strong>Diagnosis:</strong> {{ $medicalRecord->diagnosis ?? 'N/A' }}</p>
    <p><strong>Treatment:</strong> {{ $medicalRecord->treatment ?? 'N/A' }}</p>
    <p><strong>Notes:</strong> {{ $medicalRecord->notes ?? 'N/A' }}</p>
</div>
@endsection