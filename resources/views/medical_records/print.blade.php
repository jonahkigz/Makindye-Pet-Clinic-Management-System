<!DOCTYPE html>
<html>
<head>
    <title>Medical Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #111827;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #047857;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            color: #047857;
        }

        .section {
            margin-bottom: 22px;
        }

        .section h3 {
            color: #047857;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .label {
            font-weight: bold;
            color: #374151;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align:right; margin-bottom:20px;">
        <button onclick="window.print()">Print Report</button>
    </div>

    <div class="header">
        <div class="clinic-name">Makindye Pet Clinic</div>
        <p>Medical Report</p>
    </div>

    <div class="section">
        <h3>Pet Information</h3>

        <div class="grid">
            <p><span class="label">Pet Name:</span> {{ $medicalRecord->pet->name ?? 'N/A' }}</p>
            <p><span class="label">Owner:</span> {{ $medicalRecord->pet->owner->full_name ?? 'N/A' }}</p>
            <p><span class="label">Gender:</span> {{ $medicalRecord->pet->gender ?? 'N/A' }}</p>
            <p><span class="label">Weight:</span> {{ $medicalRecord->pet->weight ?? 'N/A' }} kg</p>
            <p><span class="label">Color:</span> {{ $medicalRecord->pet->color ?? 'N/A' }}</p>
            <p><span class="label">DOB:</span> {{ $medicalRecord->pet->date_of_birth ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="section">
        <h3>Appointment Information</h3>

        <div class="grid">
            <p><span class="label">Appointment ID:</span> {{ $medicalRecord->appointment->id ?? 'N/A' }}</p>
            <p><span class="label">Vet:</span> {{ $medicalRecord->vet->name ?? 'N/A' }}</p>
            <p><span class="label">Status:</span> {{ $medicalRecord->appointment->status ?? 'N/A' }}</p>
            <p>
                <span class="label">Date:</span>
                {{ $medicalRecord->appointment?->scheduled_at
                    ? \Carbon\Carbon::parse($medicalRecord->appointment->scheduled_at)->format('d M Y, h:i A')
                    : 'N/A' }}
            </p>
        </div>
    </div>

    <div class="section">
        <h3>Clinical Report</h3>

        <p><span class="label">Symptoms:</span><br>
            {{ $medicalRecord->symptoms ?? 'N/A' }}
        </p>

        <p><span class="label">Diagnosis:</span><br>
            {{ $medicalRecord->diagnosis ?? 'N/A' }}
        </p>

        <p><span class="label">Treatment:</span><br>
            {{ $medicalRecord->treatment ?? 'N/A' }}
        </p>

        <p><span class="label">Vet Notes:</span><br>
            {{ $medicalRecord->notes ?? 'N/A' }}
        </p>
    </div>

    <div class="section">
        <p><span class="label">Generated On:</span> {{ now()->format('d M Y, h:i A') }}</p>
    </div>

</body>
</html>