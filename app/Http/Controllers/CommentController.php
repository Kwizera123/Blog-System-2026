<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Policies\CommentPolicy;
use App\Models\User;

class CommentController extends Controller
{
     use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|min:3',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'comment' => $validated['comment'],
            'post_id' => $validated['post_id'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added successfully!');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
         $this->authorize('update', $comment);

        return view('frontend.comments.edit', compact('comment'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);

        $validated = $request->validate([
            'comment' => 'required|min:3',
        ]);

        $comment->update($validated);

        return redirect()
                ->back()
                ->with('success', 'Comment updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()
        ->back()
        ->with('success', 'Comment delete successfully!');
        //
    }
}
