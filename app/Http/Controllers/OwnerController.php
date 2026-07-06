<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::with('user')->latest()->get();

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
            'phone'     => 'nullable|string|max:50',
            'email'     => 'required|email|max:255|unique:users,email',
            'address'   => 'nullable|string|max:255',
        ]);

        // Create User Account
        $user = User::create([
            'name'     => $data['full_name'],
            'email'    => $data['email'],
            'password' => Hash::make('password'),
            'role'     => 'Pet Owner',
        ]);

        // Create Owner Profile
        Owner::create([
            'user_id'   => $user->id,
            'full_name' => $data['full_name'],
            'phone'     => $data['phone'] ?? null,
            'email'     => $data['email'],
            'address'   => $data['address'] ?? null,
        ]);

        return redirect()
            ->route('owners.index')
            ->with('success', 'Pet owner added successfully. Default password: password');
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'nullable|string|max:50',
            'email'     => 'required|email|max:255|unique:users,email,' . $owner->user_id,
            'address'   => 'nullable|string|max:255',
        ]);

        // Update Owner
        $owner->update([
            'full_name' => $data['full_name'],
            'phone'     => $data['phone'] ?? null,
            'email'     => $data['email'],
            'address'   => $data['address'] ?? null,
        ]);

        // Update linked User
        if ($owner->user) {
            $owner->user->update([
                'name'  => $data['full_name'],
                'email' => $data['email'],
                'role'  => 'Pet Owner',
            ]);
        }

        return redirect()
            ->route('owners.index')
            ->with('success', 'Pet owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        // Delete linked User
        if ($owner->user) {
            $owner->user->delete();
        }

        // Delete Owner
        $owner->delete();

        return redirect()
            ->route('owners.index')
            ->with('success', 'Pet owner deleted successfully.');
    }
}