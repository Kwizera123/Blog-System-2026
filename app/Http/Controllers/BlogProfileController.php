<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            // Add other fields as necessary
        ]);

        // Update the user's profile with the validated data
        $user->update($validated);

        return redirect()->route('blogprofile.index')
        ->with('success', 'Profile updated successfully.');
    }// End Method
}
