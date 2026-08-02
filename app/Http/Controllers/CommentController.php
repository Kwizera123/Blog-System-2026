<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Policies\CommentPolicy;
use App\Models\Tag;
use App\Models\Category;


class CommentController extends Controller
{
     use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function adminIndex(Request $request)
    {
        $comments = Comment::with([
            'user',
            'post',
             ])
             // Search comment
             ->when($request->filled('search'), function ($query) use ($request) {

                    $search = $request->search;

                    $query->where(function ($q) use ($search) {

                        $q->where('comment','like', "%{$search}%"
                        )
                        ->orWhereHas('user',function ($user) use ($search) {
                                $user->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );
                            })

                        ->orWhereHas(
                            'post',
                            function($post) use ($search) {
                                $post->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                );
                    });
     
                            });
                        
                    })
                // Status Filter
                ->when($request->filled('status'), function ($query) use ($request) {
                    $query->where('status', $request->status);
             })

             ->latest()
             ->paginate(10)
             ->withQueryString();

             //Comment status counts
             $totalComments = Comment::count();

             $pendingComments = Comment::where('status', 'pending')->count();

             $approvedComments = Comment::where('status', 'approved')->count();

            $hiddenComments = Comment::where('status', 'hidden')->count();



             return view('backend.comments.index', compact(
                'comments',
                'totalComments',
                'pendingComments',
                'approvedComments',
                'hiddenComments'
             )
            );
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
            
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        Comment::create([
            'post_id' => $validated['post_id'],
            'comment' => $validated['comment'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Thank you for your comment!');
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

         $categories = Category::orderBy('name')->get();
         $tags = Tag::orderBy('name')->get();

        return view('frontend.comments.edit', compact('comment', 'categories', 'tags'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);

        $validated = $request->validate([
            'comment' => 'required|min:3|max:1000',
        ]);

        $comment->update([
            'comment' => $validated['comment'],
        ]);

        return redirect()
                ->route('post.show', $comment->post->slug)
                ->with('success', 'Comment updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

       $post =  $comment->post;

       $comment->delete();

        return redirect()
        ->route('post.show', $post->slug)
        ->with('success', 'Comment delete successfully!');
        //
    }

    public function adminDestroy(Comment $comment)
    {

        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment deleted successfully!');
    }
    //
    public function approve(Comment $comment)
    {
        $comment->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Comment approved successfully!');
    }
    // End Method

    public function hide(Comment $comment)
    {
        $comment->update([
            'status' => 'hidden',
        ]);

        return back()->with('success', 'Comment hidden successfully!');
        
    }
    // End method
}
