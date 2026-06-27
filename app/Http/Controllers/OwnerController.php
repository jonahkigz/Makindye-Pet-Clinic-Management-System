<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::latest()->get();
        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Owner::create($data);

        return redirect()->route('owners.index')->with('success', 'Owner added successfully.');
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $owner->update($data);

        return redirect()->route('owners.index')->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()->route('owners.index')->with('success', 'Owner deleted successfully.');
    }
}