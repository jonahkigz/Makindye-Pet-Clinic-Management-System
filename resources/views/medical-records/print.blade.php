<!DOCTYPE html>
<html>
<head>
    <title>Medical Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 35px;
            color: #1f2937;
            background: #ffffff;
        }

        .no-print {
            text-align: right;
            margin-bottom: 20px;
        }

        .print-btn {
            background: #047857;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .report {
            border: 1px solid #d1d5db;
            padding: 25px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #047857;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .clinic-name {
            font-size: 28px;
            font-weight: bold;
            color: #047857;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 16px;
            color: #374151;
            margin-top: 5px;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-top: 15px;
            color: #4b5563;
        }

        .section {
            margin-bottom: 24px;
        }

        .section-title {
            background: #ecfdf5;
            color: #047857;
            padding: 10px 14px;
            border-left: 5px solid #047857;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 25px;
        }

        .item {
            font-size: 14px;
            padding: 6px 0;
        }

        .label {
            font-weight: bold;
            color: #374151;
        }

        .box {
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.5;
        }

        .signature {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .signature-line {
            border-top: 1px solid #111827;
            padding-top: 8px;
            font-size: 13px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 12px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 20px;
            }

            .report {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>

<body>

<div class="no-print">
    <button onclick="window.print()" class="print-btn">Print Report</button>
</div>

<div class="report">

    <div class="header">
        <div class="clinic-name">MAKINDYE PET CLINIC</div>
        <div class="subtitle">Veterinary Medical Examination Report</div>

        <div class="meta">
            <span>Report No: MR-{{ str_pad($medicalRecord->id, 5, '0', STR_PAD_LEFT) }}</span>
            <span>Generated: {{ now()->format('d M Y, h:i A') }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">🐾 Pet & Owner Information</div>

        <div class="grid">
            <div class="item"><span class="label">Pet Name:</span> {{ $medicalRecord->pet->name ?? 'N/A' }}</div>
            <div class="item"><span class="label">Owner:</span> {{ $medicalRecord->pet->owner->full_name ?? 'N/A' }}</div>

            <div class="item"><span class="label">Species:</span> {{ $medicalRecord->pet->species->name ?? 'N/A' }}</div>
            <div class="item"><span class="label">Breed:</span> {{ $medicalRecord->pet->breed->name ?? 'N/A' }}</div>

            <div class="item"><span class="label">Gender:</span> {{ $medicalRecord->pet->gender ?? 'N/A' }}</div>
            <div class="item"><span class="label">Colour:</span> {{ $medicalRecord->pet->color ?? 'N/A' }}</div>

            <div class="item"><span class="label">Date of Birth:</span>
                {{ $medicalRecord->pet->date_of_birth
                    ? \Carbon\Carbon::parse($medicalRecord->pet->date_of_birth)->format('d M Y')
                    : 'N/A' }}
            </div>

            <div class="item"><span class="label">Weight:</span> {{ $medicalRecord->pet->weight ?? 'N/A' }} kg</div>

            <div class="item"><span class="label">Owner Phone:</span> {{ $medicalRecord->pet->owner->phone ?? 'N/A' }}</div>
            <div class="item"><span class="label">Owner Email:</span> {{ $medicalRecord->pet->owner->email ?? 'N/A' }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">📅 Consultation Details</div>

        <div class="grid">
            <div class="item"><span class="label">Appointment ID:</span> #{{ $medicalRecord->appointment->id ?? 'N/A' }}</div>

            <div class="item"><span class="label">Appointment Date:</span>
                {{ $medicalRecord->appointment?->scheduled_at
                    ? \Carbon\Carbon::parse($medicalRecord->appointment->scheduled_at)->format('d M Y, h:i A')
                    : 'N/A' }}
            </div>

            <div class="item"><span class="label">Veterinarian:</span> {{ $medicalRecord->vet->name ?? 'N/A' }}</div>
            <div class="item"><span class="label">Status:</span> {{ $medicalRecord->appointment->status ?? 'N/A' }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">🩺 Clinical Examination</div>

        <p class="label">Presenting Symptoms</p>
        <div class="box">{{ $medicalRecord->symptoms ?? 'N/A' }}</div>

        <p class="label">Diagnosis</p>
        <div class="box">{{ $medicalRecord->diagnosis ?? 'N/A' }}</div>

        <p class="label">Treatment Administered</p>
        <div class="box">{{ $medicalRecord->treatment ?? 'N/A' }}</div>

        <p class="label">Veterinarian Notes</p>
        <div class="box">{{ $medicalRecord->notes ?? 'N/A' }}</div>
    </div>

    <div class="section">
        <div class="section-title">📄 Follow-up & Recommendations</div>

        <div class="box">
            Follow-up advice, vaccination reminders, dietary recommendations, and special care instructions should be reviewed with the attending veterinarian where applicable.
        </div>
    </div>

    <div class="signature">
        <div class="signature-line">
            Veterinarian Signature
        </div>

        <div class="signature-line">
            Clinic Stamp
        </div>
    </div>

    <div class="footer">
        This report was generated by the Makindye Pet Clinic Management System.
    </div>

</div>

</body>
</html>