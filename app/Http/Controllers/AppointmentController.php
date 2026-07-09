<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();

    $appointments = Appointment::with([
        'owner',
        'pet.owner',
        'vet',
        'medicalRecord'
    ]);

    if ($user->role === 'Pet Owner') {

        $owner = $user->owner;

        if (!$owner) {
            return view('appointments.index', [
                'appointments' => collect()
            ]);
        }

        $appointments->where('owner_id', $owner->id);
    }

    if ($user->role === 'Veterinarian') {

        switch ($request->filter) {
            case 'my':
                $appointments->where('vet_id', $user->id);
                break;

            case 'unassigned':
                $appointments->whereNull('vet_id');
                break;

            default:
                break;
        }
    }

    $appointments = $appointments
        ->latest('scheduled_at')
        ->get();

    return view('appointments.index', compact('appointments'));
}
    public function create()
    {
        $user = auth()->user();

        $vets = User::where('role', 'Veterinarian')
            ->orderBy('name')
            ->get();

        // Logged in as Pet Owner
        if ($user->role === 'Pet Owner') {

            $owner = $user->owner;

            return view('appointments.create', [
                'isPetOwner'   => true,
                'selectedOwner'=> $owner,
                'owners'       => collect([$owner]),
                'pets'         => $owner
                    ? Pet::where('owner_id', $owner->id)->orderBy('name')->get()
                    : collect(),
                'vets'         => $vets,
            ]);
        }

        // Administrator / Receptionist / Veterinarian
        return view('appointments.create', [
            'isPetOwner'    => false,
            'selectedOwner' => null,
            'owners'        => Owner::orderBy('full_name')->get(),
            'pets'          => collect(),
            'vets'          => $vets,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'owner_id'     => 'required|exists:owners,id',
            'pet_id'       => 'required|exists:pets,id',
            'vet_id'       => 'nullable|exists:users,id',
            'scheduled_at' => 'required|date',
            'reason'       => 'nullable|string',
            'status'       => 'nullable|string',
            'notes'        => 'nullable|string',
        ]);

        if ($user->role === 'Pet Owner') {

            $owner = $user->owner;

            if (!$owner) {
                return back()->withErrors([
                    'owner_id' => 'Owner profile not found.'
                ])->withInput();
            }

            // Force logged-in owner
            $data['owner_id'] = $owner->id;

            // Verify selected pet belongs to owner
            $petExists = Pet::where('id', $data['pet_id'])
                ->where('owner_id', $owner->id)
                ->exists();

            if (!$petExists) {
                return back()->withErrors([
                    'pet_id' => 'You can only book appointments for your own pets.'
                ])->withInput();
            }
        } else {

            // Admin/Receptionist validation
            $petExists = Pet::where('id', $data['pet_id'])
                ->where('owner_id', $data['owner_id'])
                ->exists();

            if (!$petExists) {
                return back()->withErrors([
                    'pet_id' => 'Selected pet does not belong to the selected owner.'
                ])->withInput();
            }
        }

        // Vet validation
        if (!empty($data['vet_id'])) {

            $validVet = User::where('id', $data['vet_id'])
                ->where('role', 'Veterinarian')
                ->exists();

            if (!$validVet) {
                return back()->withErrors([
                    'vet_id' => 'Please select a valid veterinarian.'
                ])->withInput();
            }
        }

        Appointment::create($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }

    public function edit(Appointment $appointment)
{
    $user = auth()->user();

    $vets = User::where('role', 'Veterinarian')
        ->orderBy('name')
        ->get();

    if ($user->role === 'Pet Owner') {
        $owner = $user->owner;

        return view('appointments.edit', [
            'appointment' => $appointment,
            'isPetOwner' => true,
            'selectedOwner' => $owner,
            'owners' => collect([$owner]),
            'pets' => $owner
                ? Pet::where('owner_id', $owner->id)->orderBy('name')->get()
                : collect(),
            'vets' => $vets,
        ]);
    }

    return view('appointments.edit', [
        'appointment' => $appointment,
        'isPetOwner' => false,
        'selectedOwner' => null,
        'owners' => Owner::orderBy('full_name')->get(),
        'pets' => Pet::where('owner_id', $appointment->owner_id)->orderBy('name')->get(),
        'vets' => $vets,
    ]);
}

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'owner_id'     => 'required|exists:owners,id',
            'pet_id'       => 'required|exists:pets,id',
            'vet_id'       => 'nullable|exists:users,id',
            'scheduled_at' => 'required|date',
            'reason'       => 'nullable|string',
            'status'       => 'nullable|string',
            'notes'        => 'nullable|string',
        ]);

        $petExists = Pet::where('id', $data['pet_id'])
            ->where('owner_id', $data['owner_id'])
            ->exists();

        if (!$petExists) {
            return back()->withErrors([
                'pet_id' => 'Selected pet does not belong to the selected owner.'
            ])->withInput();
        }

        $appointment->update($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function petsByOwner(Owner $owner)
    {
        return response()->json(
            Pet::where('owner_id', $owner->id)
                ->orderBy('name')
                ->get(['id', 'name'])
        );
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return back()->with('success', 'Appointment deleted successfully.');
    }
    public function show(Appointment $appointment)
{
    $appointment->load([
        'owner',
        'pet.owner',
        'vet',
        'medicalRecord'
    ]);

    return view('appointments.show', compact('appointment'));
}
}