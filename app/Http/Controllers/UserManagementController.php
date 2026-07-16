<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create', [
            'roles' => ['Administrator', 'Veterinarian', 'Receptionist', 'Pet Owner']
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $this->syncPetOwner($user);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => ['Administrator', 'Veterinarian', 'Receptionist', 'Pet Owner']
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $this->syncPetOwner($user);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('success', 'You cannot delete your own account.');
        }

        $user->owner()?->delete();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    private function syncPetOwner(User $user): void
    {
        if ($user->role === 'Pet Owner') {
            Owner::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $user->name,
                    'email' => $user->email,
                ]
            );
        } else {
            Owner::where('user_id', $user->id)->delete();
        }
    }
}