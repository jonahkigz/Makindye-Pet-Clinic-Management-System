<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Species;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            $pets = $owner
                ? Pet::with('owner')->where('owner_id', $owner->id)->latest()->get()
                : collect();
        } else {
            $pets = Pet::with('owner')->latest()->get();
        }

        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            return view('pets.create', [
                'isPetOwner' => true,
                'selectedOwner' => $owner,
                'owners' => collect([$owner]),
                'species' => Species::orderBy('name')->get(),
                'breeds' => Breed::orderBy('name')->get(),
            ]);
        }

        return view('pets.create', [
            'isPetOwner' => false,
            'selectedOwner' => null,
            'owners' => Owner::orderBy('full_name')->get(),
            'species' => Species::orderBy('name')->get(),
            'breeds' => Breed::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'species_id' => 'nullable|exists:species,id',
            'breed_id' => 'nullable|exists:breeds,id',
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'color' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric',
        ]);

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            if (!$owner) {
                return back()->withErrors([
                    'owner_id' => 'Your pet owner profile was not found.'
                ])->withInput();
            }

            $data['owner_id'] = $owner->id;
        }

        Pet::create($data);

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet registered successfully.');
    }

    public function show(Pet $pet)
{
    $user = auth()->user();

    if ($user->role === 'Pet Owner') {
        $owner = $user->owner;

        if (!$owner || $pet->owner_id !== $owner->id) {
            abort(403, 'You can only view your own pets.');
        }
    }

    $pet->load([
        'owner',
        'species',
        'breed',
        'appointments',
        'medicalRecords',
    ]);

    return view('pets.show', compact('pet'));
}

    public function edit(Pet $pet)
    {
        $user = auth()->user();

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            if (!$owner || $pet->owner_id !== $owner->id) {
                abort(403, 'You can only edit your own pets.');
            }

            return view('pets.edit', [
                'pet' => $pet,
                'isPetOwner' => true,
                'selectedOwner' => $owner,
                'owners' => collect([$owner]),
                'species' => Species::orderBy('name')->get(),
                'breeds' => Breed::orderBy('name')->get(),
            ]);
        }

        return view('pets.edit', [
            'pet' => $pet,
            'isPetOwner' => false,
            'selectedOwner' => null,
            'owners' => Owner::orderBy('full_name')->get(),
            'species' => Species::orderBy('name')->get(),
            'breeds' => Breed::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Pet $pet)
    {
        $user = auth()->user();

        $data = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'species_id' => 'nullable|exists:species,id',
            'breed_id' => 'nullable|exists:breeds,id',
            'name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'color' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric',
        ]);

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            if (!$owner || $pet->owner_id !== $owner->id) {
                abort(403, 'You can only update your own pets.');
            }

            $data['owner_id'] = $owner->id;
        }

        $pet->update($data);

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $user = auth()->user();

        if ($user->role === 'Pet Owner') {
            $owner = $user->owner;

            if (!$owner || $pet->owner_id !== $owner->id) {
                abort(403, 'You can only delete your own pets.');
            }
        }

        $pet->delete();

        return back()->with('success', 'Pet deleted successfully.');
    }
    
}