<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class BlogProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('blogprofile.index', compact('user'));
    }
    //End Method

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => [
                'required',
                 'string',
                  'max:255'
                  ],

            'email' => [
                'required',
                 'string',
                 'email',
                  'max:255', 'unique:users,email,' . $user->id
                  ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            // Add other fields as necessary
        ]);

        // Update the user's profile with the validated data

        if ($request->hasFile('profile_photo')) {

        //Delete the old profile photo
        if($user->profile_photo) {
            Storage::disk('public')
                ->delete($user->profile_photo);
        }
            //Upload the new profile photo
            $photoPath = $request
                ->file('profile_photo')
                ->store('profiles', 'public');

            // Save the new path
            $validated['profile_photo'] = $photoPath;
        }

        $user->update($validated);

        return redirect()->route('blogprofile.index')
        ->with('success', 'Profile information updated successfully.');
    }// End Method

    public function destroyPhoto()
    {
        $user = auth()->user();

        if ($user->profile_photo) {
            Storage::disk('public')
                ->delete($user->profile_photo);

            $user->update([
                'profile_photo' => null,
            ]);
        }

        return redirect()
            ->route('blogprofile.index')
            ->with(
                'success',
                'Profile Photo removed successfully!'
            );
    }// End Method

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),

            ],
        ]);
        $user->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);
        return redirect()
            ->route('blogprofile.index')
            ->with('success', 'Password changed successfully!');
    }
}
