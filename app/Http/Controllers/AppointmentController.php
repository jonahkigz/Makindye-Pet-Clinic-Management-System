<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['owner', 'pet', 'vet', 'medicalRecord'])
    ->latest()
    ->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create', [
            'owners' => Owner::orderBy('full_name')->get(),
            'pets' => Pet::orderBy('name')->get(),
            'vets' => User::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Appointment::create($request->validate([
            'owner_id' => 'required',
            'pet_id' => 'required',
            'vet_id' => 'nullable',
            'scheduled_at' => 'required|date',
            'reason' => 'nullable|string',
            'status' => 'nullable|string',
            'notes' => 'nullable|string',
        ]));

        return redirect()->route('appointments.index')->with('success', 'Appointment booked.');
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'owners' => Owner::orderBy('full_name')->get(),
            'pets' => Pet::orderBy('name')->get(),
            'vets' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->validate([
            'owner_id' => 'required',
            'pet_id' => 'required',
            'vet_id' => 'nullable',
            'scheduled_at' => 'required|date',
            'reason' => 'nullable|string',
            'status' => 'nullable|string',
            'notes' => 'nullable|string',
        ]));

        return redirect()->route('appointments.index')->with('success', 'Appointment updated.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Appointment deleted.');
    }
}
