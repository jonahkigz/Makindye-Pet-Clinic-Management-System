<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function show()
    {
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    /**
     * Update the authenticated user's personal information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROFILE PHOTO
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('profile_photo')) {

            if (
                $user->profile_photo_path &&
                Storage::disk('public')->exists($user->profile_photo_path)
            ) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $validated['profile_photo_path'] =
                $request->file('profile_photo')
                    ->store('profile-photos', 'public');
        }

        unset($validated['profile_photo']);

        $user->update($validated);

        /*
        |--------------------------------------------------------------------------
        | SYNCHRONIZE PET OWNER PROFILE
        |--------------------------------------------------------------------------
        |
        | When a user with the Pet Owner role updates their profile, the
        | corresponding owner record will also be updated or created.
        |
        */
        if ($user->role === 'Pet Owner') {
            Owner::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                ]
            );
        }

        return redirect()
            ->route('profile.show')
            ->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.show')
            ->with('password_success', 'Your password has been changed successfully.');
    }

    /**
     * Remove the authenticated user's profile picture.
     */
    public function removePhoto()
    {
        $user = auth()->user();

        if (
            $user->profile_photo_path &&
            Storage::disk('public')->exists($user->profile_photo_path)
        ) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->update([
            'profile_photo_path' => null,
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Your profile picture has been removed.');
    }
}