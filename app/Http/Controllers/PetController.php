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
        $pets = Pet::with('owner')->latest()->get();
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create', [
            'owners' => Owner::orderBy('full_name')->get(),
            'species' => Species::orderBy('name')->get(),
            'breeds' => Breed::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Pet::create($request->validate([
            'owner_id'=>'required',
            'species_id'=>'nullable',
            'breed_id'=>'nullable',
            'name'=>'required',
            'gender'=>'nullable',
            'date_of_birth'=>'nullable',
            'color'=>'nullable',
            'weight'=>'nullable'
        ]));

        return redirect()->route('pets.index')
            ->with('success','Pet registered successfully.');
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit',[
            'pet'=>$pet,
            'owners'=>Owner::all(),
            'species'=>Species::all(),
            'breeds'=>Breed::all(),
        ]);
    }

    public function update(Request $request, Pet $pet)
    {
        $pet->update($request->all());

        return redirect()->route('pets.index')
            ->with('success','Pet updated.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return back()->with('success','Pet deleted.');
    }
}