<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['pet', 'appointment', 'vet'])->latest()->get();
        return view('medical_records.index', compact('records'));
    }

    public function create()
    {
        return view('medical_records.create', [
            'pets' => Pet::orderBy('name')->get(),
            'appointments' => Appointment::latest()->get(),
            'vets' => User::orderBy('name')->get(),
        ]);
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'pet_id' => 'required',
        'appointment_id' => 'nullable',
        'vet_id' => 'nullable',
        'symptoms' => 'nullable|string',
        'diagnosis' => 'nullable|string',
        'treatment' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $record = MedicalRecord::create($validated);

    if ($request->appointment_id) {
        Appointment::where('id', $request->appointment_id)
            ->update([
                'status' => 'Completed',
            ]);
    }

    return redirect()
        ->route('medical-records.show', $record)
        ->with('success', 'Medical report saved and appointment marked as completed.');
}

    public function edit(MedicalRecord $medical_record)
    {
        return view('medical_records.edit', [
            'record' => $medical_record,
            'pets' => Pet::orderBy('name')->get(),
            'appointments' => Appointment::latest()->get(),
            'vets' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, MedicalRecord $medical_record)
    {
        $medical_record->update($request->validate([
            'pet_id' => 'required',
            'appointment_id' => 'nullable',
            'vet_id' => 'nullable',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]));

        return redirect()->route('medical-records.index')->with('success', 'Medical record updated.');
    }

    public function destroy(MedicalRecord $medical_record)
    {
        $medical_record->delete();
        return back()->with('success', 'Medical record deleted.');
    }
    public function createFromAppointment(Appointment $appointment)
{
    $appointment->load(['pet', 'owner', 'vet']);

    return view('medical_records.create_from_appointment', [
        'appointment' => $appointment,
    ]);
}
}
