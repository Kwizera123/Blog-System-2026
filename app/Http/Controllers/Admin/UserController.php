<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index',compact('users'));
    }
    //

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    // End of Method

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    // End of Method

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,author',
        ]);

        //Preventing admin from removing their own admin access
        if($user->id === auth()->id()
            && $validated['role'] !== 'admin') {

        return back()
                ->with('error', 'You cannot remove your own admin role.');
        }

        $user->update($validated);

        return redirect()
                ->route('admin.users.index')
                ->with('success', 'User updated successfully!');
    }
}

